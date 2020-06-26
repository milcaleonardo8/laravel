@extends('layouts.app')
@section("breadcrumb")
<li class="active">@lang('menu.my_bookings')</li>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">@lang('menu.my_bookings')</h3>

                </div>

                <div class="box-body table-responsive">
<table class="table" id="data_table">
  <thead class="thead-inverse">
    <tr>
      <th>@lang('fleet.customer')</th>
      <th>@lang('fleet.vehicle')</th>
      <th>@lang('fleet.pickup')</th>
      <th>@lang('fleet.dropoff')</th>
      <th>@lang('fleet.pickup_addr')</th>
      <th>@lang('fleet.dropoff_addr')</th>
      <th>@lang('fleet.passengers')</th>
    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->customer->name}}</td>
      <td>{{$row->vehicle['make']}} - {{$row->vehicle['model']}} - {{$row->vehicle['license_plate']}}</td>
      <td>
        @if($row->pickup != null)
        {{date('d/m/Y g:i A',strtotime($row->pickup))}}
        @endif
      </td>
      <td>
        @if($row->dropoff != null)
        {{date('d/m/Y g:i A',strtotime($row->dropoff))}}
        @endif
      </td>
      <td>{{$row->pickup_addr}}</td>
      <td>{{$row->dest_addr}}</td>
      <td>{{$row->travellers}}</td>
   </tr>
  @endforeach

  </tbody>
  </table>
                </div>
            </div>
        </div>
    </div>

@endsection
