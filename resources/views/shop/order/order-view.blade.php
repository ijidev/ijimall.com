@extends('shop.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="card">
                <div class="d-flex font-bold m-2">
                    <span class="flex-grow-1">Order Number <span class=" text-info ">#{{ $order->order->order_number }}</span> </span>
                    <span class="badge badge-dark has-icon"><i class="far fa-comments"></i> Massage customer</span>
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
                                <th>QTY</th>
                                <th>Price</th>
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
                                    x{{ $item->pivot->quantity }}
                                </td>

                                <td>
                                    {{ $currency->symbol . number_format($item->price * $currency->rate ,2) }}
                                </td>

                                <td class="text-center">
                                    {{ $currency->symbol . number_format($total * $currency->rate ,2) }}
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
                        <div class="p-2">{{ $currency->symbol . number_format( $order->grand_total * $currency->rate, 2) }}</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Costomer And Order Details</h5>
                    <div class="card-text font-bold">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Full Name:</div>
                            <div class="p-2">{{ $order->order->user->name }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Phone Number:</div>
                            <div class="p-2">{{ $order->order->billing_phone }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Email:</div>
                            <div class="p-2">{{ $order->order->user->email }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Payment Methold</div>
                            <div class="p-2">{{ $order->order->payment_methold }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Order Note</div>
                            @if ($order->order->note == null)
                                <div class="p-2">N/A</div>
                            @else
                                <div class="p-2">{{ $order->order->note }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vendor Details</h5>
                    <div class="card-text font-bold">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Shop:</div>
                            <div class="p-2">{{ $order->order->payment_methold }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Vendor:</div>
                            <div class="p-2">{{ $order->order->user->name }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Phone Number:</div>
                            <div class="p-2">{{ $order->order->billing_phone }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Email:</div>
                            <div class="p-2">{{ $order->order->user->email }}</div>
                        </div>
                        
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="col-md-4">
            <div class="card">
                <form action="{{ route('vendor.order.update', $order->id) }}">
                    <div class="card-body">
                        <div class="d-flex">
                            <h6 class="flex-grow-1">Update Order</h6>
                            {{-- <span class="badge bg-orange"> {{ $order->status }} </span> --}}
                        </div>
                        <div class="card-text">
                            <div class="d-flex">
                                <div class="p flex-grow-1">Order Status:</div>
                                @if ($order->status == 'pending')
                                <select class="p btn bg-orange border-0 " name="status">
                                    <option class="badge badge-primary" name="status" value="{{ $order->status }}">{{ $order->status }}</option>
                                    <option name="status" value="processing">Processing</option>
                                    {{-- <option name="status" value="shipped">shipped Out</option> --}}
                                    <option name="status" value="declined">Declined</option>
                                </select>
                                @elseif ($order->status == 'processing')
                                <select class="p btn bg-orange border-0 " name="status">
                                    <option class="badge badge-primary" name="status" value="processing">Processing</option>                                    <option name="status" value="shipped">shipped</option>
                                    <option name="status" value="declined">Declined</option>
                                    {{-- <option name="status" value="shipped">Shipped out</option> --}}
                                </select>
                                @elseif ($order->status == 'shipped')
                                <select class="p btn bg-orange border-0 " name="status">
                                    <option class="badge badge-primary" name="status" value="shipped">Shipped Out</option>                                    <option name="status" value="shipped">shipped</option>
                                    <option name="status" value="delivered">Delivered</option>
                                    {{-- <option name="status" value="shipped">Shipped out</option> --}}
                                </select>
                                @elseif ($order->status == 'declined')
                                <select class="p btn bg-orange border-0 " name="status">
                                    <option class="badge badge-primary" name="status" value="{{ $order->status }}">{{ $order->status }}</option>
                                    <option name="status" value="processing">Processing</option>
                                    {{-- <option name="status" value="shipped">shipped Out</option> --}}
                                </select>
                                @else
                                <select disabled class="p btn bg-orange border-0 " name="status">
                                    <option class="badge badge-primary" name="status" value="{{ $order->status }}">{{ $order->status }}</option>
                                    {{-- <option class="badge badge-green" name="status" value="completed">Delivered</option> --}}
                                    
                                </select>
                                @endif
                            </div>
                            <div class="d-flex">
                                
                                
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
                        {{-- <div class="d-flex">
                            <div class="p-2 flex-grow-1">Payment Methold:</div>
                            <div class="p-2">{{ $order->payment_methold }}</div>
                        </div> --}}
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Payment Status:</div>
                            @if ( $order->order->is_paid == true)
                                <div class="badge badge-success m-1">Paid</div>
                            @else
                                <div class="badge bg-danger text-white m-1">Unpaid</div>
                            @endif
                            
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">Status:</div>
                            @if ($order->status == 'pending')
                            <div class="badge bg-light">Pending</div>                            
                            @elseif ($order->status == 'processing')
                                <div class="badge bg-secondary">Processing</div>
                            @elseif ($order->status == 'shipped')
                                <div class="badge bg-orange">On transit to fulfillment center</div>
                            @elseif ($order->status == 'delivered')
                                <div class="badge bg-warning">Delivered to fulfillment center</div>
                            @elseif ($order->status == 'received')
                                <div class="badge bg-green">Received at fulfillment center</div>
                            @elseif ($order->status == 'inspection')
                                <div class="badge bg-orange">Under Inspection</div>
                            @elseif ($order->status == 'failed-inspection')
                                <div class="badge bg-danger">Failed Inspection</div>
                            @elseif ($order->status == 'declined')
                                <div class="badge bg-danger">Declined</div>
                            @else
                                <div class="badge bg-success">Completed</div>
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