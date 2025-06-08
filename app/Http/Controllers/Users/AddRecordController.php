<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function baptismalform()
    {
        //dd(auth()->user()->roles); // or dd(auth()->user()->roles[0]->name);
        return view('secretary.baptismal.index');

    }


    public function SaveBapRecord(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'Birth_Date' => 'required|date',
            'Baptism_Date' => 'required|date',
            'Fathers_Name' => 'required|string|max:255',
            'Mothers_Name' => 'required|string|max:255',
            'Church_Name' => 'required|string|max:255',
            'Sponsor' => 'nullable|string|max:255',
            'Secondary_Sponsor' => 'nullable|string|max:255',
            'Priest_Name' => 'required|string|max:255',
            'Book_Number' => 'required|integer',
            'Page_Number' => 'required|integer',
            'Line_Number' => 'required|integer',
        ]);

        // Save the record
        \App\Models\BaptismalRecord::create($validated);

        return redirect()->back()->with('success', 'Baptismal record saved successfully!');
    }

    public function weddingform()
    {
        return view('secretary.wedding.wedding-form');
    }

    public function SaveWedRecord(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $validated = $request->validate([
            'year' => 'required|integer',
            'date_of_marriage' => 'required|date',
            'husband_name' => 'required|string|max:255',
            'wife_name' => 'required|string|max:255',
            'husband_status' => 'required|string|max:255',
            'wife_status' => 'required|string|max:255',
            'husband_age' => 'required|integer|min:0',
            'wife_age' => 'required|integer|min:0',
            'municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'husband_parents' => 'required|string|max:255',
            'wife_parents' => 'required|string|max:255',
            'sponsor1' => 'required|string|max:255',
            'sponsor2' => 'required|string|max:255',
            'place_of_sponsor' => 'required|string|max:255',
            'presider' => 'required|string|max:255',
        ]);

        // Save the record
        \App\Models\WeddingRecord::create($validated);

        return redirect()->back()->with('success', 'Wedding record saved successfully!');
    }

    public function updateBapRecord(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'Birth_Date' => 'required|date',
            'Baptism_Date' => 'required|date',
            'Fathers_Name' => 'required|string|max:255',
            'Mothers_Name' => 'required|string|max:255',
            'Church_Name' => 'required|string|max:255',
            'Sponsor' => 'nullable|string|max:255',
            'Secondary_Sponsor' => 'nullable|string|max:255',
            'Priest_Name' => 'required|string|max:255',
            'Book_Number' => 'required|integer',
            'Page_Number' => 'required|integer',
            'Line_Number' => 'required|integer',
        ]);

        $record = \App\Models\BaptismalRecord::findOrFail($id);
        $record->update($validated);

        // For AJAX, return JSON
        return response()->json(['success' => true, 'message' => 'Record updated successfully!', 'record' => $record]);
    }

    public function updateWedRecord(Request $request, $id)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'date_of_marriage' => 'required|date',
            'husband_name' => 'required|string|max:255',
            'wife_name' => 'required|string|max:255',
            'husband_status' => 'required|string|max:255',
            'wife_status' => 'required|string|max:255',
            'husband_age' => 'required|integer|min:0',
            'wife_age' => 'required|integer|min:0',
            'municipality' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'husband_parents' => 'required|string|max:255',
            'wife_parents' => 'required|string|max:255',
            'sponsor1' => 'required|string|max:255',
            'sponsor2' => 'required|string|max:255',
            'place_of_sponsor' => 'required|string|max:255',
            'presider' => 'required|string|max:255',
        ]);

        $record = \App\Models\WeddingRecord::findOrFail($id);
        $record->update($validated);

        return response()->json(['success' => true, 'message' => 'Wedding record updated successfully!', 'record' => $record]);
    }


    public function AddBurialRec(Request $request)
    {
        // Validate the request data based on the burial_records schema
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_death' => 'required|date',
            'date_of_burial' => 'required|date',
            'age' => 'nullable|integer',
            'status' => 'nullable|string|max:255',
            'informant' => 'nullable|string|max:255',
            'place' => 'nullable|string|max:255',
            'presider' => 'nullable|string|max:255',
        ]);

        // Save the record
        \App\Models\BurialRecord::create($validated);

        return redirect()->back()->with('success', 'Burial record saved successfully!');
    }
    public function burialform()
    {
        return view('secretary.burial.burial-form');
    }

    public function AddConfirmationRec(Request $request)
    {
        // Validate the request data based on the confirmation_records schema
        $validated = $request->validate([
            'year' => 'required|integer',
            'date_of_confirmation' => 'required|date',
            'name' => 'required|string|max:255',
            'parish_of_baptism' => 'nullable|string|max:255',
            'province_of_baptism' => 'nullable|string|max:255',
            'place_of_baptism' => 'nullable|string|max:255',
            'parents' => 'nullable|string|max:255',
            'sponsor' => 'nullable|string|max:255',
            'name_of_minister' => 'nullable|string|max:255',
        ]);

        // Save the record
        \App\Models\ConfirmationRecord::create($validated);

        return redirect()->back()->with('success', 'Confirmation record saved successfully!');
    }

    public function confirmform()
    {
        return view('secretary.confirmation.confirm-form');
    }
  
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateBurialRecord(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_death' => 'required|date',
            'date_of_burial' => 'required|date',
            'age' => 'nullable|integer',
            'status' => 'nullable|string|max:255',
            'informant' => 'nullable|string|max:255',
            'place' => 'nullable|string|max:255',
            'presider' => 'nullable|string|max:255',
        ]);

        $record = \App\Models\BurialRecord::findOrFail($id);
        $record->update($validated);

        return response()->json(['success' => true, 'message' => 'Burial record updated successfully!', 'record' => $record]);
    }

    public function updateConfirmationRecord(Request $request, $id)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'date_of_confirmation' => 'required|date',
            'name' => 'required|string|max:255',
            'parish_of_baptism' => 'nullable|string|max:255',
            'province_of_baptism' => 'nullable|string|max:255',
            'place_of_baptism' => 'nullable|string|max:255',
            'parents' => 'nullable|string|max:255',
            'sponsor' => 'nullable|string|max:255',
            'name_of_minister' => 'nullable|string|max:255',
        ]);

        $record = \App\Models\ConfirmationRecord::findOrFail($id);
        $record->update($validated);

        return response()->json(['success' => true, 'message' => 'Confirmation record updated successfully!', 'record' => $record]);
    }
}
