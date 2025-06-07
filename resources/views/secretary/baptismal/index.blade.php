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

<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
            <div class="p-6 text-gray-900 text-xl font-semibold border-b mb-4">
                {{ __('Add Baptismal Record') }}
            </div>
            <form action="{{route('users.save-baptism-record')}}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block font-medium">Full Name</label>
                    <input type="text" name="name" id="name" class="form-input w-full" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="Birth_Date" class="block font-medium">Birth Date</label>
                        <input type="date" name="Birth_Date" id="Birth_Date" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Baptism_Date" class="block font-medium">Baptism Date</label>
                        <input type="date" name="Baptism_Date" id="Baptism_Date" class="form-input w-full" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="Fathers_Name" class="block font-medium">Father's Name</label>
                        <input type="text" name="Fathers_Name" id="Fathers_Name" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Mothers_Name" class="block font-medium">Mother's Name</label>
                        <input type="text" name="Mothers_Name" id="Mothers_Name" class="form-input w-full" required>
                    </div>
                </div>
                <div>
                    <label for="Church_Name" class="block font-medium">Church Name</label>
                    <input type="text" name="Church_Name" id="Church_Name" class="form-input w-full" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="Sponsor" class="block font-medium">Sponsor</label>
                        <input type="text" name="Sponsor" id="Sponsor" class="form-input w-full">
                    </div>
                    <div>
                        <label for="Secondary_Sponsor" class="block font-medium">Secondary Sponsor</label>
                        <input type="text" name="Secondary_Sponsor" id="Secondary_Sponsor" class="form-input w-full">
                    </div>
                </div>
                <div>
                    <label for="Priest_Name" class="block font-medium">Priest Name</label>
                    <input type="text" name="Priest_Name" id="Priest_Name" class="form-input w-full" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="Book_Number" class="block font-medium">Book Number</label>
                        <input type="number" name="Book_Number" id="Book_Number" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Page_Number" class="block font-medium">Page Number</label>
                        <input type="number" name="Page_Number" id="Page_Number" class="form-input w-full" required>
                    </div>
                    <div>
                        <label for="Line_Number" class="block font-medium">Line Number</label>
                        <input type="number" name="Line_Number" id="Line_Number" class="form-input w-full" required>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Submit Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endcan
