
<div class="field columns is-multiline is-mobile is-desktop is-tablet">
    <div class="m-l-20 cf">
        @if ( $field['name'] === 'admin_picture' || $field['name'] === 'site_brand')
        <?php if($field['name'] === 'admin_picture'): $path = '/storage/admin/picture/'; elseif($field['name'] === 'site_brand'): $path = '/storage/admin/site/'; endif;?> 
        <img src="{{$path}}{{\user_setting($section, $field['name'])}}" 
             width="71px"
             height="71px"
             style="display: block; 
                    margin-top: 10px;
                    border-radius: 6px;
                    float: left">
        @endif 
    </div>
    <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0">{{ $field['label'] }}</label>
    <div class="control column is-11-desktop file is-white"> 
        <input type="{{ $field['type'] }}"
               name="{{ $field['name'] }}"
               value="{{ old($field['name'], \user_setting($section, $field['name'])) }}"
               class="{{ $field['class'] }}{{ $errors->has($field['name']) ? ' is-danger' : '' }}"
               id="{{ $field['name'] }}"
               placeholder="{{ $field['label'] }}"
               style="padding: 0; margin: 0;">
    </div>
    @if ($errors->has($field['name']))
        <span class="help is-danger column is-11-desktop">
            <strong>{{ $errors->first($field['name']) }}</strong>
        </span>
    @endif
</div>