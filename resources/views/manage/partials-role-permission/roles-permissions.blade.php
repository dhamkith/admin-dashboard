<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
      <div class="p-20">
          <p class="is-size-4">{{ $header_title }}
              <button type="button" class="button is-small is-primary gradient p-5" v-on:click="modelOpen">
                {{ $header_btn_text }}
              </button>
          </p>
          <small>{{ $header_sub_title }}</small>
      </div>
      @include('partials.massages') 
  </div>

@if ( count($datas) > 0 ) 
  <div class="action-javascript">
      @foreach ($datas as $key => $data)
      @php if($key%2): $paddin_class = 'p-r-0'; else: $paddin_class = 'p-l-0'; endif; @endphp
      <div class="column {{$paddin_class}} is-half-desktop is-half-tablet is-full-mobile action-box float-l">
          <div class="action-wrapper">
              <header class="action-header">
                  <p class="action-header-title m-l-15">{{$data->name}} Role</p>
                  <a href="javascript:void(0);" class="action-header-icon" aria-label="more options">
                      <span class="icon"><i class="fa fa-bars" aria-hidden="false"></i></span>
                  </a>
              </header>
              <div class="action-content">
                  <div class="content is-size-6">  
                      <div class="content-list m-l-10 cf"> 
                          <span class="show-url" href="#">display name : </span> 
                          <span class="is-pulled-right list-label">{{$data->name}}</span> 
                      </div>
                      <div class="content-list m-l-10 cf"> 
                          <span class="show-url" href="#">slug : </span> 
                          <span class="is-pulled-right list-label">{{$data->slug}}</span> 
                      </div> 

                      @if($is_roles)
                      <div class="content-list m-l-10 cf"> 
                          <ul class="m-l-0 p-5">Role Permissions:
                              @foreach ($data->permissions as $key => $permission)
                                  @if ($permission)
                                  <div class="control p-10">
                                      <span><i class="fa fa-check-square m-r-19"></i>{{$permission->name}}<small class="is-hidden-mobile"> ( slug: {{$permission->slug}} )</small></span>
                                  </div> 
                                  @endif
                              @endforeach
                          </ul> 
                      </div> 
                      @endif

                      <div class="content-list m-l-10 cf"> 
                          <a class="button is-small is-primary is-outlined" href="{{ route($edit_route, $data->id)}}"><i class="fa fa-edit m-r-10"></i>edit</a> 
                          @if(!array_key_exists($data->slug, \array_merge(config('default_role_permissions')['roles'], config('default_role_permissions')['permissions']))) 
                              <a class="button is-small is-danger is-outlined is-pulled-right" href="{{ route($delete_route, $data->id)}}" type="button" class="button is-outlined is-small is-primary m-l-10"
                                  onclick="event.preventDefault();
                                  document.getElementById('data-destroy-{{$data->id}}').submit();">
                                  <i class="fa fa-trash m-r-10"></i> delete 
                              </a> 
                          @endif
                      </div>
                  </div>
              </div>
              <div class="action-dropdown">
                  <a class="navbar-item" href="{{ route($edit_route, $data->id)}}">edit</a> 
                  @if(!array_key_exists($data->slug, \array_merge(config('default_role_permissions')['roles'], config('default_role_permissions')['permissions'])))  
                      <a class="navbar-item" href="{{ route($delete_route, $data->id)}}" type="button" class="button is-outlined is-small is-primary m-l-10"
                          onclick="event.preventDefault();
                          document.getElementById('data-destroy-{{$data->id}}').submit();">
                          <i class="fa fa-trash"></i> delete 
                      </a>
                      <form id="data-destroy-{{$data->id}}" action="{{ route($delete_route, $data->id)}}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                      </form> 
                  @endif
              </div>
          </div>
      </div> 
      @endforeach
  </div> 
@else
  <div class="m-t-20 column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
      <div class="p-20">
      <p class="has-text-centered is-size-4">{{ $data_notfound_massage }}</p>
      </div>
  </div>  
@endif 

<app-model v-if="isModalActive" v-on:emit-cloce="modelCloce">

  <p slot="title" class="modal-card-title">Create New {{ $model_text }}</p>
  <div class="field">
      <label class="label">{{ $model_text }} Display Name</label>
      <div class="control">
          <input v-model="name" class="input" type="text" name="name"  placeholder="Display Name">
      </div>
      <div v-if="errors.name">
          <p class="help is-danger"  :key="error" v-for="error in errors.name" >@{{ error }}</p>
      </div>
  </div>

  <div class="field">
      <label class="label">{{ $model_text }} Slug</label>
      <div class="control">
          <input v-model="slug" class="input" type="text" name="slug" placeholder="Slug Name" :class="classObject">
      </div>
      <div v-if="errors.slug">
          <p class="help is-danger"  :key="error" v-for="error in errors.name" >@{{ error }}</p>
      </div>
      <div v-if="message">
          <p class="help is-danger">@{{ message }}</p>
      </div>
  </div>
  
  <button slot="submit" class="button is-primary is-outlined" v-on:click="roleOrpermissionCreate">Create {{ $model_text }}</button>

</app-model>    
</div>