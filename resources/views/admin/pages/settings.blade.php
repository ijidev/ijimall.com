@extends('admin/layout.tmpl')
@section('content')

<div class="card">
    <div class="card-header">
        Admin commission
    </div>
    <div class="card-body">
        <div class="">
            <form action="{{ route('admin.setting.update') }}">
                <div class="form-group">
                    <label for="Value">Value</label>
                    <input id="Value" class="form-control" value="{{ $commission->value }}" type="number" name="value">
                </div>


                
                <div class="form-group">
                    <label for="type">Commission Type</label>
                    <select id="type" class="form-control" name="type">
                        @if ($commission->type == '%')
                            <option selected value="%">Percentage</option>
                            <option value="">Fixed</option>
                        @else
                            <option value="%">Percentage</option>
                            <option selected value="">Fixed</option>
                        @endif
                        
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>
    <div class="card-footer">
        Footer
    </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Curency</h3>
        <table class="table table-light">
            <tbody>
                <tr>
                    <td>Currency</td>
                    <td>Symbol</td>
                    <td>rate</td>
                    <td>Action</td>
                </tr>
            </tbody>
            <tfoot>
                @foreach ($currencies as $currency)
                    <tr>
                       <th>{{ $currency->name }}</th>
                        <th>{{ $currency->symbol }}</th>
                        <th>{{ $currency->rate }}</th> 
                        <th> <a class="btn btn-light" href="{{ route('admin.currency.edit', $currency->id ) }}"><i class="fas fa-edit"></i></a> </th> 
                        <th> <a class="btn btn-light" href="{{ route('admin.currency.delete',  $currency->id) }}"> <i class="fas fa-trash"></i></a> </th> 
                    </tr>
                @endforeach
                    

                <tr>
                    <form action="{{ route('admin.currency.add') }}">
                        <td>
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted">Currency Name</small>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" class="form-control" name="symbol" id="" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted">Currency Symbol</small>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for=""></label>
                                <input type="number" class="form-control" name="rate" id="" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted">Exchange rate</small>
                            </div>
                        </td>

                        <td class="text-center"><button class="btn btn-primary" type="submit">Submit</button></td>
                    </form>
                </tr>
                
            </tfoot>
        </table>
      </div>
    </div>
  </div>
  
</div>

@endsection