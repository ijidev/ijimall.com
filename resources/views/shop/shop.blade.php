@extends('shop.layouts.app')
@section('content')
  <div class="row">

    <div class="col-sm-4">
      
      <div class="card bg-green">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <h5> {{$currency->symbol . number_format($revenue * $currency->rate,2) }} </h5>
              <h6>Total Sales </h6>
            </div>
            <div class="col-4 d-flex text-light justify-content-center align-items-center">
              <i class="fas fa-chart-line"  style="font-size: 2rem;"></i>
            </div>
          </div>
        </div>
      </div> 

      <div class="card bg-orange">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <h5> {{$currency->symbol . number_format($earning * $currency->rate,2)}} </h5>
              <h6>Total Earning </h6>
            </div>
            <div class="col-4 d-flex text-light justify-content-center align-items-center">
              <i class="fas fa-wallet"  style="font-size: 2rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="card bg-danger">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <h5> {{ $currency->symbol . number_format($withdrawal->sum('total'),2) * $currency->rate }} </h5>
              <h6>Total Withdrawal </h6>
            </div>
            <div class="col-4 d-flex text-light justify-content-center align-items-center">
              <i class="fas fa-money-bill"  style="font-size: 2rem;"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="card bg-secondary">
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <h5> {{ $order->count() }} </h5>
              <h6>Total Orders </h6>
            </div>
            <div class="col-4 d-flex text-light justify-content-center align-items-center">
              <i class="fas fa-shopping-bag"  style="font-size: 2rem;"></i>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-sm-8">
      <div class="card">
        <div class="card-header">
          <h5>Anual Sales Report</h5>
        </div>
        
        <div class="card-body">
          {!! $saleschart->container() !!}
        </div>
      </div>
    </div>

  </div>

  <div class="row">
      
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h5>Products Chart</h5>
        </div>
        <div class="card-body">
          {!! $productchart->container() !!}
        </div>
      </div>
    </div>
      
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Title</h5>
          <p class="card-text">Content</p>
        </div>
      </div>
    </div>
   
  </div>
  {!! $productchart->script() !!}
  {!! $saleschart->script() !!}


  <form action="{{ route('vendor.multi-status') }}">
    <div class="card">
        <div class="card-header">
            <h4>Uncompleted Orders</h4>
            <div class="card-header-form">
                <a href="{{ route('vendor.order.uncomplete') }}" class="btn bg-orange">View All <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        {{-- <th class="text-center">
                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                    class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                            </div> --}}
                        </th>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>My Order Status</th>
                        <th>Order total</th>
                        {{-- <th>Payment status</th> --}}
                        <th></th>
                    </tr>

                    @foreach ($suborders as $suborder)

                    <tr>
                        {{-- <td class="p-0 text-center">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" name="selected[]" value="{{ $suborder->id }}" class="custom-control-input"
                                    id="checkbox-{{ $suborder->id }}">
                                <label for="checkbox-{{ $suborder->id }}" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td> --}}

                        <td>
                            {{ $suborder->order->order_number }}
                        </td>

                        <td>{{ $suborder->order->user->name }}</td>
                            <td>
                              <div class="badge bg-danger">{{ $suborder->status }}</div>
                            </td>                            
                           

                        <td>${{ number_format($suborder->grand_total * $currency->rate,2) }}</td>
                        
                        <td>
                            <div class="dropdown d-inline">
                                <a class="dropdown-item has-icon" href="{{ route('vendor.order.view', $suborder->id) }}"><i class="far fa-eye"></i> View details</a>
                            </div>
                            
                        
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row d-flex">
            {{-- footer left elenemt --}}
                <div class="flex-grow-1">
                    <nav class="d-inline-block">
                        
                    </nav>
                </div> 
                
                {{-- footer right elenemt --}}
                <div class="text-right">
                    {{ $suborders->render() }}
                </div> 
            </div>
        </div>
    </div>
  </form>

@endsection