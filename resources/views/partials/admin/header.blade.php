
@php
    $admin = auth('admin')->user(); 
    $massages = App\ContactUs::whereNull('read_at'); 
    $user_msg = App\UserSendMessage::where(['admin_read_at' => null, 'sendable_type'=> 'App\User']);
    $massagess = App\ContactUs::whereNull('read_at')->get();
    $user_msgs = App\UserSendMessage::where(['admin_read_at' => null, 'sendable_type'=> 'App\User'])->get();
    if(admin_setting('admin_picture') !== null): $admin_picture = admin_setting('admin_picture'); else: $admin_picture = 'null'; endif;
@endphp
<nav class="navbar has-shadow is-black admin-navbar" role="navigation" aria-label="main navigation">

  <div class="container is-fluid remove-padding">  
      <div class="toggle-mobile-hidden is-hidden-desktop"> <!--  is-hidden-touch  -->
        <a class="navbar-burger burger pull-left aside-toggle-mobile" data-target="targetAsideMobile">
            <span aria-hidden="false"></span>
            <span aria-hidden="false"></span>
            <span aria-hidden="false"></span>
        </a>
      </div>
      <div class="navbar-brand">
          <a role="button" class="navbar-burger burger menu-toggle" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
              <span aria-hidden="false"></span>
              <span aria-hidden="false"></span>
              <span aria-hidden="false"></span>
          </a>
      </div>
      <div id="navbarBasicExample" class="navbar-menu back-end"> <!--  is-active  -->
          <div class="navbar-start">
              <a href="/" class=" navbar-item is-tab color-not-change" target="_blank">Home</a>
          </div>
          <div class="navbar-end">
              <div class="">
                  <div class="buttons">
                    <div class="navbar-item  is-tab has-dropdown is-hoverable">
                        <a class="navbar-link has-dropdown-mobile is-arrowless color-not-change" href="#">
                            <i class="fa fa-bell"></i>
                            @if( $admin->unreadNotifications->count() > 0 && $massages->count() > 0 && $user_msg->count() > 0 )
                            <i class="m-l-6 dadge-lable">{{ $admin->unreadNotifications->count() + $massages->count() + $user_msg->count() }}</i> 
                            @elseif( $admin->unreadNotifications->count() > 0 && $user_msg->count() > 0)
                            <i class="m-l-6 dadge-lable">{{ $admin->unreadNotifications->count()  + $user_msg->count() }}</i> 
                            @elseif( $admin->unreadNotifications->count() > 0 && $massages->count() > 0)
                            <i class="m-l-6 dadge-lable">{{ $admin->unreadNotifications->count()  + $massages->count() }}</i> 
                            @elseif( $user_msg->count() > 0 && $massages->count() > 0 )
                            <i class="m-l-6 dadge-lable">{{ $user_msg->count()  + $massages->count() }}</i> 
                            @elseif( $admin->unreadNotifications->count() > 0)
                            <i class="m-l-6 dadge-lable">{{ $admin->unreadNotifications->count() }}</i>  
                            @elseif($massages->count() > 0)  
                            <i class="m-l-6 dadge-lable">{{$massages->count() }}</i> 
                            @elseif($user_msg->count() > 0)  
                            <i class="m-l-6 dadge-lable">{{$user_msg->count() }}</i> 
                            @endif
                        </a>
                        @if( $admin->unreadNotifications->count() > 0 || $massagess->count() > 0  || $user_msgs ->count() > 0)
                            <div class="navbar-dropdown"> 
                                @if( $admin->unreadNotifications->count() > 0 )
                                    @foreach ( $admin->unreadNotifications as $key => $notification) 
                                        @if ($key < 3)
                                        <a href="{{ route('admin.notifications') }}" class=" navbar-item ">{{$notification->data['massege']}}</a>
                                        @endif
                                    @endforeach
                                @endif
                                <hr class="navbar-divider">
                                @if( $massagess )
                                    @foreach ( $massagess as $key => $contact_us) 
                                        @if ($key < 3)
                                            <a href="{{ route('admin.message.inbox') }}" class=" navbar-item ">{{$contact_us->subject}}</a>
                                        @endif
                                    @endforeach
                                @endif
                                
                                @if( $user_msgs )
                                    @foreach ( $user_msgs as $key => $user_msg) 
                                        @if ($key < 3)
                                            <a href="{{ route('admin.user.messages') }}" class=" navbar-item ">{{str_limit($user_msg->message, 19)}}</a>
                                        @endif
                                    @endforeach
                                @endif
                            </div> 
                        @endif
                      </div>
                      <div class=" navbar-item  is-tab has-dropdown is-hoverable ">
                          <a class="navbar-link has-dropdown-mobile" href="#">
                              <div class="img" style="background-image: url('/storage/admin/picture/{{$admin_picture}}');"></div>
                          </a>
                          <div class="navbar-dropdown">
                              <hr class="navbar-divider">
                              <a class=" navbar-item " href="{{ route('admin.logout') }}">
                                    {{ __('admin Logout') }}
                              </a>  
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          
      </div>
  </div>
</nav>

@section('script')

@endsection