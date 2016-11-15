@if(Session::has('success')){!! session('success') !!}@endif
@if(Session::has('info')){!! session('info') !!}@endif
@if(Session::has('warning')){!! session('warning') !!}@endif
@if(Session::has('danger')){!! session('danger') !!}@endif