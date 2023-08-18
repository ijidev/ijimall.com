@extends('admin/layout.tmpl')
@section('content')
   <div class="row">
      <div class="card col-md-6 m-1">
         
         <div class="card-header">
            <h6>User information</h6>
         </div>

         <span class="align-center">
            <img alt="image" src="{{ asset('/assets/products/product-1.png') }}"
            class="rounded-circle" width="100" height="100" data-toggle="tooltip"
            title="{{ $user->name }}">
         </span>

         <div class="card-body">
      
            <span class="d-flex">
               <div class="flex-grow-1 ">
                  Full Name:
               </div>
               <span>
                  {{ $user->name }}
               </span>
            </span>
            
            <span class="d-flex">
               <div class="flex-grow-1 text-bold-12">
                  Email Address:
               </div>
               <span>
                  {{ $user->email }}
               </span>
            </span>
            
            <span class="d-flex">
               <div class="flex-grow-1 text-bold-12">
                  User Currency:
               </div>
               <span>
                  {{ $user->currency->name }}
               </span>
            </span>

            <span class="d-flex">
               <div class="flex-grow-1 text-bold-12">
                  User Balance:
               </div>
               <span>
                  {{ $currency->symbol .  number_format($user->wallet->active_bal * $currency->rate, 2) }}
               </span>
            </span>

            <span class="d-flex">
               <div class="flex-grow-1 text-bold-12">
                  Balance On Hold:
               </div>
               <span class="badge bg-danger text-light">
                  {{ $currency->symbol .  number_format($user->wallet->hold_bal * $currency->rate, 2) }}
               </span>
            </span>
         </div>
      </div>

      <div class="card col-md m-1">
         <div class="card-header">
           <h6>Manage User Funds</h6> 
         </div>

         <div class="card-body">
            <form action="{{ route('admin.fund.user', $user->id) }}">
               <div class="form-group">
                  <div class="input-group">

                    <select class="custom-select" name="fund" id="inputGroupSelect05">
                      <option value="debit">Debit User</option>
                      <option value="credit">Credit user</option>
                      @if ($user->wallet->hold_bal >= 0.1)
                        <option value="to-active">Move to Balance</option>
                      @endif
                      @if ($user->wallet->active_bal >= 0.1)
                        <option value="to-hold">Move to Hold</option>
                      @endif
                      
                    </select>

                    <input type="number" name="amount" class="form-control">
                    <div class="input-group-append">
                      <button class="btn btn-light" type="submit">fund</button>
                    </div>
                  </div>
   
                  <div class="form-group">
                     <label for="my-textarea">Massage</label>
                     <textarea id="my-textarea" class="form-control" name="massage" rows="3"></textarea>
                  </div>

                  {{-- @if ($user->wallet->active_bal >= 0.1)
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="check" value="to-hold" id="hold">
                    <label class="form-check-label" for="hold">
                      Hold User Balance
                    </label>
                  </div>
                  @endif

                  @if ($user->wallet->hold_bal >= 0.1)
                     <div class="form-check">
                        <input class="form-check-input" name="check" type="radio" value="to-active" id="active">
                        <label class="form-check-label" for="active">
                           UnHold User Balance
                        </label>
                     </div>
                  @endif 
                  <button type="submit">Submit</button>--}}
                  
               </div>
            </form>
         </div>
      </div>
   </div>

   <div class="card">
      <div class="card-header">
         User Transaction History
      </div>

      <div class="card-body">
         {{-- <h5 class="card-title">Title</h5> --}}
         
         <table class="table table-light table-responsive-sm">
           
            <thead class="thead-light">
               <tr>
                  <th>Refrence ID</th>
                  <th>Amount</th>
                  <th>Transaction Type</th>
                  <th>Status</th>
                  <th>OrderID</th>
                  <th>Time</th>
               </tr>
            </thead>

            <tbody>
               @foreach ($transactions as $trans)
                  <tr>
                     <td>{{ $trans->trans_ref }}</td>
                     <td>{{ $currency->symbol .  number_format($trans->amount * $currency->rate, 2) }}</td>
                     <td>{{ $trans->type }}</td>
                     <td>{{ $trans->status }}</td>
                     <td> 
                        <a href="{{ route('admin.find.order', $trans->order_id) }}">{{ $trans->order->order_number }}</a> </td>
                     <td>{{ $trans->updated_at }}</td>
                  </tr>
               @endforeach
            </tbody>

            <tfoot>
               <tr>
                  {{-- <th>#</th> --}}
               </tr>
            </tfoot>

         </table>
      </div>
   </div>
@endsection