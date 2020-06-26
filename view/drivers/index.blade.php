@extends('layouts.app')
@section('extra_css')
<style type="text/css">
  .mybtn1
  {
   padding-top: 4px;
    padding-right: 8px;
    padding-bottom: 4px;
    padding-left: 8px;
  }

.custom{
min-width: 50px;
left: -149px !important;
right: 0;
}
</style>
@endsection
@section("breadcrumb")
<li class="active">@lang('fleet.drivers')</li>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
              <h3 class="box-title">@lang('menu.drivers')</h3>
              <a href="{{ route("drivers.create") }}" class="btn btn-success"> @lang('fleet.add') </a>
            </div>

            <div class="box-body table-responsive">
 <table class="table" id="data_table" style="padding-bottom: 15px">
  <thead class="thead-inverse">
    <tr>
      <th>#</th>
      <th>@lang('fleet.driverImage')</th>
      <th>@lang('fleet.name')</th>
      <th>@lang('fleet.email')</th>
      <th>@lang('fleet.is_active')</th>
      <th>@lang('fleet.phone')</th>
      <th>@lang('fleet.start_date')</th>
      <th>@lang('fleet.action')</th>

    </tr>
  </thead>
  <tbody>

  @foreach($data as $row)
   <tr>
      <td>{{$row->id}}</td>
       <td>
        @if($row->getMeta('driver_image') != null)
        <img src="{{url('uploads/'.$row->getMeta('driver_image'))}}" height="70px" width="70px">
        @else
        <img src="{{ asset("img/no-user.jpg")}}" height="70px" width="70px">
        @endif

      </td>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{($row->getMeta('is_active')) ? "YES" : "NO"}}</td>
      <td>{{$row->getMeta('phone')}}</td>
      <td>{{$row->getMeta('start_date')}}</td>
      <td>
        <div class="btn-group">

          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <span class="fa fa-gear"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu custom" role="menu">
            <li>
              <a class="mybtn changepass" data-id="{{$row->id}}" data-toggle="modal" data-target="#changepass" title="@lang('fleet.change_password')"><i class="fa fa-key" aria-hidden="true" style="color:#269abc;"></i> @lang('fleet.change_password')</a>
            </li>
            <li><a href="{{ url("drivers/".$row->id."/edit")}}"> <span aria-hidden="true" class="glyphicon glyphicon-pencil" style="color: #f0ad4e;"></span> @lang('fleet.edit')</a></li>
            <li><a href="javascript:document.form_{{$row->id}}.submit();"><span aria-hidden="true" class="glyphicon glyphicon-trash" style="color: #dd4b39"></span>@lang('fleet.delete')</a></li>
            <li>
              @if($row->getMeta('is_active'))
              <a href="{{ url("drivers/disable/".$row->id)}}" class="mybtn" data-toggle="tooltip"  title="@lang('fleet.disable_driver')"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: #5cb85c;"></span> @lang('fleet.disable_driver')</a>
              @else
              <a href="{{ url("drivers/enable/".$row->id)}}" class="mybtn" data-toggle="tooltip"  title="@lang('fleet.enable_driver')"><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: #5cb85c;"></span> @lang('fleet.enable_driver')</a>
              @endif
            </li>
          </ul>
        </div>
        {!! Form::open(['url' => 'drivers/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','name'=>'form_'.$row->id]) !!}

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
            <div class="modal-dialog">

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
                  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')
                  </button>

                </div>
              </div>

            </div>
          </div>

<!-- Modal -->

<!-- Modal -->
          <div id="changepass" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">@lang('fleet.change_password')</h4>
                </div>
                <div class="modal-body">
                  {!! Form::open(['url'=>url('change_password'),'id'=>'changepass_form']) !!}
                  <form id="change" action="{{url('change_password')}}" method="POST">

                    {!! Form::hidden('driver_id',"",['id'=>'driver_id'])!!}
                 <div class="form-group">
                  {!! Form::label('passwd',__('fleet.password'),['class'=>"form-label"]) !!}
                  <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                  {!! Form::password('passwd',['class'=>"form-control",'id'=>'passwd','required']) !!}
                  </div>
                </div>
                <div class="modal-footer">
                  <button id="password" class="btn btn-primary" type="submit" >@lang('fleet.change_password')</button>
                </form>
                  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')
                  </button>

                </div>
              </div>

            </div>
          </div>

<!-- Modal -->
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


   $('#changepass').on('show.bs.modal', function(e) {
  var id = e.relatedTarget.dataset.id;

  $("#driver_id").val(id);
    });

   $("#changepass_form").on("submit",function(e){
    $.ajax({
      type: "POST",
      url: $(this).attr("action"),
      data: $(this).serialize(),
      success: function(data){

       new PNotify({
            title: 'Success!',
            text: 'Password Has Been Changed',
            type: 'info'
        });
      },

      dataType: "html"
    });
    $('#changepass').modal("hide");
e.preventDefault();
});
</script>
@endsection
