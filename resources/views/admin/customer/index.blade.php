@extends('layouts.app', ['title' => 'Customers'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i> CUSTOMERS</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.customer.index') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="q" class="form-control" placeholder="cari berdasarkan nama order">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">NO.</th>
                                        <th scope="col">NAMA CUSTOMER</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">BERGABUNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $no => $customer)
                                        <tr>
                                            <th scope="row">
                                                {{ ++$no + ($customers->currentPage()-1) * $customers->perPage() }}
                                            </th>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ dateID($customer->create_at) }}</td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">Data Belum Tersedia !</div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $customers->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--container fluid-->
@endsection