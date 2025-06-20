@can('secretary-access')
@extends('layouts.Users.app')

@section('content')
<div class="py-12 min-h-screen bg-gradient-to-bl from-yellow-50 via-white to-red-100">
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-2xl border border-yellow-400 p-8">

            <!-- Header -->
            <div class="text-red-900 text-2xl sm:text-3xl font-bold font-[serif] drop-shadow pb-6 border-b border-yellow-300 mb-6 flex items-center gap-2">
                💍 Add Wedding Record
            </div>

            <!-- Form -->
            <form action="{{ route('users.save-wedding-record') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Grid Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Year</label>
                        <input type="number" name="year" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Date of Marriage</label>
                        <input type="date" name="date_of_marriage" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Husband's Name</label>
                        <input type="text" name="husband_name" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Wife's Name</label>
                        <input type="text" name="wife_name" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Husband's Status</label>
                        <input type="text" name="husband_status" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Wife's Status</label>
                        <input type="text" name="wife_status" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Husband's Age</label>
                        <input type="number" name="husband_age" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" min="0" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Wife's Age</label>
                        <input type="number" name="wife_age" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" min="0" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Municipality</label>
                        <input type="text" name="municipality" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Barangay</label>
                        <input type="text" name="barangay" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Husband's Parents</label>
                        <input type="text" name="husband_parents" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Wife's Parents</label>
                        <input type="text" name="wife_parents" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Sponsor 1</label>
                        <input type="text" name="sponsor1" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Sponsor 2</label>
                        <input type="text" name="sponsor2" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Place of Sponsor</label>
                        <input type="text" name="place_of_sponsor" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label class="block text-red-800 font-medium mb-1">Presider</label>
                        <input type="text" name="presider" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 flex justify-end">
                    <button type="submit"
                        class="px-8 py-2 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-red-900 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out border border-yellow-700">
                        Submit Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endcan
