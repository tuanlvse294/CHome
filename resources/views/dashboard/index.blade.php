@extends('layouts.default')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="/bower_components/moment/min/moment.min.js"></script>
    <script src="/bower_components/semantic-ui-daterangepicker-master/daterangepicker.js"></script>
    <link rel="stylesheet" href="/bower_components/semantic-ui-daterangepicker-master/daterangepicker.css"/>

    <div class="ui container">
        <div class="ui breadcrumb">
            <a class="section" href="/">Trang chủ</a>
            <i class="right angle icon divider"></i>
            <div class="active section">{{$title}}</div>
        </div>
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
        <div class="ui green segment">
            {!! $generalChart->container() !!}
            {!! $generalChart->script() !!}
        </div>

        <div  class="ui stackable two column grid">
            <div class="column">
                <div class="ui orange segment" >
                    {!! $browsersChart->container() !!}
                    {!! $browsersChart->script() !!}
                </div>
            </div>
            <div class="column">
                <div class="ui purple segment" >
                    {!! $userTypesChart->container() !!}
                    {!! $userTypesChart->script() !!}
                </div>
            </div>
        </div>


        <div class="ui stackable four column grid ">
            <div class="column center aligned">
                <div class="ui red segment">
                    <div class="ui statistic">
                        <div class="value">
                            {{\App\User::query()->count()}}
                        </div>
                        <div class="label">
                            <i class="user icon"></i>User

                        </div>
                    </div>

                </div>
            </div>
            <div class="column center aligned">
                <div class="ui blue segment">
                    <div class="ui statistic">
                        <div class="value">
                            {{\App\Offer::query()->count()}}
                        </div>
                        <div class="label">
                            <i class="user building"></i>Offers
                        </div>
                    </div>

                </div>
            </div>

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