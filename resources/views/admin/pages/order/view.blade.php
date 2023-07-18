@extends('admin/layout.tmpl')
@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="card">
                <div class="d-flex font-bold m-2">
                    <span class="flex-grow-1">Order Number <span class=" text-info ">#{{ $order->order_number }}</span> </span>
                    <span class="badge badge-dark has-icon"><i class="far fa-comments"></i> Massage customer</span>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Sub Order
                    </h5>
                    <table class="table ">
                        <thead>
                            <tr class=font-bold>
                                <th>Vendor</th>
                                <th>Amount</th>
                                <th>Satatus</th>
                                <th></th>
                            </tr>
                        </thead>
                        
                        
                        <tbody>
                            {{-- {{ dd($order->subOrder) }} --}}
                            @foreach ($order->subOrder as $suborder)
                            

                              <tr>
                                <td class="align-left">
                                    {{ $suborder->vendor->shop->name }}
                                </td>
                                
                                <td>
                                    {{ $currency->symbol . $suborder->grand_total * $currency->rate}}
                                </td>
                            
                                <td>
                                    {{ $suborder->status }}
                                </td>

                                <td>
                                    <a class="dropdown-item has-icon" href="{{ route('admin.suborder.view', $suborder->id) }}">
                                    <i class="fas fa-edit"></i> manage</a>
                                </td>

                                
                                
                            </tr>  
                            
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Items Summary
                    </h5>
                    <table class="table font-bold">
                        <thead>
                            <tr>
                                <th> </th>
                                <th> </th>
                                <th>Price</th>
                                <th>QTY</th>
                                <th>Price Total</th>
                            </tr>
                        </thead>
                        
                        
                        <tbody>
                            @foreach ($order->items as $item)
                            {{-- {{ dd($item) }} --}}
                            @php
                                $total = $item->price * $item->pivot->quantity 
                            @endphp

                              <tr>
                                <td class="align-left">
                                    <img alt="product image" src="{{ asset('dashboard_asset/assets/img/products/product-1.png') }}"
                                    class="rounded-circle" width="40" data-toggle="tooltip"
                                    title="Wildan Ahdian">
                                </td>
                                
                                <td>
                                    {{ $item->name }}
                                </td>
                                
                                <td>
                                    {{$currency->symbol . $item->price * $currency->rate }}
                                </td>

                                <td>
                                    x{{ $item->pivot->quantity }}
                                </td>

                                <td class="text-center">
                                    {{$currency->symbol . $total * $currency->rate }}
                                </td>
                                
                            </tr>  
                            
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
     
            <div class="card">
                <div class="card-text font-bold">
                    <div class="d-flex">
                        <div class="p-2 flex-grow-1">Total</div>
                        <div class="p-2">{{$currency->symbol. $order->grand_total * $currency->rate}}</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Costomer And Order Details</h5>
                    <div class="card-text font-bold">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Full Name:</div>
                            <div class="p-2">{{ $order->user->name }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Phone Number:</div>
                            <div class="p-2">{{ $order->billing_phone }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Email:</div>
                            <div class="p-2">{{ $order->user->email }}</div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Order Note</div>
                            @if ($order->note == null)
                                <div class="p-2">N/A</div>
                            @else
                                <div class="p-2">{{ $order->note }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vendor Details</h5>
                    @foreach ($order->subOrder as $suborder)
                    <div class="card-text font-bold">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Shop:</div>
                            <div class="p-2">{{ $suborder->vendor->shop->name }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Vendor:</div>
                            <div class="p-2">{{ $suborder->vendor->name }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Phone Number:</div>
                            <div class="p-2">{{ $suborder->vendor->phone }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Email:</div>
                            <div class="p-2">{{ $suborder->vendor->email }}</div>
                        </div>
                        <hr>
                    </div>
                        
                    @endforeach
                </div>
            </div> --}}
        </div>

        <div class="col-md-4">

            <div class="card">
                <form action="{{ route('admin.order.update', $order->id) }}">
                    <div class="card-body">
                        <div class="d-flex">
                            <h6 class="flex-grow-1">Update Order</h6>
                            {{-- <span class="badge bg-orange"> {{ $order->status }} </span> --}}
                        </div>
                        <div class="card-text">
                            <div class="d-flex">
                                <div class="p-2 flex-grow-1">Status:</div>
                                <select class="p-2 btn bg-orange text-white border-0 " name="status">
                                    <option class="text-white" name="status" value="{{ $order->status }}">{{'('. $order->status .')'}}</option>
                                    <option class="text-white" name="status" value="pending">Pending</option>
                                    <option class="text-white" name="status" value="processing">Processing</option>
                                    <option class="text-white" name="status" value="ready-to-ship">Ready To Ship</option>
                                    <option class="text-white" name="status" value="shipped">Shipped</option>
                                    <option class="text-white" name="status" value="delivered">Delivered</option>
                                    <option class="text-white" name="status" value="completed">Completed</option>
                                    <option class="text-white" name="status" value="declined">Declined</option>
                                </select>
                            </div>
                                <div>
                                    <input type="text" name="taracking_no" id="" placeholder="Tracking ID" class="form-control m-2 m-l-10">
                                </div>
                                
                            
                        </div>
                        <button type="submit" class="btn btn-light">Update</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h6 class="flex-grow-1">Order Summary</h6>
                        {{-- <span class="badge bg-orange"> {{ $order->status }} </span> --}}
                    </div>
                    <div class="card-text">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Gatway:</div>
                            <div class="p-2">{{ $order->payment_methold }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Payment:</div>
                            @if ( $order->is_paid == true)
                                <div class="badge badge-success m-1">Paid</div>
                            @else
                                <div class="badge bg-danger text-white m-1">Pending</div>
                            @endif
                            
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Status:</div>
                            @if ($order->status == 'pending')
                                <div class="badge bg-light">Pending</div>                            
                            @elseif ($order->status == 'processing')
                                <div class="badge bg-orange">Processing</div>
                            @elseif ($order->status == 'completed')
                                <div class="badge bg-green">completed</div>
                            @elseif ($order->status == 'delivered')
                                <div class="badge bg-green">Delivered</div>
                            @elseif($order->status == 'declined')
                                <div class="badge bg-danger">Declined</div>
                            @else
                                <div class="badge bg-orange">{{ $order->status }}</div>
                            @endif
                            
                        </div>
                        {{-- <div class="d-flex">
                            <div class="p-2 flex-grow-1">Flex item</div>
                            <div class="p-2">Flex item</div>
                        </div> --}}
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Delivery Details</h5>
                    <div class="card-text">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1 font-bold">State:</div> 
                            <div class="p-2">{{ $order->shipping_state }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1 font-bold">City:</div>
                            <div class="p-2">{{ $order->shipping_city }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1 font-bold">Country:</div>
                            <div class="p-2">{{ $order->shipping_country }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1 font-bold">Zipcode:</div>
                            <div class="p-2">{{ $order->shipping_zipcode }}</div>
                        </div>
                        <div class="text-center">
                            <div class="p-2 font-bold">Full Address:</div>
                            <div class="p-2">{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_state }}, {{ $order->shipping_country }}, {{ $order->shipping_zipcode }}</div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection