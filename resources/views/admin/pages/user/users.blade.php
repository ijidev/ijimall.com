@extends('admin/layout.tmpl')
@section('content')
<div class="card">
    <span class="row pl-4">
        <a href="{{ route('admin.user.add') }}" class="btn btn-primary">Create New</a>
        <a href="{{ route('admin.users') }}" class="btn btn-link">All</a>
        <a href="{{ route('admin.users.vendor') }}" class="btn btn-link">Vendors</a>
        <a href="{{ route('admin.users.customer') }}" class="btn btn-link">Customers</a>
        {{-- <a href="{{ route('admin.user.draft') }}" class="btn btn-link">Draft</a> --}}
    </span>
    
</div>
            
<div class="card">
    <div class="card-header">
        <h4>{{ $tableName. ' table' }}</h4>
        <div class="card-header-form">
            

            <form action="{{ route('admin.email.search') }}">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search users by email">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <form action="{{ route('admin.user.search') }}">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search users by name">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form action="{{ route('admin.user.action') }}">

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr class=" bg-primary text-light">
                        <th class="text-center">
                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                    class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                            </div>
                        </th>
                        <th>image</th>
                        <th>user</th>
                        <th>user E-mail</th>
                        <th>User Type</th>
                        <th>Wallet</th>
                        <th>Manage</th>
                        {{-- <th>Parent</th> --}}
                        
                    </tr>
                    @forelse ($users as $user)
                    
                    <tr>
                        <td class="p-0 text-center">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" value="{{ $user->id }}" class="custom-control-input"
                                    id="checkbox-{{ $user->id }}" name="selected[]">
                                <label for="checkbox-{{ $user->id }}" class="custom-control-label">&nbsp;</label>
                            </div>


                            </div>
                        </td>

                        <td>
                            <img alt="image" src="{{ asset('dashboard_asset/assets/img/products/product-1.png') }}"
                                class="rounded-circle" width="35" data-toggle="tooltip"
                                title="{{ $user->name }}">
                        </td>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            @foreach ($user->role as $role)
                                {{ $role->name }}
                            @endforeach
                        </td>

                        <td>
                            <span class="badge bg-orange">{{$currency->symbol . number_format($user->wallet->active_bal * $currency->rate , 2) }}</span>
                        </td>

                        <td>
                            <div class="btn-group dropdown">
                                <a href="{{ route('admin.edit.user', $user->id) }}" class="btn btn-primary"><i class="fas fa-edit "></i>Edit</a>
                                <button id="my-dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle dropdown</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="my-dropdown">
                                    <a href="{{ route('admin.manage.user', $user->id) }}" class="btn btn-link"><i class="fas fa-edit "></i>Manage</a>
                                    <a href="{{ route('admin.trash.user',  $user->id) }}" class="btn btn-link"> <i class="fas fa-trash "></i> Trash</a>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td>

                        </td>

                        <td>

                        </td>

                        <td>
                            <h6>
                                {{'No ' . $tableName . ' Found' }}
                            </h6>
                        </td>
                            
                        
                    </tr>
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
                                    {{-- <option value="pending">set as Pending</option>
                                    <option value="draft">set to draft</option>
                                    <option value="trash">Move to trash</option> --}}
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

    </form>
</div>
@endsection
        