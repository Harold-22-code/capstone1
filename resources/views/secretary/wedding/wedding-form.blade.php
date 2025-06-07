@can('secretary-access')
@extends('layouts.Users.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg shadow">
            <div class="p-6 text-gray-900 text-xl font-semibold border-b mb-4">
                {{ __('Add Wedding Record') }}
            </div>
            <form action="" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endcan
