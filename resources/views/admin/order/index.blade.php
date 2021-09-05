@extends('layouts.app', ['title' => 'Orders'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-cart"></i> ORDERS</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.order.index') }}" method="GET">
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
                                        <th scope="col">No.INVOICE</th>
                                        <th scope="col">NAMA LENGKAP</th>
                                        <th scope="col">GRAND TOTAL</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoices as $no => $invoice)
                                        <tr>
                                            <th scope="row">
                                                {{ ++$no + ($invoices->currentPage()-1) * $invoices->perPage() }}
                                            </th>
                                            <td>{{ $invoice->invoice }}</td>
                                            <td>{{ $invoice->name }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>{{ moneyFormat($invoice->grand_total) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.order.show', $invoice->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-list-ul"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">Data Belum Tersedia !</div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $invoices->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--container fluid-->
@endsection