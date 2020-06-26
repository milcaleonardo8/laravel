@extends('layouts.app')
@section('extra_css')
<style type="text/css">

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>
@endsection
@section("breadcrumb")
<li ><a href="{{ route("vehicles.index")}}">@lang('fleet.vehicles')</a></li>
<li class="active">@lang('fleet.edit_vehicle')</li>
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
            @endif


           <div class="box box-warning">
                 <div class="box-header with-border">
              <h3 class="box-title">@lang('fleet.edit_vehicle')</h3>

                </div>

                <div class="box-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
    <li class="active"><a href="#info-tab" data-toggle="tab"> @lang('fleet.general_info') <i class="fa"></i></a></li>
    <li><a href="#insurance" data-toggle="tab"> @lang('fleet.insurance') <i class="fa"></i></a></li>
    <li><a href="#acq-tab" data-toggle="tab"> @lang('fleet.purchase_info') <i class="fa"></i></a></li>
    <li><a href="#driver" data-toggle="tab"> @lang('fleet.assign_driver') <i class="fa"></i></a></li>
</ul>
</div>
    <div class="tab-content">
        <div class="tab-pane active" id="info-tab">

            {!! Form::open(['route' =>['vehicles.update',$vehicle->id],'files'=>true, 'method'=>'PATCH','class'=>'form-horizontal','id'=>'accountForm1']) !!}
            {!! Form::hidden('user_id',Auth::user()->id) !!}
            {!! Form::hidden('id',$vehicle->id) !!}

            <div class="col-md-6">
            <div class="form-group" >
                {!! Form::label('make', __('fleet.make'), ['class' => 'col-xs-5 control-label']) !!}

                <div class="col-xs-6">
                    {!! Form::text('make', $vehicle->make,['class' => 'form-control','required']) !!}

                </div>
            </div>

            <div class="form-group">
                {!! Form::label('model', __('fleet.model'), ['class' => 'col-xs-5 control-label']) !!}

                <div class="col-xs-6">
                    {!! Form::text('model', $vehicle->model,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('type', __('fleet.type'), ['class' => 'col-xs-5 control-label']) !!}


                <div class="col-xs-6">
                    {!! Form::text('type', $vehicle->type,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('year', __('fleet.year'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                {!! Form::number('year', $vehicle->year,['class' => 'form-control','required']) !!}

                </div>
            </div>

            <div class="form-group">
                {!! Form::label('int_mileage', __('fleet.intMileage'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                    {!! Form::text('int_mileage', $vehicle->int_mileage,['class' => 'form-control','required']) !!}
                </div>
            </div>
          <div class="form-group">

             {!! Form::label('vehicle_image', __('fleet.vehicleImage'), ['class' => 'col-xs-5 control-label']) !!}


            <div class="col-xs-6">
             {!! Form::file('vehicle_image',null,['class' => 'form-control']) !!}
            </div>
             </div>

             <div class="form-group" style="margin-top: -15px; margin-left: 35px">
            @if($vehicle->vehicle_image != null)
            <a href="{{ asset('uploads/'.$vehicle->vehicle_image) }}" target="_blank" class="col-xs-3 control-label">View</a>
            @endif
            </div>

            <div class="form-group">
                {!! Form::label('reg_exp_date',__('fleet.reg_exp_date'), ['class' => 'col-xs-5 control-label required']) !!}
                <div class="col-xs-6">
                  <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    {!! Form::text('reg_exp_date', $vehicle->reg_exp_date,['class' => 'form-control','required']) !!}
                  </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('in_service', __('fleet.service'), ['class' => 'col-xs-5 control-label']) !!}

                <div class="col-xs-6">
                  <label class="switch">
                    <input type="checkbox" name="in_service" value="1" @if($vehicle->in_service == '1') checked @endif>
                    <span class="slider round"></span>
                  </label>
                </div>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group" >
                {!! Form::label('engine_type', __('fleet.engine'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                    {!! Form::select('engine_type',["Petrol"=>"Petrol","Diesel"=>"Diesel"],$vehicle->engine_type,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('horse_power', __('fleet.horsePower'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                    {!! Form::text('horse_power', $vehicle->horse_power,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('color', __('fleet.color'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                     {!! Form::text('color', $vehicle->color,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('vin', __('fleet.vin'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                     {!! Form::text('vin', $vehicle->vin,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('license_plate', __('fleet.licensePlate'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                     {!! Form::text('license_plate', $vehicle->license_plate,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('lic_exp_date',__('fleet.lic_exp_date'), ['class' => 'col-xs-5 control-label required']) !!}
                <div class="col-xs-6">
                  <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    {!! Form::text('lic_exp_date', $vehicle->lic_exp_date,['class' => 'form-control','required']) !!}
                  </div>
                </div>
            </div>

            <div class="form-group">
             {!! Form::label('group_id',__('fleet.selectGroup'), ['class' => 'col-xs-5 control-label']) !!}
             <div class="col-xs-6">
             <select id="group_id" name="group_id" class="form-control">
            <option value="">@lang('fleet.vehicleGroup')</option>
            @foreach($groups as $group)
            @if($group->id == $vehicle->group_id)
            <option value="{{$group->id}}" selected>{{$group->name}}</option>
            @else
            <option value="{{$group->id}}" >{{$group->name}}</option>
            @endif
            @endforeach
             </select>
            </div>
             </div>


         </div>


            <div style=" margin-bottom: 20px;">
                <div class="form-group" style="margin-top: 15px;">
                <div class="col-xs-6 col-xs-offset-3">
                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-warning']) !!}
                </div>
            </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="tab-pane " id="insurance" >

            {!! Form::open(['url' => 'store_insurance','files'=>true, 'method'=>'post','class'=>'form-horizontal','id'=>'accountForm']) !!}
            {!! Form::hidden('user_id',Auth::user()->id) !!}
            {!! Form::hidden('vehicle_id',$vehicle->id) !!}

            <div class="form-group" style="margin-top: 20px;">
                {!! Form::label('insurance_number', __('fleet.insuranceNumber'), ['class' => 'col-xs-5 control-label']) !!}

                <div class="col-xs-6">
                    {!! Form::text('insurance_number', $vehicle->getMeta('ins_number'),['class' => 'form-control','required']) !!}

                </div>
            </div>
            <div class="form-group">
              <label for="documents" class="col-xs-5 control-label">@lang('fleet.inc_doc')
              </label>

                <div class="col-xs-6">
                  {!! Form::file('documents',null,['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group" style="margin-top: -15px; margin-left: 370px">
                @if($vehicle->getMeta('documents') != null)
                 <a href="{{ url('uploads/'.$vehicle->getMeta('documents')) }}" target="_blank">View</a>
                 @endif
            </div>

            <div class="form-group">
                {!! Form::label('exp_date', __('fleet.inc_expirationDate'), ['class' => 'col-xs-5 control-label required']) !!}
                <div class="col-xs-6">

                    <div class="input-group date">
  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    {!! Form::text('exp_date', $vehicle->getMeta('ins_exp_date'),['class' => 'form-control','required']) !!}
                  </div>
                </div>
            </div>

            <div style=" margin-bottom: 20px;">
                <div class="form-group" style="margin-top: 15px;">
                <div class="col-xs-6 col-xs-offset-3">
                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-warning']) !!}
                </div>
            </div>
            </div>
            {!! Form::close() !!}

        </div>

        <div class="tab-pane " id="acq-tab" >
<div class="alert alert-success hide fade in alert-dismissable" id="msg_acq">
  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>

  <strong>Hurray!</strong> Expense added successfully.
</div>
            <div class="row" >
<div class="col-md-12">
  <div class="box box-success">
                 <div class="box-header with-border">
              <h3 class="box-title">@lang('fleet.acquisition') @lang('fleet.add')</h3>
</div>
<div class="box-body">

{!! Form::open(['route' => 'acquisition.store','method'=>'post','class'=>'form-inline','id'=>'add_form']) !!}
{!! Form::hidden('user_id',Auth::user()->id) !!}
{!! Form::hidden('vehicle_id',$vehicle->id)  !!}
<div class="form-group">
{!! Form::label('exp_name', __('fleet.expenseType'), ['class' => 'form-label']) !!}
{!! Form::text('exp_name',  null,['class'=>'form-control','required']); !!}
</div>
<div class="form-group"></div>
<div class="form-group">
{!! Form::label('exp_amount', __('fleet.expenseAmount'), ['class' => 'form-label']) !!}
<div class="input-group date">
  <div class="input-group-addon">{{Hyvikk::get('currency')}}</div>
{!! Form::number('exp_amount',null,['class'=>'form-control','required']); !!}
</div>
</div>
<div class="form-group"></div>
<button type="submit" class="btn btn-success">@lang('fleet.add')</button>
{!! Form::close() !!}

</div>
</div>
</div>
</div>
<div class="row" >
<div class="col-md-12">
   <div class="box box-primary">
                 <div class="box-header with-border">
              <h3 class="box-title">@lang('fleet.acquisition') :<strong>{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->license_plate }}</strong>



</h3>
</div>
<div class="box-body" id="acq_table">
<div class="row">
<div class="col-md-12">

@php
$value = unserialize($vehicle->getMeta('purchase_info'));
@endphp

<table class="table">
<thead>
<th>@lang('fleet.expenseType')</th>
<th>@lang('fleet.expenseAmount')</th>
<th>@lang('fleet.action')</th>

</thead>

<tbody id="hvk">
@if($value != null)
@php
$i=0;
@endphp
@foreach($value as $key=>$row)

<tr>

@php
$i+=$row['exp_amount'];
@endphp

<td>{{$row['exp_name']}}</td>
<td>{{$row['exp_amount']}}</td>
<td>
   {!! Form::open(['route' =>['acquisition.destroy',$vehicle->id],'method'=>'DELETE','class'=>'form-horizontal']) !!}
   {!! Form::hidden("vid",$vehicle->id) !!}
   {!! Form::hidden("key",$key) !!}
  <button type="button" class="btn btn-danger del_info" data-vehicle="{{$vehicle->id}}" data-key="{{$key}}">
    <span class="glyphicon glyphicon-remove"></span>
  </button>
  {!! Form::close() !!}

</td>

</tr>
@endforeach

<tr>
<td><strong>@lang('fleet.total')</strong></td>
<td><strong>{{$i}}</strong></td>
<td></td>
</tr>
@endif
</tbody>
</table>
</div>

</div>

</div>
</div>
</div>

        </div>
    </div>

<div class="tab-pane " id="driver" >

            {!! Form::open(['url' => 'assignDriver', 'method'=>'post','class'=>'form-horizontal','id'=>'driverForm']) !!}

            {!! Form::hidden('vehicle_id',$vehicle->id) !!}

            <div class="col-md-6">
            <div class="form-group">
            {!! Form::label('driver_id',__('fleet.selectDriver'), ['class' => 'form-label']) !!}

            <select id="driver_id" name="driver_id" class="form-control" required>

            <option value="">@lang('fleet.selectDriver')</option>

            @foreach($drivers as $driver)
            @if($vehicle->getMeta('driver_id') == $driver->id)
            <option value="{{$driver->id}}" selected>{{$driver->name}}</option>
            @else
            <option value="{{$driver->id}}"  >{{$driver->name}}</option>
            @endif
            @endforeach
            </select>
            </div>
            </div>

            <div style=" margin-bottom: 20px;">
            <div class="form-group" style="margin-top: 15px;">
            <div class="col-xs-6 col-xs-offset-3">
              {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-warning']) !!}
            </div>
            </div>
            </div>
            </div>
{!! Form::close() !!}
</div>
            </div>

            </div>
        </div>
    </div>



<!-- Modal -->
@endsection

@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/datetimepicker.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
@if(isset($_GET['tab']) && $_GET['tab']!="")
$('.nav-tabs a[href="#{{$_GET['tab']}}"]').tab('show')
@endif
  $('#start_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#end_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#lic_exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#reg_exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#issue_date').datetimepicker({format: 'YYYY-MM-DD'});

  $(document).on("click",".del_info",function(e){
    var hvk=confirm("Are you sure?");
    if(hvk==true){

    var vid=$(this).data("vehicle");
    var key = $(this).data('key');
    var action="{{ route('acquisition.index')}}/"+vid;

        $.ajax({
  type: "POST",
  url: action,
  data: "_method=DELETE&_token="+window.Laravel.csrfToken+"&key="+key+"&vehicle_id="+vid,
  success: function(data){

    $("#acq_table").empty();
    $("#acq_table").html(data);
  new PNotify({
        title: 'Deleted!',
        text:'@lang("fleet.deleted")',
        type: 'wanring'
    })
  }
,
dataType: "HTML",
});
   }
  });

$("#add_form").on("submit",function(e){

$.ajax({
  type: "POST",
  url: $(this).attr("action"),
  data: $(this).serialize(),
  success: function(data){
    $("#acq_table").empty();
    $("#acq_table").html(data);
    new PNotify({
        title: 'Success!',
        text: '@lang("fleet.exp_add")',
        type: 'success'
    });
            },
  dataType: "HTML"
});
e.preventDefault();
});



$("#accountForm").on("submit",function(e){

$.ajax({
  type: "POST",
  url: $("#accountForm").attr("action"),
  data: new FormData(this),
  mimeType: 'multipart/form-data',
  contentType: false,
            cache: false,
            processData:false,
  success: new PNotify({
        title: 'Success!',
        text: '@lang("fleet.ins_add")',
        type: 'success'
    }),
dataType: "json",
});
e.preventDefault();
});
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

});
</script>


@endsection
