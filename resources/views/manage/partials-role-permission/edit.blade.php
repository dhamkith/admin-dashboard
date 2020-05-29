<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="is-size-4">{{ $header_title }}</p>
      <small>{{ $header_sub_title }}</small> 
    </div>
    @include('partials.massages') 
  </div>

  <div class="lists-wrapper column is-full-desktop is-full-tablet is-full-mobile box-back-color float-l">
          <form class="columns is-multiline is-mobile is-desktop is-tablet" method="POST" action="{{ route( $form_action_route, $data->id ) }}">
                @csrf
                {{ method_field('PUT') }}   
                  <div class="column is-8-desktop is-8-tablet is-offset-2-tablet is-offset-2-desktop is-12-mobile p-t-20"> 

                      <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                          <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-7 p-b-0">{{ __('Name *') }}</label>
                          <div class="control has-icons-left has-icons-right column is-12-desktop p-t-0"> 
                              <input  id="name"
                                      type="text"
                                      name="name" 
                                      value="{{ $data->name }}"
                                      class="input {{ $errors->has('name') ? ' is-danger' : '' }}">
                              <span class="icon is-small is-left m-l-10"><i class="fa fa-edit"></i></span>
                          </div> 
                          @if ($errors->has('name'))
                            <span class="help is-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                          @endif
                      </div>
                      
                      <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                        <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-7 p-b-0">{{ __('slug *') }}</label>
                        <div class="control has-icons-left has-icons-right column is-12-desktop p-t-0"> 
                            <input id="slug"
                                    type="text"
                                    name="slug" 
                                    value="{{$data->slug}}" 
                                    class="input"
                                    disabled="disabled">
                            <span class="icon is-small is-left m-l-10"><i class="fa fa-ban"></i></span>
                        </div>  
                      </div> 
 
                      @if($is_edit_role)
                        <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                          <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Role Permissions:</label> 
                          <div class="control column is-12-desktop p-t-0"> 
                              <ul class="fa-ul">
                                  @foreach ($permissions as $key => $permission)
                                      <div class="control p-t-15 p-b-15 ">
                                          <label class="checkbox checkbox-wrapper is-8 ">
                                              <li class=""><span class="fa-li"><i class="fas fa-dot-circle"></i></span>{{$permission->name}}<small class="is-hidden-mobile"> ( slug: {{$permission->slug}} )</small></li>
                                              <div class="slide">  
                                                  <input v-model="permissionSelected" type="checkbox" name="permissions[{{$permission->slug}}]" value="{{$permission->slug}}">
                                                  <label for="slide"></label>
                                              </div>
                                          </label>
                                      </div> 
                                  @endforeach 
                              </ul>
                          </div>
                        </div>
                      @endif

                      <div class="field p-t-0 p-b-40">
                          <div class="control">
                              <button v-on:click="isLoginSubmited()" v-bind:class="isLodingClass" type="submit" class="button is-primary round-btn">Save changes<i class="fa fa-save m-l-10"></i></button>
                          </div>
                      </div>
                  </div> 
          </form>  
  </div>  
</div>