@can('secretary-access')
@extends('layouts.Users.app')

@section('content')
<div class="py-8 min-h-screen bg-gray-50">
    <div class="w-full max-w-4xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-xl p-4 sm:p-6 md:p-8">
            <div class="text-gray-900 text-xl sm:text-2xl font-bold border-b pb-4 mb-6 flex items-center gap-2">
                <span>{{ __('Add Wedding Record') }}</span>
            </div>
            <form action="{{ route('users.save-wedding-record') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label class="block font-medium mb-1">Year</label>
                        <input type="number" name="year" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Date of Marriage</label>
                        <input type="date" name="date_of_marriage" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Husband's Name</label>
                        <input type="text" name="husband_name" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Wife's Name</label>
                        <input type="text" name="wife_name" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Husband's Status</label>
                        <input type="text" name="husband_status" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Wife's Status</label>
                        <input type="text" name="wife_status" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Husband's Age</label>
                        <input type="number" name="husband_age" class="form-input w-full" min="0" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Wife's Age</label>
                        <input type="number" name="wife_age" class="form-input w-full" min="0" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Municipality</label>
                        <input type="text" name="municipality" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Barangay</label>
                        <input type="text" name="barangay" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Husband's Parents</label>
                        <input type="text" name="husband_parents" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Wife's Parents</label>
                        <input type="text" name="wife_parents" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Sponsor 1</label>
                        <input type="text" name="sponsor1" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Sponsor 2</label>
                        <input type="text" name="sponsor2" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Place of Sponsor</label>
                        <input type="text" name="place_of_sponsor" class="form-input w-full" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Presider</label>
                        <input type="text" name="presider" class="form-input w-full" required>
                    </div>
                </div>
                <div class="pt-6 flex flex-col sm:flex-row justify-end gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg shadow hover:bg-blue-700 transition w-full sm:w-auto">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endcan
