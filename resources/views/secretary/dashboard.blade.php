@can('secretary-access')
    @extends('layouts.Users.app')

    @section('content')
        <div class="py-8 bg-gray-50 min-h-screen">
            <div class="max-w-6xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="bg-white shadow rounded-2xl p-4 md:p-8">
                    <div class="flex flex-col gap-6">
                        <!-- Records Dashboard Header -->
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Records Dashboard</h2>
                            <button id="toggleRecordsDashboard" class="text-sm px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Show/Hide</button>
                        </div>
                        <!-- Records Cards -->
                        <div id="RecordsDashboard" class="grid grid-cols-1 md:grid-cols-2 gap-6" style="display:none;">
                            <!-- Baptismal Records Card -->
                            <div x-data="{ openModal: false, openEditModal: false, selected: null }" class="bg-white border border-blue-100 rounded-xl shadow-sm p-4 flex flex-col min-h-[250px]">
                                <div class="flex items-center mb-2">
                                    <span class="text-lg font-semibold text-blue-700">Baptismal Records</span>
                                </div>
                                <div class="flex-1 overflow-x-auto">
                                    @if($baptismalRecords->isEmpty())
                                        <p class="text-gray-400 text-sm">No baptismal records found.</p>
                                    @else
                                        <table class="w-full text-xs md:text-sm border-separate border-spacing-y-1">
                                            <thead>
                                                <tr class="bg-blue-50 text-blue-900">
                                                    <th class="px-2 py-1 text-left">Name</th>
                                                    <th class="px-2 py-1 text-left">Birth Date</th>
                                                    <th class="px-2 py-1 text-left">Baptism Date</th>
                                                    <th class="px-2 py-1 text-left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($baptismalRecords as $record)
                                                    <tr class="bg-white hover:bg-blue-50 rounded transition">
                                                        <td class="px-2 py-1">{{ $record->name }}</td>
                                                        <td class="px-2 py-1">{{ \Carbon\Carbon::parse($record->Birth_Date)->format('F d, Y') }}</td>
                                                        <td class="px-2 py-1">{{ \Carbon\Carbon::parse($record->Baptism_Date)->format('F d, Y') }}</td>
                                                        <td class="px-2 py-1 space-x-1">
                                                            <button @click="openModal = true; selected = {{ json_encode($record) }}" type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs">View</button>
                                                            <button @click="openEditModal = true; selected = {{ json_encode($record) }}" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">Edit</button>
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
                                                                    .then data => {
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
                            <div x-data="{ openMarriageModal: false, openMarriageEditModal: false, selectedMarriage: null }" class="bg-white border border-green-100 rounded-xl shadow-sm p-4 flex flex-col min-h-[250px]">
                                <div class="flex items-center mb-2">
                                    <span class="text-lg font-semibold text-green-700">Marriage Records</span>
                                </div>
                                <div class="flex-1 overflow-x-auto">
                                    @php
                                        $marriageRecords = \App\Models\WeddingRecord::all();
                                    @endphp
                                    @if($marriageRecords->isEmpty())
                                        <p class="text-gray-400 text-sm">No marriage records found.</p>
                                    @else
                                        <table class="w-full text-xs md:text-sm border-separate border-spacing-y-1">
                                            <thead>
                                                <tr class="bg-green-50 text-green-900">
                                                    <th class="px-2 py-1 text-left">Husband</th>
                                                    <th class="px-2 py-1 text-left">Wife</th>
                                                    <th class="px-2 py-1 text-left">Date</th>
                                                    <th class="px-2 py-1 text-left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($marriageRecords as $record)
                                                    <tr class="bg-white hover:bg-green-50 rounded transition">
                                                        <td class="px-2 py-1">{{ $record->husband_name }}</td>
                                                        <td class="px-2 py-1">{{ $record->wife_name }}</td>
                                                        <td class="px-2 py-1">{{ \Carbon\Carbon::parse($record->date_of_marriage)->format('F d, Y') }}</td>
                                                        <td class="px-2 py-1 space-x-1">
                                                            <button @click="openMarriageModal = true; selectedMarriage = {{ json_encode($record) }}" type="button" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs">View</button>
                                                            <button @click="openMarriageEditModal = true; selectedMarriage = {{ json_encode($record) }}" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">Edit</button>
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
                            <div x-data="{ openBurialModal: false, openBurialEditModal: false, selectedBurial: null }" class="bg-white border border-yellow-100 rounded-xl shadow-sm p-4 flex flex-col min-h-[250px]">
                                <div class="flex items-center mb-2">
                                    <span class="text-lg font-semibold text-yellow-700">Burial Records</span>
                                </div>
                                <div class="flex-1 overflow-x-auto">
                                    @php
                                        $burialRecords = \App\Models\BurialRecord::all();
                                    @endphp
                                    @if($burialRecords->isEmpty())
                                        <p class="text-gray-400 text-sm">No burial records found.</p>
                                    @else
                                        <table class="w-full text-xs md:text-sm border-separate border-spacing-y-1">
                                            <thead>
                                                <tr class="bg-yellow-50 text-yellow-900">
                                                    <th class="px-2 py-1 text-left">Name</th>
                                                    <th class="px-2 py-1 text-left">Date of Death</th>
                                                    <th class="px-2 py-1 text-left">Date of Burial</th>
                                                    <th class="px-2 py-1 text-left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($burialRecords as $record)
                                                    <tr class="bg-white hover:bg-yellow-50 rounded transition">
                                                        <td class="px-2 py-1">{{ $record->name }}</td>
                                                        <td class="px-2 py-1">{{ \Carbon\Carbon::parse($record->date_of_death)->format('F d, Y') }}</td>
                                                        <td class="px-2 py-1">{{ \Carbon\Carbon::parse($record->date_of_burial)->format('F d, Y') }}</td>
                                                        <td class="px-2 py-1 space-x-2">
                                                            <button @click="selectedBurial = {{ $record->toJson() }}; openBurialModal = true" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">View</button>
                                                            <button @click="selectedBurial = {{ $record->toJson() }}; openBurialEditModal = true" class="bg-yellow-700 hover:bg-yellow-800 text-white px-2 py-1 rounded">Edit</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- Burial View Modal -->
                                        <div x-show="openBurialModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                            <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                                <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-yellow-200 w-full overflow-y-auto max-h-[90vh]">
                                                    <button @click="openBurialModal = false" class="absolute top-3 right-3 text-yellow-400 hover:text-yellow-700 text-2xl font-bold transition">&times;</button>
                                                    <h2 class="text-xl font-extrabold mb-6 text-yellow-700 text-center tracking-wide">Burial Record Details</h2>
                                                    <template x-if="selectedBurial">
                                                        <div class="space-y-3 text-base">
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-yellow-900">Name:</span> <span x-text="selectedBurial.name"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-yellow-900">Date of Death:</span> <span x-text="selectedBurial.date_of_death"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-yellow-900">Date of Burial:</span> <span x-text="selectedBurial.date_of_burial"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-yellow-900">Age:</span> <span x-text="selectedBurial.age"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-yellow-900">Status:</span> <span x-text="selectedBurial.status"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-yellow-900">Informant:</span> <span x-text="selectedBurial.informant"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-yellow-900">Place:</span> <span x-text="selectedBurial.place"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-yellow-900">Presider:</span> <span x-text="selectedBurial.presider"></span></div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Burial Edit Modal -->
                                        <div x-data="{ showBurialSuccess: false, burialSuccessMsg: '' }" x-init="
                                            $watch('showBurialSuccess', value => {
                                                if(value) setTimeout(() => showBurialSuccess = false, 4000);
                                            })
                                        " class="relative">
                                            <div x-show="openBurialEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                                <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                                    <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-yellow-200 w-full overflow-y-auto max-h-[90vh]">
                                                        <button @click="openBurialEditModal = false" class="absolute top-3 right-3 text-yellow-400 hover:text-yellow-700 text-2xl font-bold transition">&times;</button>
                                                        <h2 class="text-xl font-extrabold mb-6 text-yellow-700 text-center tracking-wide">Edit Burial Record</h2>
                                                        <template x-if="showBurialSuccess">
                                                            <div class="mb-4 p-2 bg-yellow-100 border border-yellow-400 text-yellow-800 rounded text-center transition-opacity duration-500" x-text="burialSuccessMsg"></div>
                                                        </template>
                                                        <template x-if="selectedBurial">
                                                            <form class="space-y-3 text-base" @submit.prevent="
                                                                if(selectedBurial && selectedBurial.id){
                                                                    fetch('/users/update-burial-record/' + selectedBurial.id, {
                                                                        method: 'POST',
                                                                        headers: {
                                                                            'Content-Type': 'application/json',
                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                                            'Accept': 'application/json',
                                                                        },
                                                                        body: JSON.stringify(selectedBurial)
                                                                    })
                                                                    .then(res => res.json())
                                                                    .then(data => {
                                                                        if(data.success){
                                                                            showBurialSuccess = true;
                                                                            burialSuccessMsg = data.message;
                                                                            setTimeout(() => {
                                                                                openBurialEditModal = false;
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
                                                                        <label class="font-semibold text-yellow-900 mb-1">Name</label>
                                                                        <input type="text" x-model="selectedBurial.name" class="form-input rounded border border-yellow-300" />
                                                                    </div>
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-yellow-900 mb-1">Date of Death</label>
                                                                        <input type="date" x-model="selectedBurial.date_of_death" class="form-input rounded border border-yellow-300" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-col sm:flex-row gap-2">
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-yellow-900 mb-1">Date of Burial</label>
                                                                        <input type="date" x-model="selectedBurial.date_of_burial" class="form-input rounded border border-yellow-300" />
                                                                    </div>
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-yellow-900 mb-1">Age</label>
                                                                        <input type="number" x-model="selectedBurial.age" class="form-input rounded border border-yellow-300" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-col sm:flex-row gap-2">
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-yellow-900 mb-1">Status</label>
                                                                        <input type="text" x-model="selectedBurial.status" class="form-input rounded border border-yellow-300" />
                                                                    </div>
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-yellow-900 mb-1">Informant</label>
                                                                        <input type="text" x-model="selectedBurial.informant" class="form-input rounded border border-yellow-300" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-col sm:flex-row gap-2">
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-yellow-900 mb-1">Place</label>
                                                                        <input type="text" x-model="selectedBurial.place" class="form-input rounded border border-yellow-300" />
                                                                    </div>
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-yellow-900 mb-1">Presider</label>
                                                                        <input type="text" x-model="selectedBurial.presider" class="form-input rounded border border-yellow-300" />
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
                            <!-- Confirmation Records Card -->
                            <div x-data="{ openConfirmModal: false, openConfirmEditModal: false, selectedConfirm: null }" class="bg-white border border-purple-100 rounded-xl shadow-sm p-4 flex flex-col min-h-[250px]">
                                <div class="flex items-center mb-2">
                                    <span class="text-lg font-semibold text-purple-700">Confirmation Records</span>
                                </div>
                                <div class="flex-1 overflow-x-auto">
                                    @php
                                        $confirmationRecords = \App\Models\ConfirmationRecord::all();
                                    @endphp
                                    @if($confirmationRecords->isEmpty())
                                        <p class="text-gray-400 text-sm">No confirmation records found.</p>
                                    @else
                                        <table class="w-full text-xs md:text-sm border-separate border-spacing-y-1">
                                            <thead>
                                                <tr class="bg-purple-50 text-purple-900">
                                                    <th class="px-2 py-1 text-left">Name</th>
                                                    <th class="px-2 py-1 text-left">Date of Confirmation</th>
                                                    <th class="px-2 py-1 text-left">Year</th>
                                                    <th class="px-2 py-1 text-left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($confirmationRecords as $record)
                                                    <tr class="bg-white hover:bg-purple-50 rounded transition">
                                                        <td class="px-2 py-1">{{ $record->name }}</td>
                                                        <td class="px-2 py-1">{{ \Carbon\Carbon::parse($record->date_of_confirmation)->format('F d, Y') }}</td>
                                                        <td class="px-2 py-1">{{ $record->year }}</td>
                                                        <td class="px-2 py-1 border-r space-x-2">
                                                            <button @click="selectedConfirm = {{ $record->toJson() }}; openConfirmModal = true" class="bg-purple-500 hover:bg-purple-600 text-white px-2 py-1 rounded">View</button>
                                                            <button @click="selectedConfirm = {{ $record->toJson() }}; openConfirmEditModal = true" class="bg-purple-700 hover:bg-purple-800 text-white px-2 py-1 rounded">Edit</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- Confirmation View Modal -->
                                        <div x-show="openConfirmModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                            <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                                <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-purple-200 w-full overflow-y-auto max-h-[90vh]">
                                                    <button @click="openConfirmModal = false" class="absolute top-3 right-3 text-purple-400 hover:text-purple-700 text-2xl font-bold transition">&times;</button>
                                                    <h2 class="text-xl font-extrabold mb-6 text-purple-700 text-center tracking-wide">Confirmation Record Details</h2>
                                                    <template x-if="selectedConfirm">
                                                        <div class="space-y-3 text-base">
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Name:</span> <span x-text="selectedConfirm.name"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Year:</span> <span x-text="selectedConfirm.year"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Date of Confirmation:</span> <span x-text="selectedConfirm.date_of_confirmation"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Parish of Baptism:</span> <span x-text="selectedConfirm.parish_of_baptism"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Province of Baptism:</span> <span x-text="selectedConfirm.province_of_baptism"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Place of Baptism:</span> <span x-text="selectedConfirm.place_of_baptism"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Parents:</span> <span x-text="selectedConfirm.parents"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Sponsor:</span> <span x-text="selectedConfirm.sponsor"></span></div>
                                                            <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-purple-900">Name of Minister:</span> <span x-text="selectedConfirm.name_of_minister"></span></div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Confirmation Edit Modal -->
                                        <div x-data="{ showConfirmSuccess: false, confirmSuccessMsg: '' }" x-init="
                                            $watch('showConfirmSuccess', value => {
                                                if(value) setTimeout(() => showConfirmSuccess = false, 4000);
                                            })
                                        " class="relative">
                                            <div x-show="openConfirmEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                                <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                                    <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-purple-200 w-full overflow-y-auto max-h-[90vh]">
                                                        <button @click="openConfirmEditModal = false" class="absolute top-3 right-3 text-purple-400 hover:text-purple-700 text-2xl font-bold transition">&times;</button>
                                                        <h2 class="text-xl font-extrabold mb-6 text-purple-700 text-center tracking-wide">Edit Confirmation Record</h2>
                                                        <template x-if="showConfirmSuccess">
                                                            <div class="mb-4 p-2 bg-purple-100 border border-purple-400 text-purple-800 rounded text-center transition-opacity duration-500" x-text="confirmSuccessMsg"></div>
                                                        </template>
                                                        <template x-if="selectedConfirm">
                                                            <form class="space-y-3 text-base" @submit.prevent="
                                                                if(selectedConfirm && selectedConfirm.id){
                                                                    fetch('/users/update-confirmation-record/' + selectedConfirm.id, {
                                                                        method: 'POST',
                                                                        headers: {
                                                                            'Content-Type': 'application/json',
                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                                            'Accept': 'application/json',
                                                                        },
                                                                        body: JSON.stringify(selectedConfirm)
                                                                    })
                                                                    .then(res => res.json())
                                                                    .then(data => {
                                                                        if(data.success){
                                                                            showConfirmSuccess = true;
                                                                            confirmSuccessMsg = data.message;
                                                                            setTimeout(() => {
                                                                                openConfirmEditModal = false;
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
                                                                        <label class="font-semibold text-purple-900 mb-1">Name</label>
                                                                        <input type="text" x-model="selectedConfirm.name" class="form-input rounded border border-purple-300" />
                                                                    </div>
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-purple-900 mb-1">Year</label>
                                                                        <input type="number" x-model="selectedConfirm.year" class="form-input rounded border border-purple-300" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-col sm:flex-row gap-2">
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-purple-900 mb-1">Date of Confirmation</label>
                                                                        <input type="date" x-model="selectedConfirm.date_of_confirmation" class="form-input rounded border border-purple-300" />
                                                                    </div>
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-purple-900 mb-1">Parish of Baptism</label>
                                                                        <input type="text" x-model="selectedConfirm.parish_of_baptism" class="form-input rounded border border-purple-300" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-col sm:flex-row gap-2">
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-purple-900 mb-1">Province of Baptism</label>
                                                                        <input type="text" x-model="selectedConfirm.province_of_baptism" class="form-input rounded border border-purple-300" />
                                                                    </div>
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-purple-900 mb-1">Place of Baptism</label>
                                                                        <input type="text" x-model="selectedConfirm.place_of_baptism" class="form-input rounded border border-purple-300" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-col sm:flex-row gap-2">
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-purple-900 mb-1">Parents</label>
                                                                        <input type="text" x-model="selectedConfirm.parents" class="form-input rounded border border-purple-300" />
                                                                    </div>
                                                                    <div class="flex-1 flex flex-col">
                                                                        <label class="font-semibold text-purple-900 mb-1">Sponsor</label>
                                                                        <input type="text" x-model="selectedConfirm.sponsor" class="form-input rounded border border-purple-300" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex flex-col">
                                                                    <label class="font-semibold text-purple-900 mb-1">Name of Minister</label>
                                                                    <input type="text" x-model="selectedConfirm.name_of_minister" class="form-input rounded border border-purple-300" />
                                                                </div>
                                                                <div class="flex justify-end pt-2">
                                                                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg shadow transition">Save Changes</button>
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
                        </div>
                    </div>
                </div>
                <!-- Schedules Card moved outside Records Dashboard -->
                <div class="max-w-6xl mx-auto px-2 sm:px-6 lg:px-8 mt-8">
                    <div x-data="{ openScheduleModal: false, openScheduleEditModal: false, selectedSchedule: null, showScheduleSuccess: false, scheduleSuccessMsg: '' }" class="bg-white border border-indigo-100 rounded-xl shadow-sm p-4 flex flex-col min-h-[250px]">
                        <div class="flex items-center mb-2">
                            <span class="text-lg font-semibold text-indigo-700">Schedules</span>
                        </div>
                        <div class="flex-1 overflow-x-auto">
                            @php
                                $schedules = \App\Models\Schedule::with('event', 'user')->latest()->get();
                            @endphp
                            @if($schedules->isEmpty())
                                <p class="text-gray-400 text-sm">No schedules found.</p>
                            @else
                                <table class="w-full text-xs md:text-sm border-separate border-spacing-y-1">
                                    <thead>
                                        <tr class="bg-indigo-50 text-indigo-900">
                                            <th class="px-2 py-1 text-left">Event</th>
                                            <th class="px-2 py-1 text-left">Reserved By</th>
                                            <th class="px-2 py-1 text-left">Date</th>
                                            <th class="px-2 py-1 text-left">Time</th>
                                            <th class="px-2 py-1 text-left">Status</th>
                                            <th class="px-2 py-1 text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($schedules as $schedule)
                                            <tr class="bg-white hover:bg-indigo-50 rounded transition">
                                                <td class="px-2 py-1">{{ $schedule->event ? $schedule->event->name : '-' }}</td>
                                                <td class="px-2 py-1">{{ $schedule->user ? $schedule->user->name : '-' }}</td>
                                                <td class="px-2 py-1">{{ $schedule->reservation_date ? \Carbon\Carbon::parse($schedule->reservation_date)->format('F d, Y') : '-' }}</td>
                                                <td class="px-2 py-1">{{ $schedule->reservation_time ? date('h:i A', strtotime($schedule->reservation_time)) : '-' }}</td>
                                                <td class="px-2 py-1 capitalize">{{ $schedule->status }}</td>
                                                <td class="px-2 py-1 space-x-1">
                                                    <button @click="openScheduleModal = true; selectedSchedule = {{ json_encode($schedule) }}" type="button" class="bg-indigo-500 hover:bg-indigo-600 text-white px-2 py-1 rounded text-xs">View</button>
                                                    <button @click="openScheduleEditModal = true; selectedSchedule = {{ json_encode($schedule) }}" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">Edit</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Schedule View Modal -->
                                <div x-show="openScheduleModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                    <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                        <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-indigo-200 w-full overflow-y-auto max-h-[90vh]">
                                            <button @click="openScheduleModal = false" class="absolute top-3 right-3 text-indigo-400 hover:text-indigo-700 text-2xl font-bold transition">&times;</button>
                                            <h2 class="text-xl font-extrabold mb-6 text-indigo-700 text-center tracking-wide">Schedule Details</h2>
                                            <template x-if="selectedSchedule">
                                                <div class="space-y-3 text-base">
                                                    <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-indigo-900">Event:</span> <span x-text="selectedSchedule.event ? selectedSchedule.event.name : '-' "></span></div>
                                                    <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-indigo-900">Reserved By:</span> <span x-text="selectedSchedule.user ? selectedSchedule.user.name : '-' "></span></div>
                                                    <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-indigo-900">Date:</span> <span x-text="selectedSchedule.reservation_date"></span></div>
                                                    <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-indigo-900">Time:</span> <span x-text="selectedSchedule.reservation_time"></span></div>
                                                    <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-indigo-900">Number of People:</span> <span x-text="selectedSchedule.number_of_people"></span></div>
                                                    <div class="flex flex-col sm:flex-row justify-between"><span class="font-semibold text-indigo-900">Status:</span> <span x-text="selectedSchedule.status"></span></div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div> 
                                <!-- Schedule Edit Modal -->
                                <div x-show="openScheduleEditModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 px-2 sm:px-0">
                                    <div class="relative w-full max-w-md sm:max-w-lg md:max-w-xl">
                                        <div class="relative bg-white bg-opacity-95 rounded-2xl shadow-2xl p-4 sm:p-8 border border-yellow-200 w-full overflow-y-auto max-h-[90vh]">
                                            <button @click="openScheduleEditModal = false" class="absolute top-3 right-3 text-yellow-400 hover:text-yellow-700 text-2xl font-bold transition">&times;</button>
                                            <h2 class="text-xl font-extrabold mb-6 text-yellow-700 text-center tracking-wide">Edit Schedule</h2>
                                            <template x-if="showScheduleSuccess">
                                                <div class="mb-4 p-2 bg-yellow-100 border border-yellow-400 text-yellow-800 rounded text-center transition-opacity duration-500" x-text="scheduleSuccessMsg"></div>
                                            </template>
                                            <template x-if="selectedSchedule">
                                                <form class="space-y-3 text-base" @submit.prevent="
                                                    if(selectedSchedule && selectedSchedule.id){
                                                        fetch('/users/update-schedule/' + selectedSchedule.id, {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json',
                                                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                                'Accept': 'application/json',
                                                            },
                                                            body: JSON.stringify(selectedSchedule)
                                                        })
                                                        .then(res => res.json())
                                                        .then data => {
                                                            if(data.success){
                                                                showScheduleSuccess = true;
                                                                scheduleSuccessMsg = data.message;
                                                                setTimeout(() => {
                                                                    openScheduleEditModal = false;
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
                                                            <label class="font-semibold text-yellow-900 mb-1">Date</label>
                                                            <input type="date" x-model="selectedSchedule.reservation_date" class="form-input rounded border border-yellow-300" />
                                                        </div>
                                                        <div class="flex-1 flex flex-col">
                                                            <label class="font-semibold text-yellow-900 mb-1">Time</label>
                                                            <input type="time" x-model="selectedSchedule.reservation_time" class="form-input rounded border border-yellow-300" />
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col sm:flex-row gap-2">
                                                        <div class="flex-1 flex flex-col">
                                                            <label class="font-semibold text-yellow-900 mb-1">Number of People</label>
                                                            <input type="number" x-model="selectedSchedule.number_of_people" class="form-input rounded border border-yellow-300" />
                                                        </div>
                                                        <div class="flex-1 flex flex-col">
                                                            <label class="font-semibold text-yellow-900 mb-1">Status</label>
                                                            <select x-model="selectedSchedule.status" class="form-input rounded border border-yellow-300">
                                                                <option value="pending">Pending</option>
                                                                <option value="approved">Approved</option>
                                                                <option value="rejected">Rejected</option>
                                                            </select>
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dashboard = document.getElementById('RecordsDashboard');
                const toggleBtn = document.getElementById('toggleRecordsDashboard');
                let dashboardVisible = false;
                toggleBtn.addEventListener('click', function() {
                    dashboardVisible = !dashboardVisible;
                    dashboard.style.display = dashboardVisible ? 'grid' : 'none';
                });
            });
        </script>
    @endsection
@endcan
