@extends('app')

@section('content')
@include('sidebar')
<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 content">
  <div class="payment-wall-widget">
    <?php echo $message; ?>
  </div>
</div>
@endsection