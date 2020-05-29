@extends('layouts.user_dash')

@section('content')
@if ( $user ) 

<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="is-size-4">Welcome</p> 
      @include('partials.massages') 
    </div> 
  </div>

  <div class="m-t-20 column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="message-view">
      <div class="p-20 is-size-5"> hello <strong>{{$user->name}}</strong>, registration completed </div>
      <div class="p-20"><small>Welcome to a place where Design is taken up to the highest standards with a team of experts that can create the most incredible projects for your brand. We pride ourselves of executing concepts that relate exclusively to your brand; whether its online, print, photography or a great illustration for a wall. We have no limits.</small></div>
      <div class="p-20 p-t-20 p-b-30"><a href="/" class="button is-primary round-btn wellcome-start">view</a></div>
    </div>
  </div> 

</div> 
  
@endif   
@endsection