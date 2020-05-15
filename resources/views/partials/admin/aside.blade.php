<div class="column is-2 is-one-quarter is-hidden-touch aside-backgrond  targetAsideMobile" > <!-- aside-open-mobile -->
  <div class="menu column aside-menu">
      <p class="menu-label">Admin</p>
      <ul class="menu-list">
          <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
          <li>
            <a class="has-submenu" ><i class="fa fa-user"></i>
                <span>Manage Users</span>
                <i class="fa fa-compress pull-right"></i>
            </a>
            <ul class="is-submenu-open">  
                <li><a href="{{ route('manage.all.users')}}"><i class="fa fa-users"></i><span>Users</span></a></li>
                <li><a href="#"><i class="fa fa-user-secret"></i><span>Roles</span></a></li>
                <li><a href="#"><i class="fa fa-certificate"></i><span>Permissions</span></a></li>
            </ul>
          </li>
          <li>
            <a class="has-submenu" ><i class="fa fa-folder"></i>
                <span>Menu</span>
                <i class="fa fa-compress pull-right"></i>
            </a>
            <ul class="is-submenu-open">
                <li><a href="#"><i class="fa fa-tag"></i><span>Tags</span></a></li>
                <li><a href="#"><i class="fa fa-book"></i><span>menus</span></a></li> 
                <li><a href="#"><i class="fa fa-plus"></i><span>create</span></a></li>  
            </ul>
          </li> 
          <li>
            <a class="has-submenu"><i class="fa fa-envelope"></i>
              <span>Message</span>
              <i class="fa fa-compress pull-right"></i>
            </a>
            <ul class="is-submenu-open">
                <li>
                  <a href="#"><i class="fa fa-inbox"></i><span>Inbox</span></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-paper-plane"></i><span>Send</span></a>
                </li>
            </ul>
          </li> 
          <li><a href="#"><i class="fa fa-inbox"></i><span>User Massages</span></a>
          </li>
          <li><a href="#"><i class="fa fa-bell"></i><span>Notifications</span></a>
          </li>
          <li>
            <a class="has-submenu" ><i class="fa fa-book"></i>
              <span>posts</span>
              <i class="fa fa-compress pull-right"></i>
            </a>
            <ul class="is-submenu-open">
                <li><a href="#"><i class="fa fa-file"></i><span>Member posts</span></a></li>
                <li><a href="#"><i class="fa fa-book"></i><span>post catagory</span></a></li>  
            </ul>
          </li>
          <li><a href="#"><i class="fa fa-comments"></i><span>comments</span></a></li>
          <li><a href="{{ route('admin.settings')}}"><i class="fa fa-cogs"></i><span>Settings</span></a></li> 
      </ul>
  </div>
</div>

@section('script')

@endsection