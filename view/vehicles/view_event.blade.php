
<div role="tabpanel">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#info-tab" data-toggle="tab"> @lang('fleet.general_info') <i class="fa"></i></a>
        </li>


        <li><a href="#address-tab" data-toggle="tab"> @lang('fleet.insurance') <i class="fa"></i></a>
        </li>



        <li><a href="#acq-tab" data-toggle="tab"> @lang('fleet.purchase_info') <i class="fa"></i></a>
        </li>

    </ul>


	<div class="tab-content">
		<!-- tab1-->
		<div class="tab-pane active" id="info-tab">

		<table class="table table-striped">

		<tr>
		<th>@lang('fleet.vehicle')</th>
		<td>{{$vehicle->make}}   </td>
		</tr>

		<tr>
		<th>@lang('fleet.model')</th>
		<td>
			{{$vehicle->model}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.type')</th>
		<td>
			{{$vehicle->type}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.year')</th>
		<td>
			{{$vehicle->year}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.intMileage') (km)</th>
		<td>
			{{$vehicle->int_mileage}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.vehicleImage')</th>
		<td>
			@if($vehicle->vehicle_image != null)
            <a href="{{ asset('uploads/'.$vehicle->vehicle_image) }}" target="_blank" class="col-xs-3 control-label">View</a>
            @endif
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.engine')</th>
		<td>
			{{$vehicle->engine_type}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.horsePower')</th>
		<td>
			{{$vehicle->horse_power}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.color')</th>
		<td>
			{{$vehicle->color}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.vin')</th>
		<td>
			{{$vehicle->vin}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.licensePlate')</th>
		<td>
			{{$vehicle->license_plate}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.lic_exp_date')</th>
		<td>
			{{$vehicle->lic_exp_date}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.reg_exp_date')</th>
		<td>
			{{$vehicle->reg_exp_date}}
		</td>
		</tr>

		</table>
		</div>
		<!--tab1-->

		<!--tab2-->
		<div class="tab-pane" id="address-tab" >

			<table class="table table-striped">

		<tr>
		<th>@lang('fleet.vehicle')</th>
		<td>
			{{$vehicle->make}}-{{$vehicle->model}}-{{$vehicle->type}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.insuranceNumber')</th>
		<td>
			{{$vehicle->getMeta('ins_number')}}
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.inc_doc')</th>
		<td>
			@if($vehicle->getMeta('documents') != null)
             <a href="{{ asset('uploads/'.$vehicle->getMeta('documents')) }}" target="_blank">
             View
         	 </a>
            @endif
		</td>
		</tr>

		<tr>
		<th>@lang('fleet.inc_expirationDate')</th>
		<td>
			{{$vehicle->getMeta('ins_exp_date')}}
		</td>
		</tr>

		</table>

		</div>
		<!--tab3-->

		<div class="tab-pane " id="acq-tab" >

			<div class="panel panel-default">

<div class="panel-body">

<div class="row">
<div class="col-md-12">
<table class="table">
<thead>
<th>@lang('fleet.expenseType')</th>
<th>@lang('fleet.expenseAmount')</th>

</thead>
@php
$value = unserialize($vehicle->getMeta('purchase_info'));
@endphp
<tbody id="hvk">
@if($value != null)
@php
$i=0;
@endphp
@foreach($value as $row)

<tr>

@php
$i+=$row['exp_amount'];
@endphp

<td>{{$row['exp_name']}}</td>
<td>{{$row['exp_amount']}}</td>
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

		<!--tab3-->
	</div>
</div>

