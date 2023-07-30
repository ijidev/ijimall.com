@extends('shop.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-cyan">
          <i class="fas fa-hiking"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4 class="pull-right">New Clients</h4>
          </div>
          <div class="card-body pull-right">
            10,225
          </div>
        </div>
        <div class="card-chart">
          <canvas id="chart-1" height="80"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-purple">
          <i class="fas fa-drafting-compass"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4 class="pull-right">Delivered Order</h4>
          </div>
          <div class="card-body pull-right">
            2,857
          </div>
        </div>
        <div class="card-chart">
          <canvas id="chart-2" height="80"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-green">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4 class="pull-right">Total Earning</h4>
          </div>
          <div class="card-body pull-right">
            $17,458
          </div>
        </div>
        <div class="card-chart">
          <canvas id="chart-3" height="80"></canvas>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
            <div class="card mt-sm-5 mt-md-0">
                <div class="card-header">
                <h4>Visitors</h4>
                </div>
                <div class="card-body">
                <canvas id="donutChart"></canvas>
                <ul class="p-t-30 list-unstyled">
                    <li class="padding-5"><span><i class="fa fa-circle m-r-5 col-black"></i></span>Search Engines<span
                        class="float-right">30%</span></li>
                    <li class="padding-5"><span><i class="fa fa-circle m-r-5 col-green"></i></span>Direct Click<span
                        class="float-right">50%</span></li>
                    <li class="padding-5"><span><i class="fa fa-circle m-r-5 col-orange"></i></span>Video Click<span
                        class="float-right">20%</span></li>
                </ul>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
            <h4>Authors</h4>
            </div>
            <div class="card-body">
            <h3 class="card-title"><i class="fas fa-dollar-sign col-green font-30 p-b-10"></i> 763,215</h3>
            <canvas id="line-chart3"></canvas>
            <div class="row p-t-20">
                <div class="col-4">
                <p class="text-muted font-15 text-truncate m-b-5">Target</p>
                <h5>
                    <i class="fas fa-arrow-circle-up col-green m-r-5"></i>$15.3k
                </h5>
                </div>
                <div class="col-4">
                <p class="text-muted font-15 text-truncate m-b-5">Last
                    week</p>
                <h5>
                    <i class="fas fa-arrow-circle-down col-red m-r-5"></i>$2.8k
                </h5>
                </div>
                <div class="col-4">
                <p class="text-muted text-truncate m-b-5">Last
                    Month</p>
                <h5>
                    <i class="fas fa-arrow-circle-up col-green m-r-5"></i>$12.5k
                </h5>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection