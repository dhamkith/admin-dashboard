<div class="column is-2 is-one-quarter is-hidden-touch aside-backgrond  targetAsideMobile" > <!-- aside-open-mobile -->
  <div class="menu column aside-menu">
      <p class="menu-label  p-l-15">Admin</p>
      <ul class="menu-list">
          <li><a href="{{ route('admin.dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
          <li>
            <a class="has-submenu" ><i class="fa fa-user"></i>
                <span>Manage Users</span>
                <i class="fa fa-compress pull-right"></i>
            </a>
            <ul class="is-submenu-open">
                <li><a href="{{ route('manage.all.users')}}"><i class="fa fa-users"></i><span>Users</span></a></li>
                <li><a href="{{ route('manage.all.roles')}}"><i class="fa fa-user-secret"></i><span>Roles</span></a></li>
                <li><a href="{{ route('manage.all.permissions')}}"><i class="fa fa-certificate"></i><span>Permissions</span></a></li>
            </ul>
          </li>
          <li>
            <a class="has-submenu"><i class="fa fa-envelope"></i>
              <span>Message</span>
              <i class="fa fa-compress pull-right"></i>
            </a>
            <ul class="is-submenu-open">
                <li>
                  <a href="{{ route('admin.message.inbox')}}"><i class="fa fa-inbox"></i><span>Inbox</span>
                    @php $massages = App\ContactUs::whereNull('read_at'); @endphp
                    @if ( $massages->count() > 0 ) 
                      <i class="dadge-lable">{{$massages->count()}}</i>
                    @endif
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.message.send')}}"><i class="fa fa-paper-plane"></i><span>Send</span>
                    @php $send = App\AdminSendMessage::whereNull('admin_read_at'); @endphp
                    @if ( $send->count() > 0 ) 
                      <i class="dadge-lable">{{$send->count()}}</i>
                    @endif
                  </a>
                </li>
            </ul>
          </li>
          <li><a href="{{ route('admin.user.messages')}}"><i class="fa fa-inbox"></i><span>User Massages</span>
            @php $user_unread_msg = App\UserSendMessage::where(['admin_read_at' => null, 'sendable_type'=> 'App\User']); @endphp
            @if( $user_unread_msg->count()  > 0 ) 
              <i class="dadge-lable">{{ $user_unread_msg->count() }}</i>
            @endif
          </a>
          </li>
          <li><a href="{{ route('admin.notifications') }}"><i class="fa fa-bell"></i><span>Notifications</span></a></li> 
          <li><a href="{{ route('test.comment.all')}}"><i class="fa fa-comments"></i><span>comments</span></a></li>
          <li><a href="{{ route('admin.settings')}}"><i class="fa fa-cogs"></i><span>Settings</span></a></li> 
      </ul>
  </div>
</div>
