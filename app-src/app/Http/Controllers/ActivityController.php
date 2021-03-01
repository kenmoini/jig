<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use App\Workshop;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($reportType=false, $reportTarget=false)
    {
        $data = [];
        if ($reportType) {
            $data['reportType'] = $reportType;
            if ($reportTarget && is_numeric($reportTarget)) {
                $data['reportTarget'] = $reportTarget;
            }
            switch ($reportType) {
                case "user":
                    if (isset($data['reportTarget'])) {
                        $data['user'] = User::where('id', $data['reportTarget'])->first();
                    }
                    else {
                        $data['users'] = User::all();
                    }
                break;
                case "workshop":
                    if (isset($data['reportTarget'])) {
                        $data['workshop'] = Workshop::where('id', $data['reportTarget'])->first();
                    }
                    else {
                        $data['workshops'] = Workshop::all();
                    }
                break;
                case "event":
                    if (isset($data['reportTarget'])) {
                        $data['event'] = Event::where('id', $data['reportTarget'])->first();
                    }
                    else {
                        $data['events'] = Event::all();
                    }
                break;
            }
        }

        return view('activity.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
