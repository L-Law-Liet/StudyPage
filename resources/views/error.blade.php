@if(Session::has('flash_message'))
    <div class="container">
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    </div>
@endif
@if(Session::has('success'))
    <div class="container">
        <div class="alert alert-success">
            <h4>{{ trans('general.success') }}</h4>
            <p> {{ Session::get('success') }} </p>
        </div>
    </div>
@endif
