@can('secretary-access')
    @extends('layouts.Users.app')

    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-xl font-semibold">
                        {{ __('RECORDS DASHBOARD') }}
                    </div>

                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Baptismal Records Card -->
                        <div x-data="{ openModal: false, openEditModal: false, selected: null }" class=" bg-black bg-opacity-10 rounded-lg shadow p-4 flex flex-col min-h-[350px] max-h-[500px] overflow-y-auto">
                            <div class="text-lg font-bold text-blue-800 mb-2">Baptismal Records</div>
                            <div class="flex-1 overflow-auto">
                                @if($baptismalRecords->isEmpty())
                                    <p class="text-gray-600">No baptismal records found.</p>
                                @else
                                    <table class="min-w-full table-auto border border-gray-300 text-xs md:text-sm">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-2 py-1 border">Name</th>
                                                <th class="px-2 py-1 border">Birth Date</th>
                                                <th class="px-2 py-1 border">Baptism Date</th>
                                                <th class="px-2 py-1 border">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($baptismalRecords as $record)
                                                <tr class="border-t">
                                                    <td class="px-2 py-1 border">{{ $record->name }}</td>
                                                    <td class="px-2 py-1 border">{{ \Carbon\Carbon::parse($record->Birth_Date)->format('F d, Y') }}</td>
                                                    <td class="px-2 py-1 border">{{ \Carbon\Carbon::parse($record->Baptism_Date)->format('F d, Y') }}</td>
                                                    <td class="px-2 py-1 border space-x-2">
                                                        <button @click="openModal = true; selected = {{ json_encode($record) }}" type="button" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs">View</button>
                                                        <button @click="openEditModal = true; selected = {{ json_encode($record) }}" type="button" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">Edit</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Modal -->
                                    <div x-show="openModal" x-cloak class="fixed inset-0 flex items-center justify-center z-50 bg-transparent">
                                        <div class="relative w-full max-w-md">
                                            <div class="absolute inset-0 blur-xl bg-gradient-to-br from-blue-200 via-white to-blue-100 opacity-80 rounded-2xl"></div>
                                            <div class="relative bg-white rounded-2xl shadow-2xl p-8 border border-blue-200">
                                                <button @click="openModal = false" class="absolute top-3 right-3 text-blue-400 hover:text-blue-700 text-2xl font-bold transition">&times;</button>
                                                <h2 class="text-xl font-extrabold mb-6 text-blue-700 text-center tracking-wide">Baptismal Record Details</h2>
                                                <template x-if="selected">
                                                    <div class="space-y-3 text-base">
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Name:</span> <span x-text="selected.name"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Birth Date:</span> <span x-text="selected.Birth_Date"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Baptism Date:</span> <span x-text="selected.Baptism_Date"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Father's Name:</span> <span x-text="selected.Fathers_Name"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Mother's Name:</span> <span x-text="selected.Mothers_Name"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Church Name:</span> <span x-text="selected.Church_Name"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Sponsor:</span> <span x-text="selected.Sponsor"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Secondary Sponsor:</span> <span x-text="selected.Secondary_Sponsor"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Priest Name:</span> <span x-text="selected.Priest_Name"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Book Number:</span> <span x-text="selected.Book_Number"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Page Number:</span> <span x-text="selected.Page_Number"></span></div>
                                                        <div class="flex justify-between"><span class="font-semibold text-blue-900">Line Number:</span> <span x-text="selected.Line_Number"></span></div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit baptismal record Modal -->
                                    <div x-data="{ showSuccess: false, successMsg: '' }" x-init="
                                        $watch('showSuccess', value => {
                                            if(value) setTimeout(() => showSuccess = false, 4000);
                                        })
                                    " class="relative">
                                        <div x-show="openEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                            <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                                <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-yellow-200 w-full overflow-y-auto max-h-[90vh]">
                                                    <button @click="openEditModal = false" class="absolute top-3 right-3 text-yellow-400 hover:text-yellow-700 text-2xl font-bold transition">&times;</button>
                                                    <h2 class="text-xl font-extrabold mb-6 text-yellow-700 text-center tracking-wide">Edit Baptismal Record</h2>
                                                    <template x-if="showSuccess">
                                                        <div class="mb-4 p-2 bg-green-100 border border-green-400 text-green-800 rounded text-center transition-opacity duration-500" x-text="successMsg"></div>
                                                    </template>
                                                    <template x-if="selected">
                                                        <form class="space-y-3 text-base" @submit.prevent="
                                                            if(selected && selected.id){
                                                                fetch('/users/update-baptism-record/' + selected.id, {
                                                                    method: 'POST',
                                                                    headers: {
                                                                        'Content-Type': 'application/json',
                                                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                                        'Accept': 'application/json',
                                                                    },
                                                                    body: JSON.stringify(selected)
                                                                })
                                                                .then(res => res.json())
                                                                .then(data => {
                                                                    if(data.success){
                                                                        showSuccess = true;
                                                                        successMsg = data.message;
                                                                        setTimeout(() => {
                                                                            openEditModal = false;
                                                                            window.location.reload();
                                                                        }, 4000); // Increased to 4 seconds to match the message duration
                                                                    } else {
                                                                        alert('Update failed!');
                                                                    }
                                                                })
                                                                .catch(() => alert('Update failed!'));
                                                            }
                                                        ">
                                                            <div class="flex flex-col">
                                                                <label class="font-semibold text-yellow-900 mb-1">Name</label>
                                                                <input type="text" x-model="selected.name" class="form-input rounded border border-yellow-300" />
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Birth Date</label>
                                                                    <input type="date" x-model="selected.Birth_Date" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Baptism Date</label>
                                                                    <input type="date" x-model="selected.Baptism_Date" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Father's Name</label>
                                                                    <input type="text" x-model="selected.Fathers_Name" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Mother's Name</label>
                                                                    <input type="text" x-model="selected.Mothers_Name" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Church Name</label>
                                                                    <input type="text" x-model="selected.Church_Name" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Sponsor</label>
                                                                    <input type="text" x-model="selected.Sponsor" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Secondary Sponsor</label>
                                                                    <input type="text" x-model="selected.Secondary_Sponsor" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Priest Name</label>
                                                                    <input type="text" x-model="selected.Priest_Name" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Book Number</label>
                                                                    <input type="number" x-model="selected.Book_Number" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Page Number</label>
                                                                    <input type="number" x-model="selected.Page_Number" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-yellow-900 mb-1">Line Number</label>
                                                                    <input type="number" x-model="selected.Line_Number" class="form-input rounded border border-yellow-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex justify-end pt-2">
                                                                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg shadow transition">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Marriage Records Card -->
                        <div x-data="{ openMarriageModal: false, openMarriageEditModal: false, selectedMarriage: null }" class="bg-green-100 rounded-lg shadow p-4 flex flex-col justify-between min-h-[350px] max-h-[500px] overflow-y-auto">
                            <div class="text-lg font-bold text-green-800 mb-2">Marriage Records</div>
                            <div class="flex-1 overflow-auto">
                                @php
                                    $marriageRecords = \App\Models\WeddingRecord::all();
                                @endphp
                                @if($marriageRecords->isEmpty())
                                    <p class="text-gray-600">No marriage records found.</p>
                                @else
                                    <table class="min-w-full table-auto border border-gray-300 text-xs md:text-sm">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-2 py-1 border">Husband</th>
                                                <th class="px-2 py-1 border">Wife</th>
                                                <th class="px-2 py-1 border">Date</th>
                                                <th class="px-2 py-1 border">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($marriageRecords as $record)
                                                <tr class="border-t">
                                                    <td class="px-2 py-1 border">{{ $record->husband_name }}</td>
                                                    <td class="px-2 py-1 border">{{ $record->wife_name }}</td>
                                                    <td class="px-2 py-1 border">{{ \Carbon\Carbon::parse($record->date_of_marriage)->format('F d, Y') }}</td>
                                                    <td class="px-2 py-1 border space-x-2">
                                                        <button @click="openMarriageModal = true; selectedMarriage = {{ json_encode($record) }}" type="button" class="inline-block bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs">View</button>
                                                        <button @click="openMarriageEditModal = true; selectedMarriage = {{ json_encode($record) }}" type="button" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">Edit</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Marriage View Modal -->
                                    <div x-show="openMarriageModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                        <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                            <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-green-200 w-full overflow-y-auto max-h-[90vh]">
                                                <button @click="openMarriageModal = false" class="absolute top-3 right-3 text-green-400 hover:text-green-700 text-2xl font-bold transition">&times;</button>
                                                <h2 class="text-xl font-extrabold mb-6 text-green-700 text-center tracking-wide">Marriage Record Details</h2>
                                                <template x-if="selectedMarriage">
                                                    <div class="space-y-3 text-base">
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Year:</span> <span x-text="selectedMarriage.year"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Date of Marriage:</span> <span x-text="selectedMarriage.date_of_marriage"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Husband's Name:</span> <span x-text="selectedMarriage.husband_name"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Wife's Name:</span> <span x-text="selectedMarriage.wife_name"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Husband's Status:</span> <span x-text="selectedMarriage.husband_status"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Wife's Status:</span> <span x-text="selectedMarriage.wife_status"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Husband's Age:</span> <span x-text="selectedMarriage.husband_age"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Wife's Age:</span> <span x-text="selectedMarriage.wife_age"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Municipality:</span> <span x-text="selectedMarriage.municipality"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Barangay:</span> <span x-text="selectedMarriage.barangay"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Husband's Parents:</span> <span x-text="selectedMarriage.husband_parents"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Wife's Parents:</span> <span x-text="selectedMarriage.wife_parents"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Sponsor 1:</span> <span x-text="selectedMarriage.sponsor1"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Sponsor 2:</span> <span x-text="selectedMarriage.sponsor2"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Place of Sponsor:</span> <span x-text="selectedMarriage.place_of_sponsor"></span></div>
                                                        <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-green-900">Presider:</span> <span x-text="selectedMarriage.presider"></span></div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Marriage Edit Modal -->
                                    <div x-data="{ showMarriageSuccess: false, marriageSuccessMsg: '' }" x-init="
                                        $watch('showMarriageSuccess', value => {
                                            if(value) setTimeout(() => showMarriageSuccess = false, 4000);
                                        })
                                    " class="relative">
                                        <div x-show="openMarriageEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                            <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                                <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-green-200 w-full overflow-y-auto max-h-[90vh]">
                                                    <button @click="openMarriageEditModal = false" class="absolute top-3 right-3 text-green-400 hover:text-green-700 text-2xl font-bold transition">&times;</button>
                                                    <h2 class="text-xl font-extrabold mb-6 text-green-700 text-center tracking-wide">Edit Marriage Record</h2>
                                                    <template x-if="showMarriageSuccess">
                                                        <div class="mb-4 p-2 bg-green-100 border border-green-400 text-green-800 rounded text-center transition-opacity duration-500" x-text="marriageSuccessMsg"></div>
                                                    </template>
                                                    <template x-if="selectedMarriage">
                                                        <form class="space-y-3 text-base" @submit.prevent="
                                                            if(selectedMarriage && selectedMarriage.id){
                                                                fetch('/users/update-wedding-record/' + selectedMarriage.id, {
                                                                    method: 'POST',
                                                                    headers: {
                                                                        'Content-Type': 'application/json',
                                                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                                        'Accept': 'application/json',
                                                                    },
                                                                    body: JSON.stringify(selectedMarriage)
                                                                })
                                                                .then(res => res.json())
                                                                .then(data => {
                                                                    if(data.success){
                                                                        showMarriageSuccess = true;
                                                                        marriageSuccessMsg = data.message;
                                                                        setTimeout(() => {
                                                                            openMarriageEditModal = false;
                                                                            window.location.reload();
                                                                        }, 4000);
                                                                    } else {
                                                                        alert('Update failed!');
                                                                    }
                                                                })
                                                                .catch(() => alert('Update failed!'));
                                                            }
                                                        ">
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Year</label>
                                                                    <input type="number" x-model="selectedMarriage.year" class="form-input rounded border border-green-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Date of Marriage</label>
                                                                    <input type="date" x-model="selectedMarriage.date_of_marriage" class="form-input rounded border border-green-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Husband's Name</label>
                                                                    <input type="text" x-model="selectedMarriage.husband_name" class="form-input rounded border border-green-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Wife's Name</label>
                                                                    <input type="text" x-model="selectedMarriage.wife_name" class="form-input rounded border border-green-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Husband's Status</label>
                                                                    <input type="text" x-model="selectedMarriage.husband_status" class="form-input rounded border border-green-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Wife's Status</label>
                                                                    <input type="text" x-model="selectedMarriage.wife_status" class="form-input rounded border border-green-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Husband's Age</label>
                                                                    <input type="number" x-model="selectedMarriage.husband_age" class="form-input rounded border border-green-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Wife's Age</label>
                                                                    <input type="number" x-model="selectedMarriage.wife_age" class="form-input rounded border border-green-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Municipality</label>
                                                                    <input type="text" x-model="selectedMarriage.municipality" class="form-input rounded border border-green-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Barangay</label>
                                                                    <input type="text" x-model="selectedMarriage.barangay" class="form-input rounded border border-green-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Husband's Parents</label>
                                                                    <input type="text" x-model="selectedMarriage.husband_parents" class="form-input rounded border border-green-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Wife's Parents</label>
                                                                    <input type="text" x-model="selectedMarriage.wife_parents" class="form-input rounded border border-green-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Sponsor 1</label>
                                                                    <input type="text" x-model="selectedMarriage.sponsor1" class="form-input rounded border border-green-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Sponsor 2</label>
                                                                    <input type="text" x-model="selectedMarriage.sponsor2" class="form-input rounded border border-green-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row gap-2">
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Place of Sponsor</label>
                                                                    <input type="text" x-model="selectedMarriage.place_of_sponsor" class="form-input rounded border border-green-300" />
                                                                </div>
                                                                <div class="flex-1 flex flex-col">
                                                                    <label class="font-semibold text-green-900 mb-1">Presider</label>
                                                                    <input type="text" x-model="selectedMarriage.presider" class="form-input rounded border border-green-300" />
                                                                </div>
                                                            </div>
                                                            <div class="flex justify-end pt-2">
                                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow transition">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Burial Records Card -->
                        <div class="bg-yellow-100 rounded-lg shadow p-4 flex flex-col justify-between min-h-[350px] max-h-[500px] overflow-y-auto">
                            <div>
                                <div class="text-lg font-bold text-yellow-800 mb-2">Burial Records</div>
                                <p class="text-gray-600">No data yet.</p>
                            </div>
                        </div>
                        <!-- Confirmation Records Card -->
                        <div class="bg-purple-100 rounded-lg shadow p-4 flex flex-col justify-between min-h-[350px] max-h-[500px] overflow-y-auto">
                            <div>
                                <div class="text-lg font-bold text-purple-800 mb-2">Confirmation Records</div>
                                <p class="text-gray-600">No data yet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcan
