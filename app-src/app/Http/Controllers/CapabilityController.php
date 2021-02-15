<?php

namespace App\Http\Controllers;

use App\Capability;
use Illuminate\Http\Request;

class CapabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $capabilities = Capability::all();
      return view('administration.capabilities.index')->with(['capabilities' => $capabilities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('administration.capabilities.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $capability = Capability::where('id', $id)->first();
      return view('administration.capabilities.show')->with(['capability' => $capability]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $capability = Capability::where('id', $id)->first();
      return view('administration.capabilities.edit')->with(['capability' => $capability]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
