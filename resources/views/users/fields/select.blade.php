<div class="field columns is-multiline is-mobile is-desktop is-tablet">
    <label class="label column is-11-desktop is-12-mobile is-12-tablet is-size-9-0">{{ $field['label'] }}</label>
    <div class="control column is-11 is-size-7">{{ $field['element_desc'] }}</div>
    <div class="control select column is-11-desktop is-12-mobile is-12-tablet"> 
        <select class="is-multiple" style="width: 100%;padding-top: 0 !important;"  name="{{ $field['name'] }}"  value="{{$field['name'] }}">
            @foreach ( $field['options']  as $val => $label)
                <option @if( old($field['name'], \user_setting($section, $field['name'])) == $val ) selected  @endif class="option" value="{{ $val }}">{{ $label }}</option>
            @endforeach
        </select>                                       
    </div>
</div>