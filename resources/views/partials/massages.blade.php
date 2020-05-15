@if(count($errors) > 0 )
    @foreach($errors->all() as $error )
        <div class="columns remove-massage-dialog">
            <div class="column help is-danger has-text-centered m-errors">
                {{$error}}
            </div>
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="columns remove-massage-dialog">
        <div class="column help is-success has-text-centered m-success">
            {{session('success')}}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="columns remove-massage-dialog">
        <div class="column help is-danger has-text-centered  m-errors">
            {{session('error')}}
        </div>
    </div>
@endif