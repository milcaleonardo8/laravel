@extends('layouts.app')
@section("breadcrumb")
<li><a href="#">@lang('menu.reports')</a></li>
<li class="active">@lang('fleet.monthlyReport')</li>
@endsection
@section('content')
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">@lang('fleet.monthlyReport')
</h3>
</div>

<div class="box-body">
{!! Form::open(['route' => 'dreports.monthly','method'=>'post','class'=>'form-inline']) !!}

<div class="form-group">
{!! Form::label('year', __('fleet.year'), ['class' => 'form-label']) !!}
{!! Form::select('year', $years, $year_select,['class'=>'form-control']); !!}
</div>
<div class="form-group">
{!! Form::label('month', __('fleet.month'), ['class' => 'form-label']) !!}
{!! Form::selectMonth('month',$month_select,['class'=>'form-control']); !!}
</div>
<div class="form-group">
{!! Form::label('vehicle', __('fleet.vehicles'), ['class' => 'form-label']) !!}
 <select id="vehicle_id" name="vehicle_id" class="form-control vehicles">
  <option value="">@lang('fleet.selectVehicle')</option>
    @foreach($vehicles as $vehicle)
    <option value="{{ $vehicle->id }}" @if($vehicle->id == $vehicle_select) selected @endif>{{$vehicle->make}}-{{$vehicle->model}}-{{$vehicle->license_plate}}</option>

    @endforeach
  </select>
</div>
<button type="submit" class="btn btn-primary">@lang('fleet.search')</button>
{!! Form::close() !!}

</div>
</div>
</div>
</div>



@if(isset($result))
<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">
@lang('fleet.report')
</h3>
</div>

<div class="box-body">

<div class="col-md-6">

<div class="box box-warning">
<div class="box-header with-border">
<h3 class="box-title">Chart - @lang('fleet.income')</h3></div>

<div class="box-body">
<canvas id="canvas1" width="400" height="300"></canvas>
</div>
</div>
<table class="table table-bordered table-striped table-hover">
@php ($income_amt = (is_null($income[0]->income) ? 0 : $income[0]->income))
@php ($expense_amt = (is_null($expenses[0]->expense) ? 0 : $expenses[0]->expense))
<thead>
<tr>
<th scope="row">@lang('fleet.pl')</th>

<td><strong>{{ Hyvikk::get("currency")}}{{ $income_amt-$expense_amt}}</strong></td>
</tr>
</thead>

<tbody>
<tr>
<th scope="row">@lang('fleet.income')</th>

<td>{{ Hyvikk::get("currency")}}{{$income_amt}}</td>
</tr>
<tr>
<th scope="row">@lang('fleet.expenses')</th>

<td>{{ Hyvikk::get("currency")}}{{$expense_amt}}</td>
</tr>


</tbody>
</table>

</div>


<div class="col-md-6">
<div class="box box-warning">
<div class="box-header with-border">
<h3 class="box-title">Chart - @lang('fleet.expensesByCategory')</h3></div>

<div class="box-body">
<canvas id="canvas3" width="400" height="300"></canvas>
</div>
</div>
<table class="table table-bordered table-striped table-hover">
<thead>
    <tr>
    @php($tot = 0)

@foreach ($expense_by_cat as $exp)
	@php($tot = $tot + $exp->expense)
@endforeach
<th scope="row">@lang('fleet.expensesByCategory')</th>
<td><strong>{{ Hyvikk::get("currency")}}{{$tot}}</strong></td>
</tr>
</thead>
<tbody>


@foreach($expense_by_cat as $exp)
<tr>
<th scope="row">{{$expense_cats[$exp->expense_type]}}</th>

<td>{{ Hyvikk::get("currency")}}{{$exp->expense}}</td>
</tr>
@endforeach


</tbody>
</table>

</div>



</div>
</div>
</div>

</div>

@endif
<div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">@lang('fleet.yearly_chart')</h3>
        </div>
          <div class="box-body">
          <canvas id="yearly" width="800" height="300"></canvas>
          </div>
      </div>
    </div>
</div>
@endsection

@section("script2")

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script>
window.chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(201, 203, 207)',
  black: 'rgb(0,0,0)',
  brown:'rgb(255,178,102)'
};
function random_color(i){
  var color1,color2,color3;
  var col_arr=[];

  for(x=0;x<=i;x++){

  var colors = ["rgba(176,254,27,0.5)","rgba(255,7,111,0.5)","rgba(84,61,152,0.5)","rgba(220,147,153,0.5)","rgba(134,241,157,0.5)","rgba(152,114,93,0.5)","rgba(66,51,27,0.5)","rgba(238,26,216,0.5)","rgba(80,137,28,0.5)","rgba(16,68,187,0.5)","rgba(22,122,44,0.5)","rgba(189,53,243,0.5)"];

  var c1 = [176,255,84,220,134,66,238];
  var c2 = [254,61,147,114,51,26,137];
  var c3 = [27,111,153,93,157,216,187,44,243];
  color1 = c1[Math.floor(Math.random()*c1.length)];
  color2 = c2[Math.floor(Math.random()*c2.length)];
  color3 = c3[Math.floor(Math.random()*c3.length)];

  col_arr.push("rgba("+color1+","+color2+","+color3+",0.5)");
  // col_arr.push(colors[Math.floor(Math.random()*colors.length)]); //same color repeat
  }
  // console.log(col_arr);
  return col_arr;
}
        var chartData = {
            labels: ["@lang('fleet.income')", "@lang('fleet.expenses')"],
            datasets: [{
                type: 'pie',
                label: '',
                backgroundColor: [window.chartColors.green,window.chartColors.red],
                borderColor: window.chartColors.black,
                borderWidth: 1,
                data: [{{@$income_amt}},{{@$expense_amt}}]
            }]
        };
                 var chartData3 = {
            labels: [@foreach($expense_by_cat as $exp) "{{$expense_cats[$exp->expense_type]}}", @endforeach],
            datasets: [{
                type: 'pie',
                label: '',
                backgroundColor: random_color({{count($expense_by_cat)}}),
                borderColor: window.chartColors.black,
                borderWidth: 1,
                data: [@foreach($expense_by_cat as $exp) {{$exp->expense}}, @endforeach]
            }]
        };

        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var config = {
            type: 'line',
            data: {
                labels: MONTHS,
                datasets: [{
                    label: "@lang('fleet.expense')",
                    backgroundColor: '#dd4b39',
                    borderColor: '#dd4b39',
                    data: [{{$yearly_expense}}],
                    fill: false,
                }, {
                    label: "@lang('fleet.income')",
                    fill: false,
                    backgroundColor: '#00a65a',
                    borderColor: '#00a65a',
                    data: [{{$yearly_income}}],
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "@lang('fleet.month')"
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "@lang('fleet.amount')"
                        }
                    }]
                }
            }
        };


        window.onload = function() {
            var ctx = document.getElementById("canvas1").getContext("2d");
            window.myMixedChart = new Chart(ctx, {
                type: 'pie',
                data: chartData,
                options: {

                    responsive: true,
                    title: {
                        display: false,
                        text: "@lang('fleet.chart')"
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });
                     var ctx = document.getElementById("canvas3").getContext("2d");
            window.myMixedChart = new Chart(ctx, {
                type: 'pie',
                data: chartData3,
                options: {

                    responsive: true,
                    title: {
                        display: false,
                        text: "@lang('fleet.chart')"
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    }
                }
            });
            var ctx = document.getElementById("yearly").getContext("2d");
            window.myLine = new Chart(ctx, config);

        };

    </script>
@endsection