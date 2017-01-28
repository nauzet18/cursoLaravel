@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if( Session::has('flash_message' ) )
    <div class="alert alert-success">
        {{ Session::get('flash_message' ) }}
    </div>
@endif