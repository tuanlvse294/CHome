@extends('layouts.admin')
@section('content')
    <div class="ui fluid container">
        <div class="ui huge header">{{$title}}</div>
        <div class="ui one column grid">
            <div class="column">
                <div class="ui right floated buttons">
                    <button id="reportrange" class="ui orange icon labeled  button">
                        <i class="calendar icon" style="margin:0"></i>
                        <span>{{old('start')}} - {{old('end')}}</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="ui blue segment" style="text-align: center">
            <div class="ui statistic">
                <div class="value">
                    {{money_format("%n",$total)}}
                </div>
                <div class="label">
                    <i class="user building"></i>Total income
                </div>
            </div>
        </div>
        <div class="ui green segment">
            {!! $revenueChart->container() !!}
            {!! $revenueChart->script() !!}
        </div>

    </div>

    <form method="get" id="time_form">
        <input type="hidden" id="start_time" name="start" value="{{old('start')}}">
        <input type="hidden" id="end_time" name="end" value="{{old('end')}}">
    </form>
    <script>
        var cb = function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $("#start_time").val(start.format('MMMM D, YYYY'));
            $("#end_time").val(end.format('MMMM D, YYYY'));
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#time_form').submit();
        };

        var optionSet = {
            startDate: moment().subtract(7, 'days'),
            endDate: moment(),
            opens: 'left',
            ranges: {
                'Trong 1 tuần': [moment().subtract(6, 'days'), moment()],
                'Trong 1 tháng': [moment().subtract(29, 'days'), moment()],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        };

        $(function () {
            $('#reportrange').daterangepicker(optionSet, cb);
        });
    </script>

@endsection