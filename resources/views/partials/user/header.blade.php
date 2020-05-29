@php 
    $user = auth()->user();
    $auth_id = $user->id;
    $profile = App\Profile::where('user_id', $auth_id)->first();
    if ($profile):
        $image = $profile->image ? $profile->image : '';
    endif; 
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
                            @if( $user->unreadNotifications->count() > 0 &&  $user->unreadMassagesFormAdmin->count() > 0)
                            <i class="m-l-6 dadge-lable"> {{ $user->unreadNotifications->count() + $user->unreadMassagesFormAdmin->count() }}</i> 
                            @elseif($user->unreadNotifications->count() > 0)
                            <i class="m-l-6 dadge-lable">{{ $user->unreadNotifications->count()}}</i> 
                            @elseif($user->unreadMassagesFormAdmin->count() > 0)
                            <i class="m-l-6 dadge-lable">{{  $user->unreadMassagesFormAdmin->count() }}</i> 
                            @endif
                        </a>
                        @if( $user->unreadNotifications->count() > 0 || $user->unreadMassagesFormAdmin->count() > 0 )
                            <div class="navbar-dropdown"> 
                                @foreach ( $user->unreadNotifications as $key => $notification) 
                                    @if ($key < 3)
                                        <a href="{{ route('user.notification.show', $notification->id) }}" class="navbar-item ">{{$notification->data['massege']}}</a>
                                    @endif
                                @endforeach 
                                <hr class="navbar-divider">
                                @foreach ( $user->unreadMassagesFormAdmin as $key => $formadmin) 
                                    @if ($key < 3)
                                    <a href="{{ route('user.message.inbox') }}" class=" navbar-item ">{{$formadmin->subject}}</a>
                                    @endif
                                @endforeach 
                            </div> 
                        @endif
                      </div>
                      <div class=" navbar-item  is-tab has-dropdown is-hoverable ">
                          <a class="navbar-link has-dropdown-mobile" href="#">
                                @if($profile)
                                    <div class="img" style="background-image: url('/storage/profile/{{$image }}');" alt="image"></div>
                                @else 
                                <div class="img" style="background-image: url('/storage/profile/user.png');" alt="image"></div>
                                @endif
                          </a>
                          <div class="navbar-dropdown"> 
                                <a href="#" class="navbar-item">home page</a>
                                <a href="#" class="navbar-item">Profile</a>
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a> 
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          
      </div>
  </div>
</nav>
