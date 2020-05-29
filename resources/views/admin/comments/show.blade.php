@extends('layouts.dash_admin')

@section('content')
@if ( $comment ) 

  <div class="columns is-multiline is-touch p-1">
    <div class="column custom-tile p-6">
        <p class="title is-size-4 p-20">comment</p> 
      @include('partials.massages') 
    </div>
  </div>
  <div class="columns is-multiline is-touch wellcome-msg-wrapper p-1">
    <div class="column custom-tile p-6 wellcome-msg">
        <?php $user = App\User::find($comment->user_id); ?> 
        <?php $music = App\Post::find($comment->commentable_id); ?>   
        <div class="p-20 is-size-6"> 
          comment user:  <strong><a href="{{ route('manage.user.edit', $user->id )}}">{{$user->name}}</a></strong>
          | comment post:  <strong><a href="{{ route('restaurant.blog.post.view', $comment->commentable_id )}}">{{$music->title}}</a></strong>
        </div>
        <div class="p-20"><small>{{ e($comment->comment) }}</small></div>
        <div class="p-20 p-t-20 p-b-30">
            <a href="{{ route('post.comment.update', $comment->id)}}" class="button is-primary round-btn wellcome-start is-small" onclick="event.preventDefault();
                        document.getElementById('comment-approve').submit();">approve</a>
            <a href="{{ route('post.comment.destroy', $comment->id)}}" class="button is-danger round-btn wellcome-start is-small" onclick="event.preventDefault();
                        document.getElementById('comment-destroy').submit();">delete</a> 
            <form id="comment-approve" action="{{ route('post.comment.update', $comment->id)}}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
            </form>
            <form id="comment-destroy" action="{{ route('post.comment.destroy', $comment->id)}}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
            </form>
        </div>
    </div>
  </div> 
  
  @endif   
  
 
@endsection
