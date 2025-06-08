@can('secretary-access')
@extends('layouts.Users.app')

@section('content')

    @if(session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 5000)"
            x-show="show"
            class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-300 text-green-800 transition-opacity duration-500"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            {{ session('success') }}
        </div>
    @endif


     <div class="bg-white shadow-lg rounded-xl p-4 sm:p-6 md:p-8">
            <div class="text-gray-900 text-xl sm:text-2xl font-bold border-b pb-4 mb-6 flex items-center gap-2">
                <span>{{ __('Add Confirmation Record') }}</span>
            </div>

             <form action="{{route('users.save-confirm-record')}}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">Year <span class="text-red-500">*</span></label>
                        <input type="number" name="year" id="year" required class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('year') }}">
                        @error('year')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="date_of_confirmation" class="block text-sm font-medium text-gray-700">Date of Confirmation <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_confirmation" id="date_of_confirmation" required class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('date_of_confirmation') }}">
                        @error('date_of_confirmation')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('name') }}">
                        @error('name')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="parish_of_baptism" class="block text-sm font-medium text-gray-700">Parish of Baptism</label>
                        <input type="text" name="parish_of_baptism" id="parish_of_baptism" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('parish_of_baptism') }}">
                        @error('parish_of_baptism')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="province_of_baptism" class="block text-sm font-medium text-gray-700">Province of Baptism</label>
                        <input type="text" name="province_of_baptism" id="province_of_baptism" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('province_of_baptism') }}">
                        @error('province_of_baptism')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="place_of_baptism" class="block text-sm font-medium text-gray-700">Place of Baptism</label>
                        <input type="text" name="place_of_baptism" id="place_of_baptism" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('place_of_baptism') }}">
                        @error('place_of_baptism')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="parents" class="block text-sm font-medium text-gray-700">Parents</label>
                        <input type="text" name="parents" id="parents" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('parents') }}">
                        @error('parents')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="sponsor" class="block text-sm font-medium text-gray-700">Sponsor</label>
                        <input type="text" name="sponsor" id="sponsor" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('sponsor') }}">
                        @error('sponsor')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="name_of_minister" class="block text-sm font-medium text-gray-700">Name of Minister</label>
                        <input type="text" name="name_of_minister" id="name_of_minister" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('name_of_minister') }}">
                        @error('name_of_minister')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">Save Confirmation Record</button>
                </div>
            </form>


    @endsection
@endcan