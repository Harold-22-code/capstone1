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

<div class="py-8 min-h-screen bg-gray-50">
    <div class="w-full max-w-4xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-xl p-4 sm:p-6 md:p-8">
            <div class="text-gray-900 text-xl sm:text-2xl font-bold border-b pb-4 mb-6 flex items-center gap-2">
                <span>{{ __('Add Baptismal Record') }}</span>
            </div>
            <form action="{{route('users.save-baptism-record')}}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label for="name" class="block font-medium mb-1">Full Name</label>
                        <input type="text" name="name" id="name" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Birth_Date" class="block font-medium mb-1">Birth Date</label>
                        <input type="date" name="Birth_Date" id="Birth_Date" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Baptism_Date" class="block font-medium mb-1">Baptism Date</label>
                        <input type="date" name="Baptism_Date" id="Baptism_Date" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Church_Name" class="block font-medium mb-1">Church Name</label>
                        <input type="text" name="Church_Name" id="Church_Name" class="form-input w-full" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label for="Fathers_Name" class="block font-medium mb-1">Father's Name</label>
                        <input type="text" name="Fathers_Name" id="Fathers_Name" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Mothers_Name" class="block font-medium mb-1">Mother's Name</label>
                        <input type="text" name="Mothers_Name" id="Mothers_Name" class="form-input w-full" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label for="Sponsor" class="block font-medium mb-1">Sponsor</label>
                        <input type="text" name="Sponsor" id="Sponsor" class="form-input w-full">
                    </div>
                    <div>
                        <label for="Secondary_Sponsor" class="block font-medium mb-1">Secondary Sponsor</label>
                        <input type="text" name="Secondary_Sponsor" id="Secondary_Sponsor" class="form-input w-full">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                    <div>
                        <label for="Priest_Name" class="block font-medium mb-1">Priest Name</label>
                        <input type="text" name="Priest_Name" id="Priest_Name" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Book_Number" class="block font-medium mb-1">Book Number</label>
                        <input type="number" name="Book_Number" id="Book_Number" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Page_Number" class="block font-medium mb-1">Page Number</label>
                        <input type="number" name="Page_Number" id="Page_Number" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Line_Number" class="block font-medium mb-1">Line Number</label>
                        <input type="number" name="Line_Number" id="Line_Number" class="form-input w-full" required>
                    </div>
                </div>
                <div class="pt-6 flex flex-col sm:flex-row justify-end gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg shadow hover:bg-blue-700 transition w-full sm:w-auto">Submit Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endcan
