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

<div class="py-10 min-h-screen bg-gradient-to-bl from-yellow-50 via-white to-red-100">
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/90 backdrop-blur-md rounded-xl shadow-2xl border border-yellow-300 p-8">

            <!-- Header -->
            <div class="text-red-900 text-2xl sm:text-3xl font-bold font-[serif] drop-shadow pb-6 border-b border-yellow-300 mb-6 flex items-center gap-2">
                ⚰️ Add Burial Record
            </div>

            <!-- Form -->
            <form action="{{ route('users.save-burial-record') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block font-semibold text-red-800 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" required class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('name') }}">
                    </div>

                    <div>
                        <label for="date_of_death" class="block font-semibold text-red-800 mb-1">Date of Death <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_death" id="date_of_death" required class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('date_of_death') }}">
                    </div>

                    <div>
                        <label for="date_of_burial" class="block font-semibold text-red-800 mb-1">Date of Burial <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_burial" id="date_of_burial" required class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('date_of_burial') }}">
                    </div>

                    <div>
                        <label for="age" class="block font-semibold text-red-800 mb-1">Age</label>
                        <input type="number" name="age" id="age" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('age') }}">
                    </div>

                    <div>
                        <label for="status" class="block font-semibold text-red-800 mb-1">Status</label>
                        <input type="text" name="status" id="status" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('status') }}">
                    </div>

                    <div>
                        <label for="informant" class="block font-semibold text-red-800 mb-1">Informant</label>
                        <input type="text" name="informant" id="informant" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('informant') }}">
                    </div>

                    <div>
                        <label for="place" class="block font-semibold text-red-800 mb-1">Place</label>
                        <input type="text" name="place" id="place" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('place') }}">
                    </div>

                    <div>
                        <label for="presider" class="block font-semibold text-red-800 mb-1">Presider</label>
                        <input type="text" name="presider" id="presider" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('presider') }}">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 flex justify-end">
                    <button type="submit"
                        class="px-8 py-2 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-red-900 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out border border-yellow-700">
                        Save Burial Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endcan
