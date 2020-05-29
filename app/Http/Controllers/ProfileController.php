<?php

namespace App\Http\Controllers;

use Auth;
use App\User; 
use App\Profile;   
use App\Rules\ValidPhone; 
use App\Rules\ValidUserPostal;
use Illuminate\Http\Request;
use App\Traits\FunctionsTrait;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('verified');
    }

     /**
     * Show the application dashboard.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function profileEdit($id)
    { 
        if (Auth::user()->id == $id) {
            $userId = Auth::user()->id;
            $user = User::with('profile')->findOrFail($userId);
            return view('users.edit.profile-edit', compact('user') );
        } else {
            return redirect()->route('profile.edit', Auth::user()->id);
        } 
    }

    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'housenumber' => ['required', new ValidPhone],
            'postcode' => [new ValidUserPostal($request->country)], 
            'image' => 'image|max:1999',
            'first_name' => 'required',
            'last_name' => 'required',
            'about_me' => 'required',
        ]);

        // get the file name with extension
        $profile_filenameWithExt = $request->file('image')->getClientOriginalName();
        //get just file name
        $profile_filename = pathinfo($profile_filenameWithExt, PATHINFO_FILENAME );
        // get just ext
        $profile_extension = $request->file('image')->getClientOriginalExtension();
        // file to store
        $profile_filenameToStore = $profile_filename.'_'.time().'.'. $profile_extension;
        //upload
        $profile_path = $request->file('image')->storeAs('public/profile/',  $profile_filenameToStore);



        $banner_filenameWithExt = $request->file('banner')->getClientOriginalName();
        //get just file name
        $banner_filename = pathinfo($banner_filenameWithExt, PATHINFO_FILENAME );
        // get just ext
        $banner_extension = $request->file('banner')->getClientOriginalExtension();
        // file to store
        $banner_filenameToStore = $banner_filename.'b_'.time().'.'. $banner_extension;
        //uploadb
        $banner_path = $request->file('banner')->storeAs('public/profile/',  $banner_filenameToStore);

        
        
        $profile = Profile::where('user_id', $id)->first();

        if ( $profile ) {
            Profile::where('user_id', $id)
                ->update([
                    'first_name' => escape_route($request->input('first_name')),
                    'last_name' => escape_route($request->input('last_name')),
                    'about_me' => escape_route($request->input('about_me')),
                    'birthday' => escape_route($request->input('birthday')),
                    'housenumber' => escape_route($request->input('housenumber')),
                    'addressline1' => escape_route($request->input('addressline1')),
                    'addressline2' => escape_route($request->input('addressline2')),
                    'postcode' => $request->input('postcode'),
                    'city' => escape_route($request->input('city')),
                    'country' => $request->input('country'),
                    'image' => $profile_filenameToStore,
                    'banner' => $banner_filenameToStore,
                    ]);

        } else {
            $profile = new Profile;
            $profile->user_id = auth()->user()->id;
            $profile->first_name = escape_route($request->input('first_name'));
            $profile->last_name = escape_route($request->input('last_name'));
            $profile->about_me = escape_route($request->input('about_me'));
            $profile->birthday = escape_route($request->input('birthday'));
            $profile->housenumber = escape_route($request->input('housenumber'));
            $profile->addressline1 = escape_route($request->input('addressline1'));
            $profile->addressline2 = escape_route($request->input('addressline2'));
            $profile->postcode = $request->input('postcode');
            $profile->city = escape_route($request->input('city'));
            $profile->country = $request->input('country');
            
            $profile->image = $profile_filenameToStore;
            $profile->banner = $banner_filenameToStore;
            

            $profile->save();
        }
        
        FunctionsTrait::deleteUnuseFiles('App\Profile', 'public/profile/' );
    
        
        return back()->with('success', 'Profile Updated');
    }
 
    
}