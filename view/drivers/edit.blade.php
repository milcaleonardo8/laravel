@extends('layouts.app')
@section("breadcrumb")
<li><a href="{{ route("drivers.index")}}">@lang('fleet.drivers')</a></li>
<li class="active">@lang('fleet.edit_driver')</li>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="box box-warning">
              <div class="box-header with-border">
 <h3 class="box-title">@lang('fleet.edit_driver')</h3>

                </div>

                <div class="box-body">
@if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

{!! Form::open(['route' => ['drivers.update',$driver->id],'files'=>true,'method'=>'PATCH']) !!}
{!! Form::hidden('id',$driver->id) !!}
{!! Form::hidden('edit',"1") !!}
{!! Form::hidden('detail_id',$driver->getMeta('id')) !!}
{!! Form::hidden('user_id',Auth::user()->id) !!}
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('first_name', __('fleet.firstname'), ['class' => 'form-label required']) !!}
 {!! Form::text('first_name', $driver->getMeta('first_name'),['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('middle_name', __('fleet.middlename'), ['class' => 'form-label']) !!}
 {!! Form::text('middle_name', $driver->getMeta('middle_name'),['class' => 'form-control']) !!}
 </div>
</div>
<div class="col-md-4">
  <div class="form-group">
 {!! Form::label('last_name', __('fleet.lastname'), ['class' => 'form-label required']) !!}
 {!! Form::text('last_name', $driver->getMeta('last_name'),['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-6">
 <div class="form-group">
 {!! Form::label('address', __('fleet.address'), ['class' => 'form-label required']) !!}
 <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-address-book-o"></i></div>
 {!! Form::text('address', $driver->getMeta('address'),['class' => 'form-control','required']) !!}
</div>

 </div>
</div>
<div class="col-md-6">

<div class="form-group">
 {!! Form::label('email', __('fleet.email'), ['class' => 'form-label required']) !!}
 <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
 {!! Form::email('email', $driver->email,['class' => 'form-control','required']) !!}
</div>

 </div>
</div>
<div class="col-md-4">
   <div class="form-group">

 {!! Form::label('phone', __('fleet.phone'), ['class' => 'form-label required']) !!}
   <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-phone"></i></div>
 {!! Form::text('phone', $driver->getMeta('phone'),['class' => 'form-control','required']) !!}
</div>
 </div>
</div>
<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('emp_id', __('fleet.employee_id'), ['class' => 'form-label']) !!}
 {!! Form::text('emp_id', $driver->getMeta('emp_id'),['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-4">
    <div class="form-group">
 {!! Form::label('contract_number', __('fleet.contract'), ['class' => 'form-label']) !!}
 {!! Form::text('contract_number', $driver->getMeta('contract_number'),['class' => 'form-control','required']) !!}
 </div>

</div>
<div class="col-md-4">
    <div class="form-group">
 {!! Form::label('license_number', __('fleet.licenseNumber'), ['class' => 'form-label required']) !!}
 {!! Form::text('license_number', $driver->getMeta('license_number'),['class' => 'form-control','required']) !!}
 </div>
</div>

<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('issue_date', __('fleet.issueDate'), ['class' => 'form-label']) !!}
 <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
 {!! Form::text('issue_date', $driver->getMeta('issue_date'),['class' => 'form-control','required']) !!}
</div>
 </div>
</div>

<div class="col-md-4">
 <div class="form-group">
 {!! Form::label('exp_date', __('fleet.expirationDate'), ['class' => 'form-label required']) !!}
 <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
 {!! Form::text('exp_date', $driver->getMeta('exp_date'),['class' => 'form-control','required']) !!}
</div>
 </div>
</div>
<div class="col-md-4">

  <div class="form-group">
 {!! Form::label('start_date', __('fleet.join_date'), ['class' => 'form-label']) !!}
 <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
 {!! Form::text('start_date', $driver->getMeta('start_date'),['class' => 'form-control']) !!}
</div>
 </div>
  </div>
<div class="col-md-4">
   <div class="form-group">
 {!! Form::label('end_date', __('fleet.leave_date'), ['class' => 'form-label']) !!}
 <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
 {!! Form::text('end_date', $driver->getMeta('end_date'),['class' => 'form-control']) !!}
</div>
 </div>
</div>
<div class="col-md-6">
  <div class="form-group">
  {!! Form::label('gender', __('fleet.gender') , ['class' => 'form-label']) !!}<br>
  <input type="radio" name="gender" class="flat-red gender" value="1" @if($driver->getMeta('gender')== 1) checked @endif> @lang('fleet.male')<br>
  <input type="radio" name="gender" class="flat-red gender" value="0" @if($driver->getMeta('gender')== 0) checked @endif> @lang('fleet.female')
</div>
 <div class="form-group">
 {!! Form::label('driver_image', __('fleet.driverImage'), ['class' => 'form-label']) !!}
@if($driver->getMeta('driver_image') != null)
<a href="{{ asset('uploads/'.$driver->getMeta('driver_image')) }}" target="_blank">View</a>
@endif
 {!! Form::file('driver_image',null,['class' => 'form-control','required']) !!}
 </div>
  <div class="form-group">
 {!! Form::label('documents', __('fleet.documents'), ['class' => 'form-label']) !!}
 @if($driver->getMeta('documents') != null)
 <a href="{{ asset('uploads/'.$driver->getMeta('documents')) }}" target="_blank">View</a>
 @endif
 {!! Form::file('documents',null,['class' => 'form-control','required']) !!}
 </div>
<div class="form-group">
 {!! Form::label('license_image', __('fleet.licenseImage'), ['class' => 'form-label']) !!}
 @if($driver->getMeta('license_image') != null)
 <a href="{{ asset('uploads/'.$driver->getMeta('license_image')) }}" target="_blank">View</a>
 @endif
 {!! Form::file('license_image',null,['class' => 'form-control','required']) !!}
 </div>
</div>
<div class="col-md-6">

<div class="form-group">
 {!! Form::label('econtact', __('fleet.emergency_details'), ['class' => 'form-label']) !!}
 {!! Form::textarea('econtact',$driver->getMeta('econtact'),['class' => 'form-control']) !!}
 </div>
</div>

<div class="col-md-12">
{!! Form::submit(__('fleet.update'), ['class' => 'btn btn-warning']) !!}
<a href="{{route("drivers.index")}}" class="btn btn-danger" >@lang('fleet.back')</a>

</div>
{!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection



@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

  $('#start_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#end_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#issue_date').datetimepicker({format: 'YYYY-MM-DD'});

  //Flat green color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  });

});
</script>
@endsection
