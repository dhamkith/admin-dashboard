<div class="column is-2 is-one-quarter is-hidden-touch aside-backgrond  targetAsideMobile" > <!-- aside-open-mobile -->
  <div class="menu column aside-menu">
      <p class="menu-label p-l-15">User</p>
      <ul class="menu-list">
          <li><a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
          <li><a href="{{ route('profile.edit', auth()->user()->id )}}"><i class="fa fa-user"></i><span>Profile edit</span></a></li>
          <li><a href="{{ route('user.password')}}"><i class="fa fa-lock"></i><span>User Password</span></a></li>
          <li>
            <a class="has-submenu" >
              <i class="fa fa-envelope "></i>
              <span>Message</span>
              <i class="fa fa-compress pull-right"></i>
            </a>
            <ul class="is-submenu-open">
              <li><a href="{{ route('user.message.inbox')}}"><i class="fa fa-inbox"></i><span>Inbox</span>
                  @if( auth()->user()->unreadMassagesFormAdmin->count() > 0 ) 
                    <i class="dadge-lable">{{auth()->user()->unreadMassagesFormAdmin->count()}}</i>
                  @endif
                </a>
              </li>
              <li><a href="{{ route('user.send.message.create')}}"><i class="fa fa-paper-plane"></i><span>Send to</span></a></li>
              <li><a href="{{ route('user.send.messages')}}"><i class="fa fa-envelope"></i><span>Send Inbox</span>
                  @if( auth()->user()->unreadMassagesFormUser->count() > 0 ) 
                    <i class="dadge-lable">{{auth()->user()->unreadMassagesFormUser->count()}}</i>
                  @endif
                </a>
              </li>
            </ul>
          </li>
          </li>
          <li><a href="{{ route('user.notifications')}}"><i class="fa fa-bell"></i><span>Notifications</span>
            @if( auth()->user()->unreadNotifications->count() > 0 ) 
              <i class="dadge-lable">{{auth()->user()->unreadNotifications->count()}}</i>
            @endif
            </a>
          </li>
          <li><a href="{{ route('user.settings') }}"><i class="fa fa-cogs"></i><span>Settings</span></a></li> 
      </ul>
  </div>
</div>
