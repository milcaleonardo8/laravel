@extends('layouts.app')
@section('extra_css')
<style type="text/css">
.nav-tabs-custom>.nav-tabs>li.active{border-top-color:#3c8dbc !important;}
</style>
@endsection
@section("breadcrumb")
<li class="active">@lang('fleet.myProfile')</li>
@endsection
@section('content')
<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

       @if($data->getMeta('driver_image') != null)
       <img src="{{url('uploads/'.$data->getMeta('driver_image'))}}" class="profile-user-img img-responsive img-circle"  alt="User profile picture">
        @else
        <img src="{{ asset("img/no-user.jpg")}}" alt="User profile picture" class="profile-user-img img-responsive img-circle">
        @endif


              <h3 class="profile-username text-center"> {{$data->getMeta('first_name')}} {{ $data->getMeta('last_name')}}</h3>



              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>
                  	@lang('fleet.total')
                  @lang('fleet.bookings')</b> <a class="pull-right"> {{$total}} </a>
                </li>

              </ul>

              <a href="{{ url('change-details/'.Auth::user()->id) }}" class="btn btn-primary btn-block"><b>@lang('fleet.editProfile')</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('fleet.about_me')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-user margin-r-5"></i> @lang('fleet.personal_info')</strong>

              <p class="text-muted">
                {{$data->getMeta('first_name')}} {{$data->getMeta('middle_name')}} {{$data->getMeta('last_name')}}
                <br>
                {{$data->getMeta('phone')}}
                <br>
                {{$data->email}}
                <br>
                {{$data->getMeta('address')}}
              </p>

              <hr>

              <strong><i class="fa fa-file-pdf-o margin-r-5"></i> @lang('fleet.doc_info')</strong>

              <p class="text-muted">
                @lang('fleet.licenseNumber'):{{$data->getMeta('license_number')}}
                <br>
                @lang('fleet.issueDate'):{{$data->getMeta('issue_date')}}
                <br>
                @lang('fleet.expirationDate'):{{$data->getMeta('exp_date')}}
                <br>
                @lang('fleet.employee_id'):{{$data->getMeta('emp_id')}}
                <br>
                @lang('fleet.contract'):{{$data->getMeta('contract_number')}}
              </p>

              <hr>
              <p>
                @if($data->getMeta('license_image') != null)
                <a href="{{asset('uploads/'.$data->getMeta('license_image'))}}" target="_blank">
                  <span class="label label-primary">@lang('fleet.lic_photo')</span>
                </a>
                @endif
              </p>

              <p>
                @if($data->getMeta('documents') != null)
                <a href="{{asset('uploads/'.$data->getMeta('documents'))}}" target="_blank">
                  <span class="label label-primary">@lang('fleet.documents')</span>
                </a>
                @endif
              </p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">@lang('fleet.activity')</a></li>
              <li><a href="#upcoming" data-toggle="tab">@lang('fleet.upcoming')</a></li>

            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
              	<h4>@lang('menu.my_bookings')</h4>
              	<table class="table">
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

				  @foreach($bookings as $row)
          @if($row->getMeta('ride_status') == "Completed")
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
          @endif
				  @endforeach

				  </tbody>
				</table>
              </div>


              <!-- /.tab-pane -->

              <div class="tab-pane" id="upcoming">
                <h4>@lang('menu.my_bookings')</h4>
                <table class="table">
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

          @foreach($bookings as $row)
          @if($row->getMeta('ride_status') == "Upcoming")
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
          @endif
          @endforeach

          </tbody>
        </table>
              </div>


              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>


@endsection

