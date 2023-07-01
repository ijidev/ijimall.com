@extends('admin/layout.tmpl')
@section('content')
    <form action="{{ route('admin.store.user') }}">
        <div class="card p-2">
            <div class="">
                <div class="mb-3">
                    <label for="email" class="form-lable">Full Name</label>
                    <input type="text"
                        class="form-control" name="name" id="" aria-describedby="helpId" placeholder="User Full Name">
                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                </div>
                <div class="row">
                    <div class="mb-3 col-sm-6">
                        <label for="email" class="form-lable">Email Address</label>
                        <input type="email"
                            class="form-control" name="email" id="" aria-describedby="helpId" placeholder="User Email Address">
                        {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                    </div>
    
                    <div class="mb-3 col-sm-6">
                        <div class="mb-3">
                          <label for="" class="form-label">Password</label>
                          <input type="password"
                            class="form-control" name="password" id="" aria-describedby="helpId" placeholder="">
                          {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                        </div>
                    </div>

                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control form-control-sm" name="role" id="">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->display_name }}</option>   
                        @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
            

    </form>
@endsection