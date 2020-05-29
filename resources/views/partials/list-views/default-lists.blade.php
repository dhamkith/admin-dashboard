<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="is-size-4">{{ $header_title }}</p>
      <small>{{ $header_sub_title }}</small>
    </div>
    @include('partials.massages') 
  </div>

  @if ( count($datas) > 0 ) 

  <div class="lists-wrapper column is-full-desktop is-full-tablet is-full-mobile box-back-color float-l">
    
    <div class="columns is-multiline is-touch is-desktop"> 

      <div class="column is-hidden-touch is-6-desktop cf">
        <form action="{{ route($action_selected_route)}}" method="POST">
            @csrf
            <div class="field has-addons">
              <div class="control ">
                <div class="select">
                  <select class="" v-model="action" name="action">
                    <option value="default">action...</option>
                    <option value="delete">Delete</option>
                  </select>
                </div>
              </div>
              <input :value="dataIds" class="input" type="hidden" name="{{$action_input_name}}">
              <div class="control">
                <div class="">
                  <button type="submit" :disabled="disabledDelete" class="button is-primary is-outlined">action</button>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
      <div class="list-header">
          <span class="column header-col">
              <input class="is-hidden-touch" v-model="checkall" type="checkbox" name="all_messages" id="all-messages">
              <span class="m-r-20"></span>
              <strong>Email</strong>
          </span>
          <span class="column is-hidden-mobile header-col"><strong>Subject</strong></span>
          <span class="column header-col"><strong>created_at</strong></span>
      </div>
      <div class="list-body"> 
          @foreach ($datas as $data)
            @if( $is_model == 'notification' )
              @include('partials.list-views.list-template.notifications')
            @elseif( $is_model == 'comment') 
              @include('partials.list-views.list-template.comments')
            @else
              @include('partials.list-views.list-template.default')
            @endif
          @endforeach 
      </div>
      <div class="pagination-wrapp">
          {{ $datas->links() }}
      </div>
  </div>

  @else
  <div class="m-t-20 column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="has-text-centered is-size-4">{{ $data_notfound_massage }}</p>
    </div>
  </div>  
  @endif  
</div>
