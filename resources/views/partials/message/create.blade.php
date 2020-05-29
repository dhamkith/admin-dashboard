<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="is-size-4">{{ $header_title }}</p>
      <small>{{ $header_sub_title }}</small> 
      @if($admin_reply)
      <div class="p-t-20 is-size-6"> 
        send user:  <strong><a href="{{ route('manage.user.edit', $user->id)}}">{{$user->name}}</a></strong> 
      </div>
      @endif
    </div>
    @include('partials.massages') 
  </div>

  <div class="lists-wrapper column is-full-desktop is-full-tablet is-full-mobile box-back-color float-l">
          <form class="columns is-multiline is-mobile is-desktop is-tablet" method="POST" action="{{ route( $form_action_route ) }}">
                  {{ csrf_field() }}    
                  <div class="column is-8-desktop is-8-tablet is-offset-2-tablet is-offset-2-desktop is-12-mobile p-t-20"> 

                      <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                          <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-7 p-b-0">{{ __('Name *') }}</label>
                          <div class="control has-icons-left has-icons-right column is-12-desktop p-t-0"> 
                            <input type="hidden" name="user_id" value="{{$user->id}}"> 
                            <input  v-model="name"
                                      id="name"
                                      type="text"
                                      name="name" 
                                      value="{{old('name')}}"
                                      class="input {{ $errors->has('name') ? ' is-danger' : '' }}">
                              <span class="icon is-small is-left m-l-10"><i class="fa fa-user"></i></span>
                          </div> 
                          @if ($errors->has('name'))
                            <span class="help is-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                          @endif
                      </div>
                      
                      <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                        <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-7 p-b-0">{{ __('Your E-Mail Address *') }}</label>
                        <div class="control has-icons-left has-icons-right column is-12-desktop p-t-0"> 
                            <input id="email"
                                    type="text"
                                    name="email" 
                                    value="{{ $user->email }}"
                                    class="input {{ $errors->has('email') ? ' is-danger' : '' }}">
                            <span class="icon is-small is-left m-l-10"><i class="fa fa-envelope"></i></span>
                        </div> 
                        @if ($errors->has('email'))
                          <span class="help is-danger">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @endif
                      </div> 

                      <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                        <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-7 p-b-0">{{ __('subject  *') }}</label>
                        <div class="control has-icons-left has-icons-right column is-12-desktop p-t-0"> 
                            <input  v-model="subject"
                                    id="subject"
                                    type="text"
                                    name="subject" 
                                    value="{{old('subject')}}"
                                    class="input {{ $errors->has('subject') ? ' is-danger' : '' }}">
                            <span class="icon is-small is-left m-l-10"><i class="fa fa-envelope"></i></span>
                        </div> 
                        @if ($errors->has('subject'))
                          <span class="help is-danger">
                              <strong>{{ $errors->first('subject') }}</strong>
                          </span>
                        @endif
                      </div> 

                      <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                        <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-7 p-b-0">{{ __('Message *') }}</label>
                        <div class="control has-icons-left has-icons-right column is-12-desktop p-t-0"> 
                            <textarea  v-model="message"
                                    id="message"
                                    type="text"
                                    name="message" 
                                    class="textarea {{ $errors->has('message') ? ' is-danger' : '' }}"
                                    rows="6"
                                    col="5"
                                    required autofocus>{{old('message')}}</textarea>
                        </div> 
                      </div> 

                      <div class="field p-t-0 p-b-40">
                          <div class="control">
                              <button :disabled="disabledLogin" v-on:click="isLoginSubmited()" v-bind:class="isLodingClass" type="submit" class="button is-primary round-btn">send<i class="fa fa-paper-plane m-l-10"></i></button>
                          </div>
                      </div>
                  </div> 
          </form>  
  </div>  
</div>