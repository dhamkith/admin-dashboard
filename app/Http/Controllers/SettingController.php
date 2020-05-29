<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Setting;
use App\Traits\FunctionsTrait;


class SettingController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.settings.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $rules = Setting::getValidationRules();
        
        $data = $this->validate($request, $rules);
        
        $validSettings = array_keys($rules);

        $user = Auth::user();  

        $data = FunctionsTrait::settingUserSetData(escape_route($request->facebook), escape_route($request->twitter), escape_route($request->youtube), escape_route($request->instagram));
       
        Setting::add($user, $user->id, $data);
 
        return redirect()->back()->with('success', 'setting update succesfuly');
    }


}
