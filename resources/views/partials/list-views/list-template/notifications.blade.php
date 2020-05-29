@php $user = App\User::find($data->data['user_id']); @endphp
<div class="list-wrapper">
  <span class="column">
      <input class="list-show is-hidden-touch" v-model="dataIds" :checked="inboxCheckall" type="checkbox" name="message" value="{{$data->id}}" >
      @php if($data->read_at === null): $unread = 'unread'; else: $unread = 'read';endif; @endphp
      <i class="is-size-6 notifi-color{{$unread}} notifi-icon fa fa-user"></i>
  </span>
  <a class="list {{$unread}}" href="{{ route( $show_route, $data->id)}}">
    <span class="column">{{$user->email}}</span>
    <span class="column is-hidden-mobile">{{$data->data['massege']}}</span>
    <span class="column ">{{$data->created_at}} </span>
  </a>
</div> 