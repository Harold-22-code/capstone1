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
                <span>{{ __('Add Burial Record') }}</span>
            </div>

             <form action="{{route('users.save-burial-record')}}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('name') }}">
                        @error('name')<span class="text-red-500 text-xs">{{ $message ?? '' }}</span>@enderror
                    </div>
                    <div>
                        <label for="date_of_death" class="block text-sm font-medium text-gray-700">Date of Death <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_death" id="date_of_death" required class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('date_of_death') }}">
                        @error('date_of_death')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="date_of_burial" class="block text-sm font-medium text-gray-700">Date of Burial <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_burial" id="date_of_burial" required class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('date_of_burial') }}">
                        @error('date_of_burial')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="number" name="age" id="age" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('age') }}">
                        @error('age')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <input type="text" name="status" id="status" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('status') }}">
                        @error('status')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="informant" class="block text-sm font-medium text-gray-700">Informant</label>
                        <input type="text" name="informant" id="informant" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('informant') }}">
                        @error('informant')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="place" class="block text-sm font-medium text-gray-700">Place</label>
                        <input type="text" name="place" id="place" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('place') }}">
                        @error('place')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                    <div>
                        <label for="presider" class="block text-sm font-medium text-gray-700">Presider</label>
                        <input type="text" name="presider" id="presider" class="mt-1 block w-full rounded border-gray-300 shadow-sm" value="{{ old('presider') }}">
                        @error('presider')<span class="text-red-500 text-xs"></span>@enderror
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">Save Burial Record</button>
                </div>
            </form>

    </div>

@endsection
@endcan