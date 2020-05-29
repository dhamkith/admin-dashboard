@extends('layouts.admin_dash')

@section('content')
<div class="column is-media-margin-l cf">

    <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
      <div class="p-20">
        <p class="is-size-4">All the users</p>
        <small>All the users</small>
      </div>
      @include('partials.massages') 
    </div>

    @if ( count($users) > 0 )  
      @include('manage.users.partials.users-data') 
    @else
    <div class="m-t-20 column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
      <div class="p-20">
        <p class="has-text-centered is-size-4">user not yet registed</p>
      </div>
    </div>  
    @endif  
</div>

@endsection

@section('scripts')

  @include('manage.users.partials.vue-scripts') 

@endsection