@extends('admin/layout.tmpl')
@section('content')

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Curency</h5>
        <form action="{{ route('admin.currency.update', $curr->id) }}">
            <div class="form-group">
              <label for="currency">Currency</label>
              <input type="text" class="form-control" name="name" value="{{ $curr->name }}" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
              <label for="symbol">Symbol</label>
              <input type="text" class="form-control" name="symbol" value="{{ $curr->symbol }}" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
              <label for="rate">Rate</label>
              <input type="text" class="form-control" name="rate" value="{{ $curr->rate }}" aria-describedby="helpId" placeholder="">
            </div>
            <div class="row">
                <div class="form-check col-6">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="base" id="" value="on">
                    Set As Base Currency
                    </label>
                </div>

                <div class="col-5">
                    <button type="submit">Submit</button>
                </div>
            </div>
            

        </form>
    </div>
</div>

@endsection