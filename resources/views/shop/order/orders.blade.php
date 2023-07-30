@extends('shop.layouts.app')
@section('content')
<div class="col-12">
    <form action="{{ route('vendor.multi-status') }}">
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
                            <th>My Order Status</th>
                            <th>Order total</th>
                            {{-- <th>Payment status</th> --}}
                            <th></th>
                        </tr>

                        @forelse ($orders as $suborder)

                        <tr>
                            <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" name="selected[]" value="{{ $suborder->id }}" class="custom-control-input"
                                        id="checkbox-{{ $suborder->id }}">
                                    <label for="checkbox-{{ $suborder->id }}" class="custom-control-label">&nbsp;</label>
                                </div>
                            </td>

                            <td>
                                {{ $suborder->order->order_number }}
                                {{-- <img alt="image" src="{{ asset('dashboard_asset/assets/img/users/user-5.png') }}"
                                    class="rounded-circle" width="35" data-toggle="tooltip"
                                    title="Wildan Ahdian"> --}}
                            </td>

                            <td>{{ $suborder->order->user->name }}</td>

                            {{-- <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                    <div class="progress-bar bg-success" data-width="100"></div>
                                </div>
                            </td> 

                                --}}
                                <td>
                                @if ($suborder->status == 'pending')
                                    <div class="badge bg-light">Pending</div>                            
                                @elseif ($suborder->status == 'processing')
                                    <div class="badge bg-light">Processing</div>
                                @elseif ($suborder->status == 'shipped')
                                    <div class="badge bg-orange">On transit to fulfillment center</div>
                                @elseif ($suborder->status == 'delivered')
                                    <div class="badge bg-green">Delivered to fulfillment center</div>
                                @elseif ($suborder->status == 'received')
                                    <div class="badge bg-green">Received at fulfillment center</div>
                                @elseif ($suborder->status == 'inspection')
                                    <div class="badge bg-orange">Under Inspection</div>
                                @elseif ($suborder->status == 'failed-inspection')
                                    <div class="badge bg-danger">Failed Inspection</div>
                                @elseif ($suborder->status == 'declined')
                                    <div class="badge bg-danger">Declined</div>
                                @else
                                    <div class="badge bg-success">Completed</div>
                                @endif
                                </td>

                            <td>${{ $suborder->grand_total }}</td>
                            {{-- <td>
                                @if ($suborder->order->is_paid == '1')
                                    <div class="badge bg-green">Paid</div>
                                @else
                                    <div class="badge bg-orange">Unpaid</div>
                                @endif
                            </td> --}}
                            
                            <td>
                                <div class="dropdown d-inline">
                                    <a class="dropdown-item has-icon" href="{{ route('vendor.order.view', $suborder->id) }}"><i class="far fa-eye"></i> View details</a>

                                {{-- <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    With Icon
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="{{ route('shop.order.delete', $suborder->id) }}"><i class="far fa-trash"></i> Deleet</a>
                                    <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                                    <a href="#" class="btn btn-link">View</a>
                                </div> --}}
                                </div>
                                
                            
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
                                <div class="form-group">
                                    {{-- <label for="my-select">Text</label> --}}
                                    <select id="my-select" class="form-control" name="status">
                                        <option value="completed">Mark Completed</option>
                                        <option value="processing">Set to Processing</option>
                                        <option value="declined">Mark Declined</option>
                                    </select>
                                    <button type="submit" class="btn btn link-light">Submit</button>
                                </div>
                            </ul>
                        </nav>
                    </div> 
                    
                    {{-- footer right elenemt --}}
                    <div class="text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span
                                    class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div> 
                </div>
            </div>
        </div>
    </form>
   
</div>
   
@endsection