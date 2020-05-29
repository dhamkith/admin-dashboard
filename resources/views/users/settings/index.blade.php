@extends('layouts.user_dash')

@section('content')
<div class="column is-media-margin-l cf">

    <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow  box-back-color float-l">
      <div class="p-20">
        <p class="is-size-4">user settings</p>
        <small>user user settings</small>
        @include('partials.massages')
      </div>
    </div>

    <div class="lists-wrapper column is-full-desktop is-full-tablet is-full-mobile box-back-color float-l">
      
      <div class="columns is-multiline is-touch">
        <div class="column custom-tile">
            
            <form method="post" action="{{ route('user.settings.store') }}" class="admin-setting" role="form"  enctype="multipart/form-data">
                {!! csrf_field() !!}
              
              @if(count(config('user_setting_fields', [])) )

                  @foreach(config('user_setting_fields') as $section => $fields)
                      <div class="admin-setting-wrap">
                          <a class="field header setting-toggle">
                              <p class="title is-12 is-size-5"><i class="{{ $fields['icon'] }}"></i>{{ $fields['title'] }} <small class="is-size-7"> ( {{ $fields['desc'] }} )</small><i class="fa fa-chevron-down is-size-6 pull-right"></i></p>
                          </a>
                          <?php if($fields['title'] == 'Theme'): $toggle_open = 'toggle-open'; else: $toggle_open = ''; endif; ?>
                          <div class="field body is-admin-setting-expand {{$toggle_open}}">
                              @foreach($fields['elements'] as $field) 
                                  @includeIf('users.fields.' . $field['type'] )
                              @endforeach
                          </div> 
                      </div> 
                  @endforeach

              @endif

                <div class="field m-t-20">
                    <div class="control">
                        <button type="submit" class="button is-primary round-btn m-l-15">Save Settings <i class="fa fa-save"></i></button>
                    </div>
                </div>

            </form>
         </div>
    </div>
</div>

@endsection