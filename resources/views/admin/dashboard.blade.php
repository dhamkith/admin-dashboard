@extends('layouts.admin_dash')

@section('content')
<div class="column action-javascript">
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
                    <div class="content-list cf">
                        <div class="user-pic" style="background-image: url('/storage/profile/image');" alt="image"></div>
                        <div class="user-datils">
                            <div>user name</div>
                            <div class="user-online-ofline"><i class="is-online fa fa-circle"></i>online</div>
                        </div>
                        <span class="pull-right list-label"></span>
                        </div>
                        <div class="content-list"><div class=""><em>"about_me"</em></div>
                        <span class="pull-right list-label"></span>
                    </div> 
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="#">profile edit</a>
                <a class="navbar-item" href="#">profile edit</a>
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
                        <a class="show-url" href="#">inbox</a>
                        <i class="dadge-lable">2</i>
                        <span class="pull-right list-label">6</span> 
                    </div>
                    <div class="content-list cf"> 
                        <a class="show-url" href="#">send</a>
                        <i class="dadge-lable">2</i>
                        <span class="pull-right list-label">6</span> 
                    </div> 
                    <div class="content-list cf"> 
                        <a class="show-url" href="#">nofiticatios</a>
                        <i class="dadge-lable">2</i>
                        <span class="pull-right list-label">6</span> 
                    </div> 
                    <div class="content-list cf"> 
                        <a class="show-url" href="#">send new massage</a>
                    </div>  
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="#">inbox</a>
                <a class="navbar-item" href="#">send</a>
                <a class="navbar-item" href="#">nofiticatios</a>
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
                        <a class="show-url" href="#">email settings</a> 
                    </div>
                    <div class="content-list cf"> 
                        <a class="show-url" href="#">nofitication settings</a> 
                    </div>  
                    <div class="content-list cf"> 
                        <span class="social"><a href="https://www.faceboock.com/" target="_blank"><i class="fa fa-facebook-square  HoverScale"></i></a></span>
                        <span class="social"><a href="https://www.twitter.com/" target="_blank"><i class="fa fa-twitter-square  HoverScale"></i></a></span>
                        <span class="social"><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-square  HoverScale"></i></a></span>
                        <span class="social"><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram  HoverScale"></i></a></span>
                    </div>  
                </div>
            </div>
            <div class="action-dropdown">
                <a class="navbar-item" href="#">email settings</a> 
                <a class="navbar-item" href="#">nofitication settings</a>
            </div>
        </div>
    </div>
</div>

@endsection
