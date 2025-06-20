@can('parish_priest-access')
    @extends('layouts.Admin.app')
    @section('content')
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-300 text-green-800 transition-opacity duration-500"
                x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-xl p-4 sm:p-6 md:p-8">
            <div class="text-gray-900 text-xl sm:text-2xl font-bold border-b pb-4 mb-6 flex items-center gap-2">
                <span>{{ __('Create a new Schedule') }}</span>
            </div>

            <form method="POST" action="{{route('admin.save-schedule')}}" class="space-y-6">
                @csrf
                <div>
                    <label for="event_id" class="block text-sm font-medium text-gray-700">Event</label>
                    <select id="event_id" name="event_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Event</option>
                        @foreach(App\Models\Event::all() as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="reservation_date" class="block text-sm font-medium text-gray-700">Reservation Date</label>
                    <input type="date" id="reservation_date" name="reservation_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="reservation_time" class="block text-sm font-medium text-gray-700">Reservation Time</label>
                    <input type="time" id="reservation_time" name="reservation_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div id="wedding-fields" style="display:none;">
                    <label for="groom_name" class="block text-sm font-medium text-gray-700">Groom Name</label>
                    <input type="text" id="groom_name" name="groom_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <label for="bride_name" class="block text-sm font-medium text-gray-700 mt-2">Bride Name</label>
                    <input type="text" id="bride_name" name="bride_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div id="burial-fields" style="display:none;">
                    <label for="deceased_name" class="block text-sm font-medium text-gray-700">Deceased Name</label>
                    <input type="text" id="deceased_name" name="deceased_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div id="baptism-fields" style="display:none;">
                    <label for="child_name" class="block text-sm font-medium text-gray-700">Child Name</label>
                    <input type="text" id="child_name" name="child_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <label for="father_name" class="block text-sm font-medium text-gray-700 mt-2">Father Name</label>
                    <input type="text" id="father_name" name="father_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <label for="mother_name" class="block text-sm font-medium text-gray-700 mt-2">Mother Name</label>
                    <input type="text" id="mother_name" name="mother_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div id="confirmation-fields" style="display:none;">
                    <label for="confirmand_name" class="block text-sm font-medium text-gray-700">Confirmand Name</label>
                    <input type="text" id="confirmand_name" name="confirmand_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">Submit</button>
                </div>
            </form>
        </div>
    @endsection
@endcanany

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eventSelect = document.getElementById('event_id');
        const weddingFields = document.getElementById('wedding-fields');
        const burialFields = document.getElementById('burial-fields');
        const baptismFields = document.getElementById('baptism-fields');
        const confirmationFields = document.getElementById('confirmation-fields');
        function hideAll() {
            weddingFields.style.display = 'none';
            burialFields.style.display = 'none';
            baptismFields.style.display = 'none';
            confirmationFields.style.display = 'none';
        }
        eventSelect.addEventListener('change', function() {
            hideAll();
            const selected = eventSelect.options[eventSelect.selectedIndex].text.toLowerCase();
            if(selected === 'wedding') weddingFields.style.display = '';
            if(selected === 'burial') burialFields.style.display = '';
            if(selected === 'baptism') baptismFields.style.display = '';
            if(selected === 'confirmation') confirmationFields.style.display = '';
        });
        hideAll();
    });
</script>
