@extends('layouts.user_dash')

@section('content')
<div class="column action-javascript cf">
    @php $user = auth()->user(); @endphp
    <div class="column is-one-third-desktop is-half-tablet is-full-mobile action-box float-l">
        <div class="action-wrapper">
            <header class="action-header">
                <p class="action-header-title">Profile</p>
                <a href="javascript:void(0);" class="action-header-icon" aria-label="more options">
                    <span class="icon"><i class="fa fa-bars" aria-hidden="false"></i></span>
                </a>
            </header>
            <div class="action-content">
                <div class="content">  
                    @if ($profile)
                    @php $image = $profile->image ? $profile->image : '';@endphp
                    <div class="content-list cf">
                        <div class="user-pic" style="background-image: url('/storage/profile/{{$image }}');" alt="image"></div>
                        <div class="user-datils">
                            <div>{{$profile->first_name}} {{$profile->last_name}}</div>
                            <div class="user-{{$online}}"><i class="is-online fa fa-circle"></i>{{$online}}</div>
                        </div>
                        <span class="is-pulled-right list-label"></span>
                        </div>
                        <div class="content-list"><div class=""><em>"{{$profile->about_me}}"</em></div>
                        <span class="is-pulled-right list-label"></span>
                    </div> 
                    @endif
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="{{ route('profile.edit', auth()->user()->id )}}">profile edit</a>
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
                    <div class="content-list cf"> 
                        <a class="show-url" href="{{ route('user.message.inbox')}}">inbox</a>
                        @if($user->unreadMassagesFormAdmin->count() > 0)
                            <i class="dadge-lable">{{ numberformat($user->unreadMassagesFormAdmin->count()) }}</i>
                        @endif 
                        <span class="is-pulled-right list-label">{{ numberformat($user->unreadMassagesFormAdmin->count()) }}</span>
                    </div>
                    <div class="content-list cf"> 
                        <a class="show-url" href="{{ route('user.send.messages')}}">send</a>
                        @if($user->unreadMassagesFormUser->count() > 0)
                            <i class="dadge-lable">{{ numberformat($user->unreadMassagesFormUser->count()) }}</i>
                        @endif 
                        <span class="is-pulled-right list-label">{{ numberformat($user->unreadMassagesFormUser->count()) }}</span>
                    </div> 
                    <div class="content-list cf"> 
                        <a class="show-url" href="{{ route('user.notifications')}}">nofiticatios</a> 
                        @if($user->unreadNotifications->count() > 0)
                            <i class="dadge-lable">{{ numberformat($user->unreadNotifications->count()) }}</i>
                        @endif 
                        <span class="is-pulled-right list-label">{{ numberformat($user->notifications->count()) }}</span>
                    </div> 
                    <div class="content-list cf"> 
                        <a class="show-url" href="{{ route('user.send.message.create')}}">send new massage</a>
                    </div>  
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="{{ route('user.message.inbox')}}">inbox messages</a>
                <a class="navbar-item" href="{{ route('user.send.messages')}}">send messages</a>
                <a class="navbar-item" href="{{ route('user.notifications')}}">notifications</a>
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
                    @php 
                        $social = $user->socialMediaLinks(); 
                        if($social['facebook']): $facebook = social_profile($social['facebook']); else: $facebook = ''; endif;
                        if($social['twitter']): $twitter = social_profile($social['twitter']); else: $twitter = ''; endif;
                        if($social['youtube']): $youtube = social_profile($social['youtube']); else: $youtube = ''; endif;
                        if($social['instagram']): $instagram = social_profile($social['instagram']); else: $instagram = ''; endif;
                    @endphp
                    <div class="content-list cf">Email Settings</div>
                    <div class="content-list cf">Notification Settings</div>
                    <div class="content-list cf">Email Notification Settings</div> 
                    <div class="content-list cf"> 
                        <span class="social m-r-10"><a href="https://www.faceboock.com/{{$facebook}}" target="_blank"><i class="fa fa-facebook-square  HoverScale"></i></a></span>
                        <span class="social m-r-10"><a href="https://www.twitter.com/{{$twitter}}" target="_blank"><i class="fa fa-twitter-square  HoverScale"></i></a></span>
                        <span class="social m-r-10"><a href="https://www.youtube.com/{{$youtube}}" target="_blank"><i class="fa fa-youtube-square  HoverScale"></i></a></span>
                        <span class="social m-r-10"><a href="https://www.instagram.com/{{$instagram}}" target="_blank"><i class="fa fa-instagram  HoverScale"></i></a></span>
                    </div>  
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="{{ route('user.settings')}}">settings</a>
            </div>
        </div>
    </div>
</div>

@endsection
