<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Http\Requests\StorePharmaciesRequest;
use App\Http\Requests\UpdatePharmaciesRequest;

class PharmaciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePharmaciesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pharmacy $pharmacies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePharmaciesRequest $request, Pharmacy $pharmacies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pharmacy $pharmacies)
    {
        //
    }
}
