@extends("layouts.app")
@section('extra_css')
<style type="text/css">
  .custom{
  min-width: 50px;
 left: -105px !important;
 right: 0;
}
</style>
@endsection
@section("breadcrumb")
<li class="active">@lang('fleet.vehicles')</li>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
                 <div class="box-header with-border">
              <h3 class="box-title">@lang('fleet.manageVehicles')</h3>
                <a href="{{ route('vehicles.create')}}" class="btn btn-success">@lang('fleet.addNew')</a>
                </div>

                <div class="box-body table-responsive">
<table class="table" id="data_table" style="padding-bottom: 25px">
  <thead class="thead-inverse">
    <tr>
      <th>@lang('fleet.vehicleImage')</th>
      <th>@lang('fleet.make')</th>
      <th>@lang('fleet.model')</th>
      <th>@lang('fleet.type')</th>
      <th>@lang('fleet.color')</th>
      <th>@lang('fleet.licensePlate')</th>
      <th>@lang('fleet.group')</th>
      <th>@lang('fleet.service')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
    <td>
        @if($row->vehicle_image != null)
        <img src="{{url('uploads/'.$row->vehicle_image)}}" height="70px" width="70px">
        @else
      <img src="{{ asset("img/vehicle.jpeg")}}" height="70px" width="70px">
      @endif
    </td>
		<td>{{$row->make}}</td>
		<td>{{$row->model}}</td>
		<td>{{$row->type}}</td>
		<td>{{$row->color}}</td>
		<td>{{$row->license_plate}}</td>

    <td>
     {{$row->group['name']}}
    </td>

		<td>{{($row->in_service)?"YES":"NO"}}</td>
    <td>
        <div class="btn-group">

          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <span class="fa fa-gear"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu custom" role="menu">

            <li><a href="{{ url("vehicles/".$row->id."/edit") }}"> <span aria-hidden="true" class="glyphicon glyphicon-pencil" style="color: #f0ad4e;"></span> @lang('fleet.edit')</a></li>
            {!! Form::hidden("id",$row->id) !!}

            <li><a href="javascript:document.form_{{$row->id}}.submit();"><span aria-hidden="true" class="glyphicon glyphicon-trash" style="color: #dd4b39"></span> @lang('fleet.delete')</a></li>
            <li>
              <a class="openBtn" data-id="{{$row->id}}" data-toggle="modal" data-target="#myModal2" id="openBtn">
              <span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="color: #398439"></span>@lang('fleet.view_vehicle')
             </a>
            </li>

          </ul>
        </div>
        {!! Form::open(['url' => 'vehicles/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','name'=>'form_'.$row->id]) !!}

        {!! Form::hidden("id",$row->id) !!}

        {!! Form::close() !!}
      </td>

    </tr>
    @endforeach

  </tbody>
  </table>

                </div>
            </div>
        </div>
    </div>



<!-- Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">@lang('fleet.delete')</h4>
                </div>
                <div class="modal-body">
                  <p>@lang('fleet.confirm_delete')</p>
                </div>
                <div class="modal-footer">



                  <button id="del_btn" class="btn btn-danger" type="button" data-submit="">@lang('fleet.delete')</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
              </div>

            </div>
          </div>

<!-- Modal -->

<!--model 2 -->

<div id="myModal2" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('fleet.vehicle')</h4>
      </div>
      <div class="modal-body">


      </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">
      Close
    </button>
  </div>
  </div>
</div>
</div>
<!--model 2 -->
@endsection

@section('script')

<script type="text/javascript">
  $("#del_btn").on("click",function(){
    var id=$(this).data("submit");
    $("#form_"+id).submit();
  });

   $('#myModal').on('show.bs.modal', function(e) {
  var id = e.relatedTarget.dataset.id;
  $("#del_btn").attr("data-submit",id);
    });

   $('.openBtn').click(function(){

    // alert($(this).data("id"));
    var id = $(this).attr("data-id");
    $('#myModal2 .modal-body').load('{{ url("vehicle/event")}}/'+id,function(result){
      $('#myModal2').modal({show:true});
    });
  });
</script>

@endsection
