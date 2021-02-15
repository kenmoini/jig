<?php

namespace App\Http\Controllers;

use Redirect;
use App\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();
      return view('administration.users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //$groups = Group::all();
      //return view('administration.users.create')->with(['groups' => $groups]);
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
      $user = User::where('id', $id)->first();
      return view('administration.users.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::where('id', $id)->first();
      $groups = Group::all();
      return view('administration.users.edit')->with(['user' => $user, 'groups' => $groups]);
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
      // validate
      // read more on validation at http://laravel.com/docs/validation
      if (!empty($request->input('password'))) {
        $rules = array(
          'name'       => 'required|string|max:255',
          //'email'       => '|string|email|max:255|unique:users',
          'password'       => 'required|string|min:8|confirmed',
        );
      }
      else {
        $rules = array(
          'name'       => 'required|string|max:255',
          //'email'       => 'required|string|email|max:255|unique:users',
        );
      }
      $validator = Validator::make($request->all(), $rules);

      // process the login
      if ($validator->fails()) {
          return Redirect::route('panel.get.users.edit', $id)
              ->withErrors($validator)
              ->withInput();
      } else {
          // store
          $user = User::find($id);
          $user->name = $request->input('name');
          //$user->email = $request->input('email');
          
          if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
          }
          if ($user->groups()->first()->id !== $request->user_group) {
            $user->groups()->detach($user->groups()->first());
            $user->groups()->attach($request->user_group);
          }
          $user->save();

          // redirect
          Session::flash('message-success', 'Successfully updated user!');
          return Redirect::route('panel.get.users.index');
      }
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
