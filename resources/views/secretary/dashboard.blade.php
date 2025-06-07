@can('secretary-access')
    @extends('layouts.Users.app')

    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-xl font-semibold">
                        {{ __('BAPTISMAL RECORDS') }}
                    </div>

                    @php
                  // uray haan mo usaren atuy inlene nukuan jay web routes ka agquerry
                    //$baptismalRecords = DB::table('baptismal_records')->get();

                    @endphp

                   <div class="p-6 overflow-auto">
                        @if($baptismalRecords->isEmpty())
                            <p class="text-gray-600">No baptismal records found.</p>
                        @else
                            <table class="min-w-full table-auto border border-gray-300 text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-3 py-2 border">Name</th>
                                        <th class="px-3 py-2 border">Birth Date</th>
                                        <th class="px-3 py-2 border">Baptism Date</th>
                                        <th class="px-3 py-2 border">Father's Name</th>
                                        <th class="px-3 py-2 border">Mother's Name</th>
                                        <th class="px-3 py-2 border">Church Name</th>
                                        <th class="px-3 py-2 border">Sponsor</th>
                                        <th class="px-3 py-2 border">Secondary Sponsor</th>
                                        <th class="px-3 py-2 border">Priest Name</th>
                                        <th class="px-3 py-2 border">Book #</th>
                                        <th class="px-3 py-2 border">Page #</th>
                                        <th class="px-3 py-2 border">Line #</th>
                                        <th class="px-3 py-2 border">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($baptismalRecords as $record)
                                        <tr class="border-t">
                                            <td class="px-3 py-2 border">{{ $record->name }}</td>
                                            <td class="px-3 py-2 border">{{ \Carbon\Carbon::parse($record->Birth_Date)->format('F d, Y') }}</td>
                                            <td class="px-3 py-2 border">{{ \Carbon\Carbon::parse($record->Baptism_Date)->format('F d, Y') }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Fathers_Name }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Mothers_Name }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Church_Name }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Sponsor }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Secondary_Sponsor }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Priest_Name }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Book_Number }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Page_Number }}</td>
                                            <td class="px-3 py-2 border">{{ $record->Line_Number }}</td>
                                            <td class="px-3 py-2 border">
                                                {{-- <a href="{{ route('baptismal.show', $record->id) }}" class="text-blue-600 hover:underline">View</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcan
