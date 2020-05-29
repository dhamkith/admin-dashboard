<div class="field columns is-multiline is-mobile is-desktop is-tablet">
     <div class="control column is-11-desktop is-size-7">{{ $field['element_desc'] }}</div>
     <div class="control column is-11-desktop is-12-mobile is-12-tablet">  
        <label class="checkbox checkbox-wrapper">  <!-- light-color -->
            <li class="is-size-9-0"><strong>{{ $field['label'] }}</strong></li>
            <div class="slide">  
                <input type="{{ $field['type'] }}"
                    name="{{ $field['name'] }}"
                    value="{{ old($field['name'], \user_setting($section, $field['name'])) }}"
                    id="{{ $field['name'] }}"
                    <?php if (user_setting($section, $field['name'])) { echo 'checked';}?>>
                <label for="slide"></label>
            </div>
        </label>
    </div> 
</div>  