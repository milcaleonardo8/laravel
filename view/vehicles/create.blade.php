@extends('layouts.app')
@section('extra_css')
<style type="text/css">
.nav-tabs-custom>.nav-tabs>li.active{border-top-color:#00a65a !important;}

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
<li class="active">@lang('fleet.addVehicle')</li>


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
          <div class="box box-success">
                 <div class="box-header with-border">
              <h3 class="box-title">@lang('fleet.addVehicle')</h3>

                </div>

                <div class="box-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
    <li class="active"><a href="#info-tab" data-toggle="tab"> @lang('fleet.general_info') <i class="fa"></i></a></li>
</ul>
</div>
    <div class="tab-content">
        <div class="tab-pane active" id="info-tab">
            {!! Form::open(['route' => 'vehicles.store','files'=>true, 'method'=>'post','class'=>'form-horizontal','id'=>'accountForm']) !!}
            {!! Form::hidden('user_id',Auth::user()->id) !!}
            <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('make', __('fleet.make'), ['class' => 'col-xs-5 control-label']) !!}

                <div class="col-xs-6">
                    {!! Form::text('make', null,['class' => 'form-control','required']) !!}

                </div>
            </div>

            <div class="form-group">
                {!! Form::label('model', __('fleet.model'), ['class' => 'col-xs-5 control-label']) !!}

                <div class="col-xs-6">
                    {!! Form::text('model', null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('type', __('fleet.type'), ['class' => 'col-xs-5 control-label']) !!}


                <div class="col-xs-6">
                    {!! Form::text('type', null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('year', __('fleet.year'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                {!! Form::number('year', null,['class' => 'form-control','required']) !!}

                </div>
            </div>

            <div class="form-group">
                {!! Form::label('int_mileage', __('fleet.intMileage'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                    {!! Form::number('int_mileage', null,['class' => 'form-control','required']) !!}
                </div>
            </div>
           <div class="form-group">
                {!! Form::label('vehicle_image', __('fleet.vehicleImage'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                    {!! Form::file('vehicle_image',null,['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('reg_exp_date',__('fleet.reg_exp_date'), ['class' => 'col-xs-5 control-label required']) !!}
                <div class="col-xs-6">
                    <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    {!! Form::text('reg_exp_date', null,['class' => 'form-control','required']) !!}
                </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('in_service', __('fleet.service'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                    <label class="switch">
                        <input type="checkbox" name="in_service" value="1">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group" >
                {!! Form::label('engine_type', __('fleet.engine'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                    {!! Form::select('engine_type',["Petrol"=>"Petrol","Diesel"=>"Diesel"],null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('horse_power', __('fleet.horsePower'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                    {!! Form::number('horse_power', null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('color', __('fleet.color'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                     {!! Form::text('color', null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('vin', __('fleet.vin'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                     {!! Form::text('vin', null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('license_plate', __('fleet.licensePlate'), ['class' => 'col-xs-5 control-label']) !!}
                <div class="col-xs-6">
                     {!! Form::text('license_plate', null,['class' => 'form-control','required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('lic_exp_date',__('fleet.lic_exp_date'), ['class' => 'col-xs-5 control-label required']) !!}
                <div class="col-xs-6">
                    <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    {!! Form::text('lic_exp_date', null,['class' => 'form-control','required']) !!}
                    </div>
                </div>
            </div>

             <div class="form-group">
             {!! Form::label('group_id',__('fleet.selectGroup'), ['class' => 'col-xs-5 control-label']) !!}
             <div class="col-xs-6">
             <select id="group_id" name="group_id" class="form-control">
            <option value="">@lang('fleet.vehicleGroup')</option>
            @foreach($groups as $group)
            @if($group->id == 1)
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
                    {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-success']) !!}
                </div>
            </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>

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
  $('#lic_exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#reg_exp_date').datetimepicker({format: 'YYYY-MM-DD'});
  $('#issue_date').datetimepicker({format: 'YYYY-MM-DD'});

  //Flat green color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

});
</script>
@endsection
