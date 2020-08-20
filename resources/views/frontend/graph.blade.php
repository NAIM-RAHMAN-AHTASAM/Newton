@extends('layouts.dashboard')

@section('title')
Graph
@endsection
@section('graph')
active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">

      <span class="breadcrumb-item active">Home Page</span>
  </nav>


@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">Saven Days Sale Chart</div>


                <div class="card-body">

            {!! $saven_days_sale_chart->container() !!}
            {!! $saven_days_sale_chart->script() !!}

                </div>
            </div>


            <div class="card">

                <div class="card-header">payment method Chart</div>
                <div class="card-body">

            {!! $payment_method_chart->container() !!}
            {!! $payment_method_chart->script() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
