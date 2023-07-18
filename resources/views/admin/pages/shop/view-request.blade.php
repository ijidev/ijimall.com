@extends('admin.layout.tmpl')
@section('title')
    Withdrawal
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h5 class="card-title">Vendor payment details</h5>
                    <hr>
                    <p class="card-text">Bank Name:</p>
                    <p class="card-text">Account No:</p>
                    <p class="card-text">Account Name:</p>
                </div>
                
                <div class="col-sm-6">
                    <h5 class="card-title">Withdrawal details</h5>
                    <hr>
                    <p class="card-text">Amount: {{$currency->symbol . $withdraw->amount * $currency->rate }}</p>
                    <p class="card-text">Account No:</p>
                    @if ($withdraw->status == 'approved')
                        <div class="badge bg-success text-white">
                            Paid
                        </div>
                    @else
                        <a class="dropdown-item btn btn-link" type="button" href="{{ route('withdraw.approve',$withdraw->id) }}"><i class="fas fa-check-circle fa-lg"></i> Mark as Paid</a>

                    @endif
                </div>
            </div>
            
        </div>
    </div>
@endsection