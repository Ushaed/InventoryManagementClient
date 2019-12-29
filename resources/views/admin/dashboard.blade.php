@extends('partials.app')

@section('title','Dashboard')
@section('title-card-h1','Dashboard')
@section('title-card-small','Control plane')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@stop
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @if($errors->count()===1)
                {{ $errors->first()}}
            @else
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="text-align: left">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
{{--    @if(Session::has('message'))--}}
{{--        <p class="alert alert-{{session('type')}}">{{ Session::get('message') }}</p>--}}
{{--    @endif--}}
    @include('partials.dashboardBox')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card card-clock mb-3">
                <div class="card-body text-white bg-yellow p-0 mb-0 text-center pt-2 pb-2 rounded-lg">
                    <h2 id="date"></h2>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
            <div class="card card-clock mb-3">
                <div class="card-body text-white bg-yellow p-0 mb-0 text-center pt-2 pb-2 rounded-lg">
                    <h2 id="time" onload="showTime()"></h2>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            function showTime(){
                let d = new Date();
                let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                let hours = d.getHours() > 12 ? d.getHours() - 12 : d.getHours();
                let am_or_pm = d.getHours() > 12 ? "PM" : "AM";
                let fixed_hours = hours < 10 ? "0" + hours : hours;
                let minutes = d.getMinutes() < 10 ? "0" + d.getMinutes() : d.getMinutes();
                let seconds = d.getSeconds() < 10 ? "0" + d.getSeconds() : d.getSeconds();
                document.getElementById("time").innerHTML = fixed_hours + ":" + minutes + ":" + seconds + " " + am_or_pm;
                document.getElementById("date").innerHTML = days[d.getDay()] + " " + d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
                setTimeout(showTime,1000);
            }
            showTime();
        });

    </script>
@stop
