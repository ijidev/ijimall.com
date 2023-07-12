@extends('admin.layout.tmpl')
@section('title')
    Withdrawal
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Withdrawal Request</h5>
        <div class="table-responsive">
            <table class="table table-striped">

                <tr class="bg-light">
                    <th>ID</th>
                    <th>Time</th>
                    <th>Shop</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                @foreach ($withdraws as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->created_at }}</td>
                        <td>{{ $request->shop->name }}</td>
                        <td>{{ $currency->symbol . $request->amount * $currency->rate  }}</td>
                        <td>
                            @if ($request->status == 'pending')
                                <span class="badge bg-orange">
                                    {{ $request->status }}
                                </span>
                            @elseif($request->status == 'declined')
                                <span class="badge bg-danger text-white">
                                    {{ $request->status }}
                                </span>
                            @else
                                <span class="badge bg-success text-white">
                                    {{ $request->status }}
                                </span>
                            @endif
                        </td>
                        <td> 
                            <div class="btn-group dropdown">
                                <a href="{{ route('withdraw.view',$request->id) }}" class="btn btn-primary"><i class="fas fa-eye fa-lg  "></i> Pay Manually</a>
                                <button id="my-dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle dropdown</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="my-dropdown">
                                    <a class="dropdown-item" href="{{ route('withdraw.approve',$request->id) }}"><i class="fas fa-check-circle fa-lg"></i> Approve</a>
                                    <a class="dropdown-item" href="{{ route('withdraw.decline',$request->id) }}"><i class="fas fa-times-circle fa-lg"></i> Declined</a>
                                    <a class="dropdown-item" href="{{ route('withdraw.delete',$request->id) }}"><i class="fas fa-trash fa-lg fa-fw"></i> Delete</a>
                                </div>
                            </div> 
                        </td>
                    </tr>
                @endforeach
                
                <tr class="bg-light">
                    <th>ID</th>
                    <th>Time</th>
                    <th>Shop</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                    


            </table>
        </div>
    </div>
</div>

@endsection
