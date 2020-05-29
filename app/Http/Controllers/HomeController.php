<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification as CustomNotification;
use Auth;
use App\User;
use App\AdminSendMessage;
use App\UserSendMessage;
use App\Profile;
use App\Setting;
use App\Traits\FunctionsTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        /**
         * check user has default setting table
         * 
         */ 
        Setting::flushCache();
        if( !Setting::has($user->id) ){
            // default settings
            FunctionsTrait::settingUser($user);  
         } 
        $profile = Profile::where('user_id', $user->id)->first();
        $online = Cache::has('user-is-online-' . $user->id) ? 'online' : 'ofline';
        return view('users.dashboard', compact('profile','online'));
    }
    
    /**
    * get message inbox view return (new NewUserWelcome($user))->render(); 
    *
    * @return \Illuminate\Http\Response
    */
   public function inbox()
   {
       $user = Auth::user();
       $usermessages =  AdminSendMessage::where('sendable_id', $user->id )
                                       ->whereNull('user_delete_at')
                                       ->orderBy('created_at', 'DESC')
                                       ->paginate(30);
                                        
       return view('users.message.inbox', compact('usermessages'));
   }

    /**
    * get message inbox view
    *
    * @return \Illuminate\Http\Response
    */
   public function userMessageShow($id)
   {
       $usermessage = AdminSendMessage::find($id);
       $usermessage->markAsRead();
       $user = User::find($usermessage->sendable_id);
       return view('users.message.show', compact('usermessage', 'user'));
   }
    /**
    * selected msg markAsDelete.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function userMessagemarkAsDelete(Request $request)
   {
       
       $msg_ids = explode(',', $request->mark_as_delete);
       
       if ($msg_ids) {
           
           foreach ($msg_ids as $id) {
               if ($id) {
                   $msg = AdminSendMessage::find($id);
                   $msg->markAsRead();
                   $msg->markAsDelete();
               } else {
                   return redirect()->back()->with('error', 'atleast select one...');
               }
           }
           return redirect()->back()->with('success', 'Message deleted');
       } 

   }

   /**
    * get send view
    *
    * @return \Illuminate\Http\Response
    */
   public function sendCreate()
   {
       $user = User::find(auth()->user()->id);
       return view('users.message.send-message.create', compact('user'));
   } 
   /**
    * get message send view
    *
    * @return \Illuminate\Http\Response
    */
   public function send()
   {
       $usersendmessages = UserSendMessage::where(['sendable_type' => 'App\User', 'user_id' => Auth()->user()->id] )
                                           ->whereNull('user_delete_at')
                                           ->orderBy('created_at', 'DESC')
                                           ->paginate(30);
       return view('users.message.send', compact('usersendmessages'));
   } 
   
   /**
   * store send messages
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function sendMessageStore(Request $request){
       
       $this->validate($request, [
           'name'  => 'required|string',
           'email'  => 'required|string',
           'subject'  => 'required|string',
           'message'  => 'required|string'
       ]);

       
       $user = User::find(auth()->user()->id);

       $usersend = new UserSendMessage;
       $usersend->user_id = auth()->user()->id;
       $usersend->name = strip_tags(escape_route($request->name));
       $usersend->email = strip_tags(escape_route($request->email));
       $usersend->subject = strip_tags(escape_route($request->subject));
       $usersend->message = strip_tags(escape_route($request->input('message')));

       $user->usersendmessages()->save($usersend);

       return redirect()->back()->with('success', 'message send succesfuly');
   }

   /**
    * get send view 
    * @return \Illuminate\Http\Response
    */
   public function sendShow($id)
   {
       $sendmessages = UserSendMessage::find($id);
       $sendmessages->markAsRead();
       return view('users.message.send-message.show', compact('sendmessages'));
   }
 
    /**
    * Remove the specified UserSendMessage from storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function destroySelectUserSendMessage(Request $request){

       $send_msg_ids = explode(',', $request->destroy_send_msgs);
       if ($send_msg_ids) {
           foreach ($send_msg_ids as $id) {
               if ($id) {
                   $send_msg = UserSendMessage::find($id);
                   $send_msg->markAsRead();
                   $send_msg->markAsDelete();
               } else {
                   return redirect()->back()->with('error', 'atleast select one...');
               }
           }
           return redirect()->back()->with('success', 'Send Messages deleted');
       }

   }

    /**
     * get changePassword view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request){
        $user =  auth()->user();
        return view('users.edit.change-password', compact('user'));
    } 
     /**
     *  changePassword 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request){
        
        $this->validate($request, [
            'current_password'          => 'required',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);


        $current_password = $request->current_password;

        $user = auth()->user();
        
        if (Hash::check($current_password, $user->password)) { 

               $user->fill([
                'password' => Hash::make($request->password)
                ])->save();

                return  redirect()->back()->with('success', 'Password Updated');
        }else{
            
            return redirect()->back()->with('error', 'Sorry a problem occurred while Updating this Password.');
        }
 
    }
    
    /**
    * get notifications
    *
    * @return \Illuminate\Http\Response
    */
    public function notifications(){ 
        
        $notifications = CustomNotification::where([ 'notifiable_type'=> 'App\User', 'notifiable_id' => Auth::user()->id ])
                                            ->orderBy('created_at', 'DESC')
                                            ->paginate(30);   
        return view('users.notifications.index', compact('notifications'));
    }

   /**
    * Display a listing of the admin Notification Show.
    *
    * @return tags names
    */
   public function notificationShow($id){

       $notification = CustomNotification::find($id);
       $notification->markAsRead();
       
       if($notification->data['user_id']===auth()->user()->id) { 
           return redirect()->route('user.wellcome',$notification->data['user_id']);
       } 
   } 

    /**
    * get wellComeMessage view
    *
    * @return \Illuminate\Http\Response
    */
    public function wellComeMessage($id) {
        if (auth()->user()->id==$id) {
           $user = User::find($id);
           return view('users.notifications.message-views.wellcome', compact('user'));
        } else {
           return redirect()->back()->with('erorr', 'Page Not Found');
        }
      
    }
   /**
    * Remove the specified message from storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function destroySelectNotification(Request $request){
       
       $notifi_ids = explode(',', $request->destroy_notifications);
       
       if ($notifi_ids) {
           foreach ($notifi_ids as $id) {
               if ($id) {
                   $notification = CustomNotification::find($id);
                   $notification->delete();
               } else {
                   return redirect()->back()->with('error', 'atleast select one...');
               }
           }
           return redirect()->back()->with('success', 'notifications deleted');
       }
   }
 
}
