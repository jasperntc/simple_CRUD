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
            'username'=> 'required|max:255|string|unique:account_infos,username|alpha_num',
            'name'=> 'required|max:255',
            'gender'=> 'required|boolean',
            'birthdate'=> 'required',
            'email'=> 'required|max:255|email|unique:account_infos,email',
            'notes'=> 'nullable',
        ]);
        $storeData['username'] = strtolower($storeData['username']);
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
            'username'=> 'required|max:255|string|unique:account_infos,username,'.$id.'|alpha_num',
            'name'=> 'required|max:255',
            'gender'=> 'required|boolean',
            'birthdate'=> 'required',
            'email'=> 'required|max:255|email|unique:account_infos,email,'.$id.'',
            'notes'=> 'nullable',
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

    /* Process ajax request */
    public function getAccountInfos(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Account_info::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Account_info::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = Account_info::orderBy($columnName, $columnSortOrder)
            ->where('account_infos.username', 'like', '%' . $searchValue . '%')
            ->orWhere('account_infos.name', 'like', '%' . $searchValue . '%')
            ->orWhere('account_infos.email', 'like', '%' . $searchValue . '%')
            ->select('account_infos.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $data_arr[] = array(
                "id" => $record->id,
                "username" => $record->username,
                "name" => $record->name,
                "gender" => $record->gender,
                "birthdate" => $record->birthdate,
                "email" => $record->email,
                "notes" => $record->notes,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
        exit;
    }
}
