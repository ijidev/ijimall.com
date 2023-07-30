@extends('shop.layouts.app')
@section('title')
    Withdrawal
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Balance <i class="fas fa-wallet "></i></h5>
        <div class="row">
            <div class="col-sm-6">
                <p class="card-text">Wallet Bal <i class="fas fa-wallet fa-7x fa-fw"></i>: {{$currency->symbol . $wallet->active_bal * $currency->rate}}</p>
                <p class="card-text">Hold Bal: {{$currency->symbol . $wallet->hold_bal * $currency->rate}}</p>
            </div>
            <div class="col-sm-6 align-end">
                <form action="{{ route('withdraw.request') }}">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light" id="withdraw-amount">{{ $currency->symbol }}</span>
                        </div>
                        <input class="form-control" type="text" name="amount" placeholder="Enter Amount to Withdraw" aria-label="Recipient's text" aria-describedby="withdraw-amount">
                        <div class="input-group-append">
                            <button class="input-group-text btn btn-primary" id="withdraw-amount">Request Withdrawal</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-header">
            <h5 class="card-title">Withdrawal History</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Withdrawal Amount</th>
                        <th>Withdrawal Status</th>
                        <th>Withdrawal Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($withdraws as $withdraw)
                        <tr>
                            <td>{{$currency->symbol. $withdraw->amount *$currency->rate}}</td>
                            <td>{{ $withdraw->status }}</td>
                            <td>{{ $withdraw->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-light">
                    <tr>
                        <th>Withdrawal Amount</th>
                        <th>Withdrawal Status</th>
                        <th>Withdrawal Time</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        

    </div>
</div>
@endsection