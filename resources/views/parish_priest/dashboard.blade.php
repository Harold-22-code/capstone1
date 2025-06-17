@can('parish_priest-access')
    @extends('layouts.Admin.app')

        @section('content')

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                           
                            
                            <h1>Lists of All Schedules</h1>
                            @php
                                // Fetch schedules with event and user relationships
                                $schedules = \App\Models\Schedule::with('event', 'user')->latest()->get();
                            @endphp
                            @if($schedules->isEmpty())
                                <p class="text-gray-400 text-sm">No schedules found.</p>
                            @else
                                <div class="overflow-x-auto mt-4">
                                    <table class="w-full text-xs md:text-sm border-separate border-spacing-y-1">
                                        <thead>
                                            <tr class="bg-indigo-50 text-indigo-900">
                                                <th class="px-2 py-1 text-left">Event</th>
                                                <th class="px-2 py-1 text-left">Reserved By</th>
                                                <th class="px-2 py-1 text-left">Date</th>
                                                <th class="px-2 py-1 text-left">Time</th>
                                                <th class="px-2 py-1 text-left">Number of People</th>
                                                <th class="px-2 py-1 text-left">Status</th>
                                                <th class="px-2 py-1 text-left">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($schedules as $schedule)
                                                <tr class="bg-white hover:bg-indigo-50 rounded transition">
                                                    <td class="px-2 py-1">{{ $schedule->event ? $schedule->event->name : '-' }}</td>
                                                    <td class="px-2 py-1">{{ $schedule->user ? $schedule->user->name : '-' }}</td>
                                                    <td class="px-2 py-1">{{ $schedule->reservation_date ? \Carbon\Carbon::parse($schedule->reservation_date)->format('F d, Y') : '-' }}</td>
                                                    <td class="px-2 py-1">{{ $schedule->reservation_time ? date('h:i A', strtotime($schedule->reservation_time)) : '-' }}</td>
                                                    <td class="px-2 py-1">{{ $schedule->number_of_people ?? '-' }}</td>
                                                    <td class="px-2 py-1 capitalize">{{ $schedule->status }}</td>
                                                    <td class="px-2 py-1">
                                                        <button type="button" class="bg-indigo-500 hover:bg-indigo-600 text-white px-2 py-1 rounded text-xs">View</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endsection
@endcan