<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account_info;

class Account_infoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_info = Account_info::all();
        return view('index', compact('account_info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'username'=> 'required|max:255',
            'name'=> 'required|max:255',
            'gender (isMale)'=> 'required|boolean',
            'birthdate'=> 'required',
            'email'=> 'required|max:255',
            'notes'=> 'required',
        ]);
        $account_info = Account_info::create($storeData);

        return redirect('/account_info')->with('completed', 'Account info has been saved !');
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
        $account_info = Account_info::findOrFail($id);
        return view('edit', compact('account_info'));
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
        $updateData = $request->validate([
            'username'=> 'required|max:255',
            'name'=> 'required|max:255',
            'gender (isMale)'=> 'required|boolean',
            'birthdate'=> 'required',
            'email'=> 'required|max:255',
            'notes'=> 'required',
        ]);
        Account_info::whereId($id)->update($updateData);
        return redirect('/account_info')->with('completed', 'Account info has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account_info = Account_info::findOrFail($id);
        $account_info->delete();

        return redirect('/account_info')->with('completed', 'Account info has been deleted !');
    }
}
