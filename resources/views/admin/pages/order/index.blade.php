@extends('admin/layout.tmpl')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>All Orders</h4>
            <div class="card-header-form">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form action="{{ route('admin.multiaction') }}">

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th class="text-center">
                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                        class="custom-control-input" id="checkbox-all">
                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                </div>
                            </th>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Order Status</th>
                            <th>Order total</th>
                            <th>Payment status</th>
                            <th>Action</th>
                        </tr>

                        @forelse ($orders as $order)

                        <tr>
                            <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                        id="checkbox-{{ $order->id }}" value="{{ $order->id }}" name="selected[]">
                                    <label for="checkbox-{{ $order->id }}" class="custom-control-label">&nbsp;</label>
                                </div>
                            </td>

                            <td>
                                {{ $order->order_number }}
                                {{-- <img alt="image" src="{{ asset('dashboard_asset/assets/img/users/user-5.png') }}"
                                    class="rounded-circle" width="35" data-toggle="tooltip"
                                    title="Wildan Ahdian"> --}}
                            </td>

                            <td>{{ $order->user->name }}</td>

                            {{-- <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                    <div class="progress-bar bg-success" data-width="100"></div>
                                </div>
                            </td> --}}

                                
                            <td>
                                @if ($order->status == 'pending')
                                    <div class="badge bg-light">Pending</div>                            
                                @elseif ($order->status == 'processing')
                                    <div class="badge bg-orange">processing</div>
                                @elseif ($order->status == 'completed')
                                    <div class="badge bg-green">completed</div>
                                @elseif ($order->status == 'delivered')
                                    <div class="badge bg-green">Delivered</div>
                                @elseif($order->status == 'declined')
                                    <div class="badge bg-danger">Declined</div>
                                @else
                                    <div class="badge bg-orange">{{ $order->status }}</div>
                                @endif
                            </td>

                            <td>{{$currency->symbol. $order->grand_total * $currency->rate}}</td>
                            <td>
                                @if ($order->is_paid == '1')
                                    <div class="badge bg-green">Paid</div>
                                @elseif ($order->status == 'refund')
                                <div class="badge bg-success">Refunded</div>

                                @else
                                    <div class="badge bg-orange">Unpaid</div>
                                @endif
                            </td>
                            
                            <td>
                                <div class="dropdown d-inline">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Manage Order
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="{{ route('admin.order.view', $order->id) }}"><i class="far fa-eye"></i> View</a>
                                    <a class="dropdown-item has-icon" href="{{ route('admin.order.delete', $order->id) }}"><i class="fas fa-trash    "></i> Deleet</a>
                                    {{-- <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a> --}}
                                </div>
                                </div>
                                
                                {{-- <a href="#" class="btn btn-link">View</a> --}}
                            
                            </td>
                        </tr>
                        @empty
                            No order found
                        @endforelse
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <div class="row d-flex">
                {{-- footer left elenemt --}}
                    <div class="flex-grow-1">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <div class="form-group row p-2">
                                    {{-- <label for="my-select">Text</label> --}}
                                    <select id="my-select" class="form-control col-8" name="action">
                                        <option value="pending">Set as Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="completed">Completed</option>
                                        <option value="declined">Declined</option>
                                        <option value="ready-to-ship">Ready To Ship</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="delete">Delete Selected</option>
                                    </select>
                                    <button type="submit" class="btn btn link-light col-4">Submit</button>
                                </div>
                            </ul>
                        </nav>
                    </div> 
                    
                    {{-- footer right elenemt --}}
                    <div class="text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item">
                                    {{ $orders->render() }}
                                </li>
                            </ul>
                        </nav>
                    </div> 
                </div>
            </div>
            
        </form>
        
    </div>
</div>

@endsection