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
                        $scheduleDates = $schedules->pluck('reservation_date')->unique()->toArray();
                        $currentMonth = now()->format('Y-m');
                        $daysInMonth = \Carbon\Carbon::parse($currentMonth.'-01')->daysInMonth;
                        $firstDayOfMonth = \Carbon\Carbon::parse($currentMonth.'-01')->dayOfWeekIso; // 1 (Mon) - 7 (Sun)
                    @endphp

                    <script>
                        window.schedules = @json($schedules);
                        window.scheduleDates = @json($scheduleDates);
                        window.calendarData = function() {
                            const today = new Date();
                            return {
                                showDetails: false,
                                selectedDate: '',
                                schedules: window.schedules,
                                scheduleDates: window.scheduleDates,
                                currentMonth: today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0'),
                                get daysInMonth() {
                                    const [year, month] = this.currentMonth.split('-').map(Number);
                                    return new Date(year, month, 0).getDate();
                                },
                                get firstDayOfMonth() {
                                    const [year, month] = this.currentMonth.split('-').map(Number);
                                    return new Date(year, month - 1, 1).getDay() === 0 ? 7 : new Date(year, month - 1, 1).getDay();
                                },
                                getMonthName() {
                                    const [year, month] = this.currentMonth.split('-').map(Number);
                                    return new Date(year, month - 1).toLocaleString('default', { month: 'long', year: 'numeric' });
                                },
                                canGoBack() {
                                    const [year, month] = this.currentMonth.split('-').map(Number);
                                    return (year > today.getFullYear()) || (year === today.getFullYear() && month > (today.getMonth() + 1));
                                },
                                prevMonth() {
                                    if (!this.canGoBack()) return;
                                    let [year, month] = this.currentMonth.split('-').map(Number);
                                    month--;
                                    if (month < 1) {
                                        month = 12;
                                        year--;
                                    }
                                    this.currentMonth = year + '-' + String(month).padStart(2, '0');
                                },
                                nextMonth() {
                                    let [year, month] = this.currentMonth.split('-').map(Number);
                                    month++;
                                    if (month > 12) {
                                        month = 1;
                                        year++;
                                    }
                                    this.currentMonth = year + '-' + String(month).padStart(2, '0');
                                },
                            };
                        }
                    </script>

                    <div x-data="calendarData()">
                        <div class="flex justify-between items-center mb-4">
                            <button @click="prevMonth" :disabled="!canGoBack()" class="px-3 py-1 rounded bg-indigo-100 text-indigo-700 font-bold disabled:opacity-50 disabled:cursor-not-allowed">&lt;</button>
                            <h2 class="text-lg font-semibold text-indigo-600" x-text="getMonthName()"></h2>
                            <button @click="nextMonth" class="px-3 py-1 rounded bg-indigo-100 text-indigo-700 font-bold">&gt;</button>
                        </div>
                        <div class="grid grid-cols-7 gap-2 text-center">
                            <div class="font-bold text-indigo-700">Mon</div>
                            <div class="font-bold text-indigo-700">Tue</div>
                            <div class="font-bold text-indigo-700">Wed</div>
                            <div class="font-bold text-indigo-700">Thu</div>
                            <div class="font-bold text-indigo-700">Fri</div>
                            <div class="font-bold text-indigo-700">Sat</div>
                            <div class="font-bold text-indigo-700">Sun</div>
                            <!-- Empty cells for first week -->
                            <template x-for="i in firstDayOfMonth - 1" :key="'empty-' + i">
                                <div></div>
                            </template>
                            <!-- Days of the month -->
                            <template x-for="day in daysInMonth" :key="'day-' + day">
                                <div>
                                    <button
                                        class="w-full aspect-square rounded-lg transition font-semibold focus:outline-none"
                                        :class="{
                                            'bg-green-500 text-white hover:bg-green-600': scheduleDates.includes(currentMonth + '-' + String(day).padStart(2, '0')),
                                            'bg-red-500 text-white': (new Date(currentMonth + '-' + String(day).padStart(2, '0')) < new Date(new Date().toISOString().slice(0,10))),
                                            'bg-gray-100 text-gray-700 hover:bg-indigo-100': !scheduleDates.includes(currentMonth + '-' + String(day).padStart(2, '0')) && !(new Date(currentMonth + '-' + String(day).padStart(2, '0')) < new Date(new Date().toISOString().slice(0,10)))
                                        }"
                                        :disabled="!scheduleDates.includes(currentMonth + '-' + String(day).padStart(2, '0'))"
                                        @click="selectedDate = currentMonth + '-' + String(day).padStart(2, '0'); showDetails = true"
                                    >
                                        <span x-text="day"></span>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <!-- Details Modal -->
                        <div x-show="showDetails" x-cloak class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black bg-opacity-10">
                            <div class="bg-white rounded-xl p-6 max-w-xl w-full border border-indigo-200 shadow-xl relative">
                                <button @click="showDetails = false" class="absolute top-2 right-3 text-2xl text-gray-400 hover:text-gray-600">&times;</button>
                                <h2 class="text-lg font-semibold text-indigo-600 mb-4 text-center">Schedules for <span x-text="selectedDate"></span></h2>
                                <template x-if="schedules.filter(s => s.reservation_date === selectedDate).length">
                                    <ul class="space-y-2">
                                        <template x-for="sched in schedules.filter(s => s.reservation_date === selectedDate)" :key="sched.id">
                                            <li class="p-3 bg-indigo-50 rounded shadow">
                                                <div><strong>Event:</strong> <span x-text="sched.event?.name || '-'" /></div>
                                                <div><strong>Reserved By:</strong> <span x-text="sched.user?.name || '-'" /></div>
                                                <div><strong>Time:</strong> <span x-text="sched.reservation_time || '-'" /></div>
                                                <div><strong>Status:</strong> <span x-text="sched.status || '-'" /></div>
                                            </li>
                                        </template>
                                    </ul>
                                </template>
                                <template x-if="!schedules.filter(s => s.reservation_date === selectedDate).length">
                                    <p class="text-gray-400 italic text-sm text-center">No schedules for this date.</p>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endcan
