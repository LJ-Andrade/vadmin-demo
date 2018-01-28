

{{-- Errors --}}
@if(count($errors) > 0)
<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
    <span class="alert-close" data-dismiss="alert"></span><i class="icon-ban"></i>&nbsp;&nbsp;<strong></strong>
    <ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach		
    </ul>
</div>
@endif

{{-- Messages --}}
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
    <span class="alert-close" data-dismiss="alert"></span>
    <i class="icon-help"></i>&nbsp;&nbsp;<strong>{{ Session::get('message') }}</strong>
</div>
@endif