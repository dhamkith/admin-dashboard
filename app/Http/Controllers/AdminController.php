<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Admin;
use App\ContactUs;
use App\UserSendMessage;
use App\AdminSendMessage;
use Illuminate\Notifications\DatabaseNotification as CustomNotification;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */ 
    public function __construct()
    {
      $this->middleware('auth:admin');
    }
 
    /**
    * admin Notifications
    *
    * @return \Illuminate\Http\Response
    */
    public function adminNotifications(){ 

        $notifications = CustomNotification::where([ 'notifiable_type'=> 'App\Admin', 'notifiable_id' => Auth::guard('admin')->user()->id ])
                                            ->orderBy('created_at', 'DESC')
                                            ->paginate(30);         
        
        return view('admin.notifications.index', compact('notifications'));
    }
    /**
        * Display a listing of the admin Notification Show.
        *
        * @return tags names
        */
    public function adminNotificationShow($id){

        $notification = CustomNotification::find($id);
        $notification->markAsRead();
        
        if($notification->data['user_id']!==null) {
            return redirect()->route('manage.user.edit',  $notification->data['user_id']);
        } 

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroyNotification($id)
    {
        $notification = CustomNotification::find($id);

        $notification->delete();

        return redirect()->route('admin.notifications')->with('success', 'request notification deleted');;
    }

    /**
    * Remove the selected messages from storage.
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

    /**
     * get message inbox view
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        $messages = ContactUs::orderBy('created_at', 'DESC')
                    ->paginate(10);
        return view('admin.message.inbox', compact('messages'));
    }

     /**
     * get message inbox view
     *
     * @return \Illuminate\Http\Response
     */
    public function userMsg()
    {
        $usermessages = UserSendMessage::orderBy('created_at', 'DESC')
                                        ->paginate(30);
        return view('admin.message.user-msg.index', compact('usermessages'));
    }

     /**
     *  user message show
     * 
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function userMsgShow($id)
    {
        $usermessage = UserSendMessage::find($id); 
        $usermessage->markAsAdminRead();
        return view('admin.message.user-msg.show', compact('usermessage'));
    }

    /**
     * Remove the specified user message from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyuserAndReplyMsg(Request $request){

        $msg_ids = explode(',', $request->destroy_send_msgs);
 
        if ($msg_ids) {
            $delete_at = [];
            foreach ($msg_ids as $id) {
                if ($id) {
                    $msg = UserSendMessage::find($id);
                    if ( $request->action === 'delete' && ( $msg->sendable_type === 'App\User' && $msg->user_delete_at !== null ) || $msg->sendable_type === 'App\Admin' ) { 
                        $msg->delete();
                    } else if ($request->action === 'forse_delete' ) {
                        $msg->delete();
                    } else {
                        $delete_at[] = $msg;
                    }
                } else {
                    return redirect()->back()->with('error', 'atleast select one...');
                }
            }
            if ( $request->action === 'forse_delete' ) {
                return redirect()->back()->with('success', 'messages delete succesfuly');
            } else if (count($delete_at) < count($msg_ids)) {
                return redirect()->back()->with('success', 'some messages are not deleted, user not yet delete these messages');
            } else {
                return redirect()->back()->with('error', 'messages are not deleted, user not yet delete these messages');
            }
        }
    }
    
    /**
     * get message send view
     *
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
        $adminsends = AdminSendMessage::orderBy('created_at', 'DESC')
                    ->paginate(30);
        return view('admin.message.send-msg.send', compact('adminsends'));
    }

    /**
     *  message show
     * 
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function messageShow($id)
    {
        $message = ContactUs::find($id);
        $message->markAsRead();
        return view('admin.message.show', compact('message'));
    }
     
     /**
     * get message admin reply view
     *
     * @return \Illuminate\Http\Response
     */
    public function messageReplyView($user_id)
    {
        $user = User::find($user_id);
        return view('admin.message.reply-view.reply', compact('user'));
    }

     /**
     *  messageReply store
     * 
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function messageReply(Request $request){

        $this->validate( $request, [
            'name'  => 'required|string',
            'email'  => 'required|email',
            'subject'  => 'required|string',
            'message'  => 'required|string',
        ]);

        $user = User::find($request->user_id);

        $adminsend = new AdminSendMessage;
        $adminsend->user_id = strip_tags($request->user_id);
        $adminsend->name = strip_tags(escape_route($request->input('name')));
        $adminsend->email = strip_tags(escape_route($request->input('email')));
        $adminsend->subject = strip_tags(escape_route($request->input('subject')));
        $adminsend->message = strip_tags(escape_route($request->input('message')));
 
        $user->adminsendmessages()->save($adminsend);

        return redirect()->back()->with('success', 'message send succesfuly');
    }

    /**
     *  admin send message show
     * 
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function replyShow($id)
    {
        $adminsend = AdminSendMessage::find($id);
        $adminsend->markAsAdminRead();
        $user = User::find($adminsend->sendable_id);
        return view('admin.message.send-msg.send-show', compact('adminsend', 'user'));
    }

     /**
     * Remove the specified reply message from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyReply(Request $request){
        
        $msg_ids = explode(',', $request->send_ids);
 
        if ($msg_ids) {
            $delete_at = [];
            foreach ($msg_ids as $id) {
                if ($id) {
                    $msg = AdminSendMessage::find($id);
                    if ($msg->user_delete_at !== null ) { 
                        $msg->delete();
                    } else {
                        $delete_at[] = $msg;
                    }
                } else {
                    return redirect()->back()->with('error', 'atleast select one...');
                }
            }
            if (count($delete_at) < count($msg_ids)) {

                return redirect()->back()->with('success', 'some messages are not deleted, user not yet delete these messages');

            } else {

                return redirect()->back()->with('error', 'messages are not deleted, user not yet delete these messages');
            }
            
            
        }
    }
}
