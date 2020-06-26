@extends("layouts.app")
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.result') </div>
                <div class="panel-body table-responsive">
                <?php if (count($index)): ?>
                    <table class="table">
                    <thead class="thead-inverse">
                      <tr>
                        <th>@lang('fleet.make')</th>
                        <th>@lang('fleet.model')</th>
                        <th>@lang('fleet.type')</th>
                        <th>@lang('fleet.engine')</th>
                        <th>@lang('fleet.color')</th>
                        <th>@lang('fleet.licensePlate')</th>
                        <th>@lang('fleet.mileage')</th>
                        <th>@lang('fleet.service')</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                  @foreach($index as $row)
                   <tr>
                    <td>{{$row->make}}</td>
                    <td>{{$row->model}}</td>
                    <td>{{$row->type}}</td>
                    <td>{{$row->engine_type}}</td>
                    <td>{{$row->color}}</td>
                    <td>{{$row->license_plate}}</td>
                    <td>{{$row->mileage}}</td>
                    <td>{{($row->in_service)?"YES":"NO"}}</td>
                      <td>

                            {!! Form::open(['url' => 'vehicles/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal']) !!}

                          <a href="{{ url("vehicles/".$row->id."/edit")}}" class="btn btn-warning">
                          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                          </a>
                                  <input type="hidden" name="id" value="{{ $row->id }}">
                                  <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                          <?php if ($row->in_service) {?>
                              <a href="{{ url("drivers/assign/".$row->id)}}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                          </a>
                      <?php }?>
                        {!! Form::close() !!}
                      </td>

                    </tr>
                    @endforeach

                    </tbody>
                    </table>
                    <?php else: ?>
                    <h6>NO DATA AVAILABLE.</h6>
                  <?php endif;?>
              </div>
            </div>
          </div>
       </div>

@endsection
