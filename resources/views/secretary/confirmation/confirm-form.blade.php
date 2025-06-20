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
                ✝️ Add Confirmation Record
            </div>

            <!-- Form -->
            <form action="{{ route('users.save-confirm-record') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="year" class="block font-semibold text-red-800 mb-1">Year <span class="text-red-500">*</span></label>
                        <input type="number" name="year" id="year" required class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('year') }}">
                    </div>

                    <div>
                        <label for="date_of_confirmation" class="block font-semibold text-red-800 mb-1">Date of Confirmation <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_confirmation" id="date_of_confirmation" required class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('date_of_confirmation') }}">
                    </div>

                    <div>
                        <label for="name" class="block font-semibold text-red-800 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" required class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('name') }}">
                    </div>

                    <div>
                        <label for="parish_of_baptism" class="block font-semibold text-red-800 mb-1">Parish of Baptism</label>
                        <input type="text" name="parish_of_baptism" id="parish_of_baptism" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('parish_of_baptism') }}">
                    </div>

                    <div>
                        <label for="province_of_baptism" class="block font-semibold text-red-800 mb-1">Province of Baptism</label>
                        <input type="text" name="province_of_baptism" id="province_of_baptism" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('province_of_baptism') }}">
                    </div>

                    <div>
                        <label for="place_of_baptism" class="block font-semibold text-red-800 mb-1">Place of Baptism</label>
                        <input type="text" name="place_of_baptism" id="place_of_baptism" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('place_of_baptism') }}">
                    </div>

                    <div>
                        <label for="parents" class="block font-semibold text-red-800 mb-1">Parents</label>
                        <input type="text" name="parents" id="parents" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('parents') }}">
                    </div>

                    <div>
                        <label for="sponsor" class="block font-semibold text-red-800 mb-1">Sponsor</label>
                        <input type="text" name="sponsor" id="sponsor" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('sponsor') }}">
                    </div>

                    <div>
                        <label for="name_of_minister" class="block font-semibold text-red-800 mb-1">Name of Minister</label>
                        <input type="text" name="name_of_minister" id="name_of_minister" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" value="{{ old('name_of_minister') }}">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 flex justify-end">
                    <button type="submit"
                        class="px-8 py-2 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-red-900 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out border border-yellow-700">
                        Save Confirmation Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endcan
