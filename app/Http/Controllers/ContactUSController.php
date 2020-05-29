<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Admin;
use App\ContactUs; 
use Illuminate\Support\Facades\Schema;
use Mail;
use App\Mail\Contact;

class ContactUSController extends Controller
{
        /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth:admin')->except('contact', 'contactStore');
   }

     /**
     * get view
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('pages.contact');
    }

     /**
     * Store a newly created message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if ( Auth::user() ){
            
            $u_id = auth()->user()->id;
            
            $User = User::find($u_id);
            $contact_us = new ContactUs;
            $contact_us->name = escape_route($request->input('name'));
            $contact_us->email = escape_route($request->input('email'));
            $contact_us->subject = escape_route($request->input('subject'));
            $contact_us->message = escape_route($request->input('message'));

            $User->massages()->save($contact_us);

        } else {
            ContactUs::create($request->all());
        } 
        
        $data = array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
        );

        if (Schema::hasTable('admins')) {
            $admin = Admin::find(1);
            if ($admin && admin_setting('contact_us_email')) {
                $admin_email = $admin->email; 
                Mail::to($admin_email)->send(new Contact($data)); 
            }
        }  
        
        return back()->with('success', 'Thanks for contacting us!');
    }

     /**
     * Remove the specified message from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactDestroy(Request $request)
    { 
        $msgs_ids = explode(',', $request->destroy_msgs);
        
        if ($msgs_ids) {
            foreach ($msgs_ids as $id) {
                if ($id) {
                    $message = ContactUs::find($id);
                    $message->delete();
                } else {
                    return redirect()->back()->with('error', 'atleast select one...');
                }
            }
            return redirect()->back()->with('success', 'request messages deleted');
        }
    }
}
