@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.search')</div>
                  <div class="panel-body">

                      {!! Form::open(['url' => 'searchvehicles/search','method'=>'post']) !!}
                      <div class="col-md-4">
                       <div class="form-group">
                       {!! Form::label('make', __('fleet.make'), ['class' => 'form-label']) !!}
                       {!! Form::text('make', null,['class' => 'form-control']) !!}
                       </div>

                        <div class="form-group">
                       {!! Form::label('model', __('fleet.model'), ['class' => 'form-label']) !!}
                       {!! Form::text('model', null,['class' => 'form-control']) !!}
                       </div>

                       <div class="form-group">
                       {!! Form::label('type', __('fleet.type'), ['class' => 'form-label']) !!}
                       {!! Form::text('type', null,['class' => 'form-control']) !!}
                       </div>
                        <div class="form-group">
                       {!! Form::label('license_plate', __('fleet.licensePlate'), ['class' => 'form-label']) !!}
                       {!! Form::text('license_plate', null,['class' => 'form-control']) !!}
                       </div>

                      </div>
                      <div class="col-md-4">

                       <div class="form-group">
                       {!! Form::label('year', __('fleet.year'), ['class' => 'form-label']) !!}
                       {!! Form::number('year', null,['class' => 'form-control']) !!}
                       </div>

                        <div class="form-group">
                       {!! Form::label('mileage', __('fleet.mileage'), ['class' => 'form-label']) !!}
                       {!! Form::text('mileage', null,['class' => 'form-control']) !!}
                       </div>

                      <div class="form-group">
                       {!! Form::label('engine_type', __('fleet.engine'), ['class' => 'form-label']) !!}
                       {!! Form::text('engine_type', null,['class' => 'form-control']) !!}
                       </div>
                       <div class="form-group">
                            <br>
                           {!! Form::label('in_service', __('fleet.service'), ['class' => 'form-label']) !!}
                           {!! Form::checkbox('in_service', '1', false,['class'=>'form-check-input flat-red']) !!}
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                       {!! Form::label('horse_power', __('fleet.horsePower'), ['class' => 'form-label']) !!}
                       {!! Form::text('horse_power', null,['class' => 'form-control']) !!}
                       </div>

                        <div class="form-group">
                       {!! Form::label('color', __('fleet.color'), ['class' => 'form-label']) !!}
                       {!! Form::text('color', null,['class' => 'form-control']) !!}
                       </div>

                       <div class="form-group">
                       {!! Form::label('vin', __('fleet.vin'), ['class' => 'form-label']) !!}
                       {!! Form::text('vin', null,['class' => 'form-control']) !!}
                       </div>

                      </div>
                       <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-6">
                             {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-default']) !!}
                          </div>
                        </div>
                     </div>
                      {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

<script type="text/javascript">
  $(document).ready(function() {

  //Flat green color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
});
</script>
@endsection