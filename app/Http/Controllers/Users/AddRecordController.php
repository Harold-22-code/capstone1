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
}
