@extends('admin.layout.tmpl')
@section('title')
    vendor shops
@endsection

@section('content')


<div class="col-12">
<div class="card">
    <div class="card-header">
        <h4>All Shops</h4>
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
                    <th>Shop Name</th>
                    <th>Ownner</th>
                    <th>Order Status</th>
                    {{-- <th>Order total</th>
                    <th>Payment status</th> --}}
                    <th>Action</th>
                </tr>

            @forelse ($shops as $shop)

                <tr>
                    <td class="p-0 text-center">
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                id="checkbox-1">
                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                        </div>
                    </td>

                    <td>
                        {{ $shop->name }}
                        {{-- <img alt="image" src="{{ asset('dashboard_asset/assets/img/users/user-5.png') }}"
                            class="rounded-circle" width="35" data-toggle="tooltip"
                            title="Wildan Ahdian"> --}}
                    </td>

                    <td>{{ $shop->vendor->name }}</td>

                    {{-- <td class="align-middle">
                        <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                            <div class="progress-bar bg-success" data-width="100"></div>
                        </div>
                    </td> 

                        --}}
                    <td>
                        @if ($shop->is_active == true)
                            <div class="badge bg-orange">Active</div>                            
                        @elseif ($shop->is_active == false)
                            <div class="badge bg-danger text-white">Inactive</div>
                        @endif
                    </td>

                    <td>
                        <div class="dropdown d-inline">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item has-icon" href="{{ route('admin.shop.view', $shop->id) }}"><i class="far fa-eye"></i> View</a>
                            <a class="dropdown-item has-icon" href="{{ route('admin.shop.delete', $shop->id) }}"><i class="far fa-trash"></i> Deleet</a>
                            {{-- <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a> --}}
                        </div>
                        </div>
                    </td>
                                            
                </tr>

                @empty
                <tr>
                    <td></td>
                    <td>
                        <h4>No Shop found</h4>
                    </td>
                </tr>
                        
                            
            @endforelse
            </table>
        </div>
    </div>
    <div class="card-footer text-right">
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
   
@endsection