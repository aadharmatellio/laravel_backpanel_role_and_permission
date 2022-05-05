@if(isset ($errors) && count($errors) > 0)
<div class="alert alert-warning" role="alert">
    <ul class="list-unstyled mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(Session::get('success', false))
<?php $data = Session::get('success'); ?>
@if (is_array($data))
@foreach ($data as $msg)
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><i class="fa fa-check-circle mr-2"></i>Success!</strong> {{ $msg }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endforeach
@else
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><i class="fa fa-check-circle mr-2"></i>Success!</strong> {{ $data }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@endif

@if(Session::get('message', false))
<?php $data = Session::get('message'); ?>
@if (is_array($data))

@foreach ($data as $msg)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><i class="fa fa-info-circle mr-2"></i>Info!</strong> {{ $msg }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endforeach
@else
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><i class="fa fa-info-circle mr-2"></i>Info!</strong> {{ $data }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@endif