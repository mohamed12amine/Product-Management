<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Staff;
use DB;

class FormController extends Controller
{
    // view form
    public function index()
    {
        return view('form.form');
    }

    // view record
    public function viewRecord()
    {
        $data = DB::table('staff')->get();
        return view('view_record.viewrecord',compact('data'));

    }

    // save 
    public function saveRecord(Request $request)
    {
        $request->validate([
            'userID'       => 'required|string|max:255',
            'fullName'     => 'required|string|max:255',
            'sex'          => 'required',
            'emailAddress' => 'required|string|email|max:255',
            'phone_number' => 'required|numeric|min:9',
            'position'     => 'required|string|max:255',
            'department'   => 'required|string|max:255',
            'salary'       => 'required|string|max:255',
        ]);
        try{

        $userID       = $request->userID;
        $fullName     = $request->fullName;
        $sex          = $request->sex;
        $emailAddress = $request->emailAddress;
        $phone_number = $request->phone_number;
        $position     = $request->position;
        $department   = $request->department;
        $salary       = $request->salary;

        $Staff = new Staff();
        $Staff->user_id       = $userID;
        $Staff->full_name     = $fullName;
        $Staff->sex           = $sex;
        $Staff->email_address = $emailAddress;
        $Staff->phone_number  = $phone_number;
        $Staff->position      = $position;
        $Staff->department    = $department;
        $Staff->salary        = $salary;
        $Staff->save();

        Toastr::success('Data added successfully :)','Success');
        return redirect()->back();

        }catch(\Exception $e){

            Toastr::error('Data added fail :)','Error');
            return redirect()->back();
        }
    }
}
