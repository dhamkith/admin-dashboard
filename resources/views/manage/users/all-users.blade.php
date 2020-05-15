@extends('layouts.admin_dash')

@section('content')
<div class="column is-media-margin-l">

    <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow float-l">
      <div class=" ">
        <p class="is-size-4">All the users</p>
        <small>All the users</small>
      </div>
    </div>

    <div class="lists-wrapper column is-full-desktop is-full-tablet is-full-mobile float-l">
      
      <div class="columns is-multiline is-touch is-desktop">
        
        <div class="column is-hidden-touch is-6-desktop cf">
          <form action="#" method="POST" role="search" >
            @csrf
              <div class="field has-addons">
                  <div class="control ">
                  <div class="select">
                      <select class="" v-model="action" name="action">
                          <option value="default">action...</option>
                          <option value="suspend">suspend</option>
                          <option value="activate">re-active</option>
                      </select>
                  </div>
                </div>
                <input :value="userids" class="input" type="hidden" name="users">
                <div class="control ">
                    <div class="">
                        <button type="submit" :disabled="disabledDelete" class="button is-primary is-outlined">action</button>
                    </div>
                  </div>
              </div>
            </form>
          </div>
  
          <div class="column  is-12-touch is-6-desktop cf">
            <form action="#" method="POST" role="search" >
              @csrf
                <div class="field has-addons float-r">
                  <div class="control">
                    <input v-model="search" class="input" type="text" name="search" placeholder="Find a User">
                  </div>
                  <div class="control">
                    <div class="select">
                        <select class="" name="field">
                            <option value="name"><small>Name</small></option>
                            <option value="email"><small>Email</small></option>
                        </select>
                    </div>
                  </div>
                  <div class="control">
                      <div class="">
                          <button type="submit" :disabled="disabled" class="button is-primary is-outlined">search</button>
                      </div>
                    </div>
                </div>
            </form>
          </div>
  
        </div>
        <div class="list-header">
            <span class="column header-col">
                <input class="is-hidden-touch" v-model="usercheckall" type="checkbox" name="all_users" id="all-users">
                <strong>Name</strong>
            </span>
            <span class="column is-hidden-mobile header-col"><strong>Email</strong></span>
            <span class="column "><strong>Action</strong></span>
        </div>
        <div class="list-body">
          @if($users)
            @foreach ($users as $user)
            <div class="list-wrapper">
              <span class="column">
                  <input class="list-show is-hidden-touch" v-model="userids" :checked="checkall" type="checkbox" name="user_show" value="{{ $user->id }}" >
                  <i class="is-size-6 user-online fa fa-user"></i>{{ $user->name }}
              </span>
              <span class="column is-hidden-mobile">{{ $user->email }}</span>
              <span class="column ">
                    <a href="#" class="button is-small is-danger">user banned until :  days.</a> 
                    <a href="#" class="button is-small is-outlined"> user edit</a>
              </span>
            </div> 
            @endforeach
            @endif
        </div>
        <div class="pagination-wrapp">
          {{ $users->links() }}
        </div>
    </div> 
</div>

@endsection

@section('scripts')

<script>
  var app = new Vue({
      el: '#app',
      data: {
        search: '',
        action: 'default',
        usercheckall: false,
        userids: []
      },
      computed: {
        disabled: function () {
          return !this.search
        },
        disabledDelete: function () {
          return this.action === 'default'
        },
        checkall: function () {
          if (this.usercheckall) {
            this.userids = {!! $users->pluck('id') !!}
          } else {
            this.userids = []
          }
        }
      },
      watch: {
        checkall: () => { 
          // watch 
        }
      }
  })
</script> 

@endsection