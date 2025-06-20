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

<!-- Page Wrapper -->
<div class="py-12 min-h-screen bg-gradient-to-bl from-yellow-50 via-white to-red-100">
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/90 backdrop-blur-sm border border-yellow-400 rounded-xl shadow-2xl p-8">
            
            <!-- Header -->
            <div class="flex items-center justify-between pb-6 border-b border-yellow-400">
                <h2 class="text-2xl sm:text-3xl font-bold text-red-900 font-[serif] drop-shadow">
                    ✝️ Add Baptismal Record
                </h2>
            </div>

            <!-- Form Start -->
            <form action="{{ route('users.save-baptism-record') }}" method="POST" class="mt-8 space-y-6">
                @csrf

                <!-- Row 1 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-red-800 font-medium mb-1">Full Name</label>
                        <input type="text" name="name" id="name" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label for="Birth_Date" class="block text-red-800 font-medium mb-1">Birth Date</label>
                        <input type="date" name="Birth_Date" id="Birth_Date" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="Baptism_Date" class="block text-red-800 font-medium mb-1">Baptism Date</label>
                        <input type="date" name="Baptism_Date" id="Baptism_Date" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label for="Church_Name" class="block text-red-800 font-medium mb-1">Church Name</label>
                        <input type="text" name="Church_Name" id="Church_Name" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="Fathers_Name" class="block text-red-800 font-medium mb-1">Father's Name</label>
                        <input type="text" name="Fathers_Name" id="Fathers_Name" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label for="Mothers_Name" class="block text-red-800 font-medium mb-1">Mother's Name</label>
                        <input type="text" name="Mothers_Name" id="Mothers_Name" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="Sponsor" class="block text-red-800 font-medium mb-1">Primary Sponsor</label>
                        <input type="text" name="Sponsor" id="Sponsor" class="form-input w-full rounded-lg border-yellow-400 shadow-inner">
                    </div>
                    <div>
                        <label for="Secondary_Sponsor" class="block text-red-800 font-medium mb-1">Secondary Sponsor</label>
                        <input type="text" name="Secondary_Sponsor" id="Secondary_Sponsor" class="form-input w-full rounded-lg border-yellow-400 shadow-inner">
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div>
                        <label for="Priest_Name" class="block text-red-800 font-medium mb-1">Priest Name</label>
                        <input type="text" name="Priest_Name" id="Priest_Name" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label for="Book_Number" class="block text-red-800 font-medium mb-1">Book #</label>
                        <input type="number" name="Book_Number" id="Book_Number" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label for="Page_Number" class="block text-red-800 font-medium mb-1">Page #</label>
                        <input type="number" name="Page_Number" id="Page_Number" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
                    </div>
                    <div>
                        <label for="Line_Number" class="block text-red-800 font-medium mb-1">Line #</label>
                        <input type="number" name="Line_Number" id="Line_Number" class="form-input w-full rounded-lg border-yellow-400 shadow-inner" required>
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
