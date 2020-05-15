@extends('layouts.admin_dash')

@section('content')
<div class="column is-media-margin-l">

    <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow float-l">
      <div class=" ">
        <p class="is-size-4">Admin settings</p>
        <small>admin user settings</small>
      </div>
    </div>

    <div class="lists-wrapper column is-full-desktop is-full-tablet is-full-mobile float-l">
      
      <div class="columns is-multiline is-touch">
        <div class="column custom-tile">
            
            <form method="post" action="#" class="admin-setting" role="form"  enctype="multipart/form-data">
              
              
              @if(count(config('admin_setting_fields', [])) )

                  @foreach(config('admin_setting_fields') as $section => $fields)
                      <div class="admin-setting-wrap">
                          <a class="field header setting-toggle">
                              <p class="title is-12 is-size-5"><i class="{{ $fields['icon'] }}"></i>{{ $fields['title'] }} <small class="is-size-7"> ( {{ $fields['desc'] }} )</small><i class="fa fa-chevron-down is-size-6 pull-right"></i></p>
                          </a>
                          <?php if($fields['title'] == 'Theme'): $toggle_open = 'toggle-open'; else: $toggle_open = ''; endif; ?>
                          <div class="field body is-admin-setting-expand {{$toggle_open}}">
                              @foreach($fields['elements'] as $field) 
                                  @includeIf('admin.fields.' . $field['type'] )
                              @endforeach
                          </div> 
                      </div> 
                  @endforeach

              @endif

                <div class="field m-t-20">
                    <div class="control">
                        <button type="submit" class="button is-primary round-btn">Save Settings <i class="fa fa-save"></i></button>
                    </div>
                </div>

            </form>
         </div>
    </div>
</div>

@endsection