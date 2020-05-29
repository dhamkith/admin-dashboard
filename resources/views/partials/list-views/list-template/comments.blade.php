<div class="list-wrapper">
  <span class="column">
      <input class="list-show is-hidden-touch" v-model="dataIds" :checked="inboxCheckall" type="checkbox" name="message" value="{{$data->id}}" >
      @php if($data->read_at === null): $unread = 'unread'; else: $unread = 'read';endif; @endphp 
      @if($unread === 'unread')
        <i class="is-size-6 notifi-icon fa fa-{{$fa_icon_01}} {{$fa_icon_01}}-color{{$unread}}"></i>
      @else
        <i class="is-size-6 notifi-icon fa fa-{{$fa_icon_01}}-open {{$fa_icon_01}}-color{{$unread}}"></i>
      @endif 
  </span>
  <a class="list {{$unread}}" href="{{ route($show_route, $data->id)}}">
    <span class="column">{{$data->email}}</span>
    <span class="column is-hidden-mobile">{{$data->subject}}</span>
    <span class="column ">{{$data->created_at}} </span>
  </a>
</div> 