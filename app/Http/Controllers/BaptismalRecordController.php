<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaptismalRecord;
class BaptismalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //haan mo met inusar atuy nga method isu useless

        //    $baptismalRecords = BaptismalRecord::all();
        //    dd($baptismalRecords);
        // return view('secretary.baptismal.index', compact('baptismalRecords'));

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
          $baptismalRecords = BaptismalRecord::all();
        return view('Users.baptismal.index', compact('baptismalRecords'));
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
