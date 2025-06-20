@can('parish_priest-access')
@extends('layouts.Admin.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-indigo-700 mb-4 border-b pb-2">📅 Church Event Schedules</h1>

                    @php
                        $schedules = \App\Models\Schedule::with('event', 'user')->latest()->get();
                    @endphp

                    @if($schedules->isEmpty())
                        <p class="text-gray-400 italic text-sm">No schedules found.</p>
                    @else
                        <div 
                            x-data="{
                                openScheduleModal: false, 
                                openScheduleEditModal: false, 
                                selectedSchedule: null, 
                                showScheduleSuccess: false, 
                                scheduleSuccessMsg: '' 
                            }" 
                            class="overflow-x-auto mt-6"
                        >
                            <table class="min-w-full text-sm table-auto border-separate border-spacing-y-1">
                                <thead class="bg-indigo-100 text-indigo-800 text-left">
                                    <tr>
                                        <th class="px-3 py-2 rounded-tl-lg">Event</th>
                                        <th class="px-3 py-2">Reserved By</th>
                                        <th class="px-3 py-2">Date</th>
                                        <th class="px-3 py-2">Time</th>
                                        <th class="px-3 py-2">Status</th>
                                        <th class="px-3 py-2 rounded-tr-lg">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedules as $schedule)
                                        <tr class="bg-white hover:bg-indigo-50 rounded shadow transition">
                                            <td class="px-3 py-2">{{ $schedule->event->name ?? '-' }}</td>
                                            <td class="px-3 py-2">{{ $schedule->user->name ?? '-' }}</td>
                                            <td class="px-3 py-2">{{ $schedule->reservation_date ? \Carbon\Carbon::parse($schedule->reservation_date)->format('F d, Y') : '-' }}</td>
                                            <td class="px-3 py-2">{{ $schedule->reservation_time ? date('h:i A', strtotime($schedule->reservation_time)) : '-' }}</td>
                                            <td class="px-3 py-2 capitalize font-medium">
                                                <span class="px-2 py-1 rounded text-white text-xs font-semibold
                                                    {{ $schedule->status === 'approved' ? 'bg-green-500' : ($schedule->status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                                    {{ $schedule->status }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-2 space-x-2">
                                                <button 
                                                    @click="openScheduleModal = true; selectedSchedule = {{ json_encode($schedule) }}"
                                                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-xs"
                                                >View</button>
                                                
                                                <button 
                                                    @click="openScheduleEditModal = true; selectedSchedule = {{ json_encode($schedule) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs"
                                                >Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- View Modal (Centered with Normal Background) -->
                            <div x-show="openScheduleModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center px-4">
                                <div class="bg-white rounded-xl p-6 max-w-xl w-full border border-indigo-200 shadow-xl relative">
                                    <button @click="openScheduleModal = false" class="absolute top-2 right-3 text-2xl text-gray-400 hover:text-gray-600">&times;</button>
                                    <h2 class="text-lg font-semibold text-indigo-600 mb-4 text-center">Schedule Details</h2>
                                    <template x-if="selectedSchedule">
                                        <div class="space-y-2 text-sm text-gray-700">
                                            <p><strong>Event:</strong> <span x-text="selectedSchedule.event?.name || '-'"></span></p>
                                            <p><strong>Reserved By:</strong> <span x-text="selectedSchedule.user?.name || '-'"></span></p>
                                            <p><strong>Date:</strong> <span x-text="selectedSchedule.reservation_date"></span></p>
                                            <p><strong>Time:</strong> <span x-text="new Date('1970-01-01T' + selectedSchedule.reservation_time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true })"></span></p>
                                            <p><strong>Status:</strong> <span x-text="selectedSchedule.status"></span></p>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Edit Modal (with dark background) -->
                            <div x-show="openScheduleEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                    <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-yellow-200 w-full overflow-y-auto max-h-[90vh]">
                                        <button @click="openScheduleEditModal = false" class="absolute top-3 right-3 text-yellow-400 hover:text-yellow-700 text-2xl font-bold transition">&times;</button>
                                        <h2 class="text-xl font-extrabold mb-6 text-yellow-700 text-center tracking-wide">Edit Schedule</h2>
                                        <template x-if="showScheduleSuccess">
                                            <div class="mb-4 p-2 bg-yellow-100 border border-yellow-400 text-yellow-800 rounded text-center transition-opacity duration-500" x-text="scheduleSuccessMsg"></div>
                                        </template>
                                        <template x-if="selectedSchedule">
                                            <form class="space-y-3 text-base" @submit.prevent="
                                                if(selectedSchedule && selectedSchedule.id){
                                                    fetch('/users/update-schedule/' + selectedSchedule.id, {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                            'Accept': 'application/json',
                                                        },
                                                        body: JSON.stringify(selectedSchedule)
                                                    })
                                                    .then(async res => {
                                                        if (!res.ok) {
                                                            const errorData = await res.json().catch(() => ({}));
                                                            console.error('Validation or server error:', errorData);
                                                            alert('Update failed! ' + (errorData.message || res.statusText));
                                                            return;
                                                        }
                                                        return res.json();
                                                    })
                                                    .then(data => {
                                                        if(data && data.success){
                                                            showScheduleSuccess = true;
                                                            scheduleSuccessMsg = data.message;
                                                            setTimeout(() => {
                                                                openScheduleEditModal = false;
                                                                window.location.reload();
                                                            }, 4000);
                                                        } else if(data && data.message) {
                                                            alert('Update failed! ' + data.message);
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error('AJAX error:', error);
                                                        alert('Update failed! See console for details.');
                                                    });
                                                }
                                            ">
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <div class="flex-1 flex flex-col">
                                                        <label class="font-semibold text-yellow-900 mb-1">Date</label>
                                                        <input type="date" x-model="selectedSchedule.reservation_date" class="form-input rounded border border-yellow-300" />
                                                    </div>
                                                    <div class="flex-1 flex flex-col">
                                                        <label class="font-semibold text-yellow-900 mb-1">Time</label>
                                                        <input type="time" x-model="selectedSchedule.reservation_time" class="form-input rounded border border-yellow-300" />
                                                    </div>
                                                </div>
                                                <div class="flex flex-col sm:flex-row gap-2">
                                                    <div class="flex-1 flex flex-col">
                                                        <label class="font-semibold text-yellow-900 mb-1">Status</label>
                                                        <select x-model="selectedSchedule.status" class="form-input rounded border border-yellow-300">
                                                            <option value="pending">Pending</option>
                                                            <option value="approved">Approved</option>
                                                            <option value="rejected">Rejected</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end pt-2">
                                                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg shadow transition">Save Changes</button>
                                                </div>
                                            </form>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@endcan
