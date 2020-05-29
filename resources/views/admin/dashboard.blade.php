@extends('layouts.admin_dash')

@section('content')
<div class="column action-javascript cf">
    @php $admin = auth('admin')->user(); @endphp
    <div class="column is-one-third-desktop is-half-tablet is-full-mobile action-box float-l">
        <div class="action-wrapper">
            <header class="action-header">
                <p class="action-header-title">Users</p>
                <a href="javascript:void(0);" class="action-header-icon" aria-label="more options">
                    <span class="icon"><i class="fa fa-bars" aria-hidden="false"></i></span>
                </a>
            </header>
            <div class="action-content">
                <div class="content">
                    @if ( count($users) > 0 )
                    <div class="content-list cf"><a class="show-url" href="{{ route('manage.all.users')}}">Users</a>
                        <span class="pull-right list-label">{{ numberformat($users->count()) }}</span>
                    </div>
                    @endif
                    <div class="content-list cf"><a class="show-url" href="{{ route('manage.all.roles')}}">User Roles</a>
                        <span class="pull-right list-label">{{ numberformat($roles->count()) }}</span>
                    </div>
                    <div class="content-list cf"><a class="show-url" href="{{ route('manage.all.permissions')}}">Permissions</a>
                        <span class="pull-right list-label">{{ numberformat($permissions->count()) }}</span>
                    </div>
                    <div class="content-list cf"><a class="show-url" href="{{ route('admin.get.online.users')}}">online</a>
                        <span class="pull-right list-label">{{ numberformat($onlineStatus['online']) }}</span>
                    </div>
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="{{ route('manage.all.users')}}">users</a>
                <a class="navbar-item" href="{{ route('manage.all.roles')}}">user roles</a>
                <a class="navbar-item" href="{{ route('manage.all.permissions')}}">Permissions</a>
                <a class="navbar-item" href="{{ route('admin.get.online.users')}}">online users</a>
            </div>
        </div>
    </div>
    <div class="column is-one-third-desktop is-half-tablet is-full-mobile action-box float-l">
        <div class="action-wrapper">
            <header class="action-header">
                <p class="action-header-title">massages</p>
                <a href="javascript:void(0);" class="action-header-icon" aria-label="more options">
                    <span class="icon"><i class="fa fa-bars" aria-hidden="false"></i></span>
                </a>
            </header>
            <div class="action-content">
                <div class="content">
                    @php $unreadContact = App\ContactUs::whereNull('read_at'); @endphp
                    <div class="content-list cf">
                      <a class="show-url" href="{{ route('admin.message.inbox')}}">inbox</a>
                      @if($unreadContact->count() > 0)
                          <i class="dadge-lable">{{ numberformat($unreadContact->count()) }}</i>
                      @endif
                      <span class="pull-right list-label">{{ numberformat($messages->count()) }}</span>
                    </div>
                    <div class="content-list cf"><a class="show-url" href="{{ route('admin.message.send')}}">send</a>
                        @php $send = App\AdminSendMessage::all(); @endphp
                        <span class="pull-right list-label">{{ numberformat($send->count()) }}</span>
                    </div>
                    <div class="content-list cf"><a class="show-url" href="{{ route('admin.notifications')}}">notifications</a>
                        @if($admin->unreadNotifications->count() > 0)
                          <i class="dadge-lable">{{ numberformat($admin->unreadNotifications->count()) }}</i>
                        @endif
                        <span class="pull-right list-label">{{ numberformat($admin->notifications->count()) }}</span>
                    </div>
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="{{ route('admin.message.inbox')}}">inbox messages</a>
                <a class="navbar-item" href="{{ route('admin.message.send')}}">send messages</a>
                <a class="navbar-item" href="{{ route('admin.notifications')}}">notifications</a>
            </div>
        </div>
    </div>
    <div class="column is-one-third-desktop is-half-tablet is-full-mobile action-box float-l">
        <div class="action-wrapper">
            <header class="action-header">
                <p class="action-header-title">settings</p>
                <a href="javascript:void(0);" class="action-header-icon" aria-label="more options">
                    <span class="icon"><i class="fa fa-bars" aria-hidden="false"></i></span>
                </a>
            </header>
            <div class="action-content">
                <div class="content">  
                    <div class="content-list cf"> 
                        <a class="show-url" href="{{ route('admin.settings')}}">email settings</a> 
                    </div>
                    <div class="content-list cf"> 
                        <a class="show-url" href="{{ route('admin.settings')}}">nofitication settings</a> 
                    </div>  
                    <div class="content-list cf"> 
                        <span class="social"><a href="{{{ admin_setting('facebook') }}}" target="_blank"><i class="fa fa-facebook-square  HoverScale"></i></a></span>
                        <span class="social"><a href="{{{ admin_setting('twitter') }}}" target="_blank"><i class="fa fa-twitter-square  HoverScale"></i></a></span>
                        <span class="social"><a href="{{{ admin_setting('youtube') }}}" target="_blank"><i class="fa fa-youtube-square  HoverScale"></i></a></span>
                        <span class="social"><a href="{{{ admin_setting('instagram') }}}" target="_blank"><i class="fa fa-instagram  HoverScale"></i></a></span>
                    </div>  
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="{{ route('admin.settings')}}">settings</a>
            </div>
        </div>
    </div> 
    <div class="column is-full-desktop is-full-tablet is-full-mobile action-box float-l">
        <div class="action-wrapper">
            <header class="action-header">
                <p class="action-header-title">Profile</p>
                <a href="javascript:void(0);" class="action-header-icon" aria-label="more options">
                    <span class="icon"><i class="fa fa-bars" aria-hidden="false"></i></span>
                </a>
            </header>
            <div class="action-content">
                <div class="content">  
                    <div class="content-list cf">
                        <div class="user-pic" style="background-image: url('/storage/admin/picture/{{{ admin_setting('admin_picture') }}}');" alt="image"></div>
                        <div class="user-datils">
                            <div>user name</div>
                            <div class="user-online"><i class="is-online fa fa-circle"></i>online</div>
                        </div>
                    </div>
                    <div class="content-list">
                        <div class="m-19"><em>"{{{ admin_setting('about_us') }}}"</em></div> 
                    </div>
                    <div class="content-list cf">Contact Number:
                        <span class="pull-right list-label">{{{ admin_setting('contact_number') }}}</span>
                    </div>
                    <div class="content-list cf">
                        <span class="pull-right list-label">{{{ admin_setting('copyright') }}}</span>
                    </div>
                    <div class="content-list cf">facebook:
                        <span class="pull-right list-label facebook">{{{ admin_setting('facebook') }}}</span>
                    </div> 
                    <div class="content-list cf">twitter:
                        <span class="pull-right list-label twitter">{{{ admin_setting('twitter') }}}</span>
                    </div>
                    <div class="content-list cf">instagram:
                        <span class="pull-right list-label instagram">{{{ admin_setting('instagram') }}}</span>
                    </div>
                    <div class="content-list cf">youtube:
                        <span class="pull-right list-label youtube">{{{ admin_setting('youtube') }}}</span>
                    </div> 
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="{{ route('admin.settings')}}">profile edit</a>
            </div>
        </div>
    </div> 
</div>

@endsection
