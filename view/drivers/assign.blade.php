@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('fleet.assign')


                </div>

                <div class="panel-body table-responsive">

                      {!! Form::open(['url' => 'drivers/add','method'=>'post']) !!}

{!! Form::hidden('vehicle_id',$vid) !!}
                           <table class="table">
                    <thead class="thead-inverse">
                      <tr>
                        <th>@lang('fleet.name')</th>
                        <th>@lang('fleet.action')</th>

                      </tr>
                    </thead>
                    <tbody>


                      @foreach($drivers as $driver)
                          @if($driver->vehicle['vehicle_id']=="" || $driver->vehicle['vehicle_id']==$vid and $driver->get_detail->is_active==1)
                           <tr>
                        <td>{{$driver->name }}   </td>
                        @if($driver->vehicle['vehicle_id']==$vid)
                        <td>{!! Form::radio('assign',true,$driver->id) !!}</td>
                        @else
                        <td>{!! Form::radio('assign',$driver->id) !!}</td>
                        @endif
                        </tr>
                        @endif

                          @endforeach

                    </tbody>
                    </table>

                       {!! Form::submit(__('fleet.submit'), ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>

@endsection
