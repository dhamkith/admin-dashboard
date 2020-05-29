<div class="field columns is-multiline is-mobile is-desktop is-tablet">
    <label class="label column is-11-desktop is-12-mobile is-12-tablet is-size-9-0">{{ $field['label'] }}</label>
    <div class="control column is-11-desktop p-t-0"> 
        <input type="{{ $field['type'] }}"
               name="{{ $field['name'] }}"
               value="{{ old($field['name'], \user_setting($section, $field['name'])) }}"
               class="input {{  $field['class'] }}{{ $errors->has($field['name']) ? ' is-danger' : '' }}"
               id="{{ $field['name'] }}"
               placeholder="{{ $field['label'] }}">
    </div>
    @if ($errors->has($field['name']))
        <span class="help is-danger column is-11-desktop">
            <strong>{{ $errors->first($field['name']) }}</strong>
        </span>
    @endif
</div>