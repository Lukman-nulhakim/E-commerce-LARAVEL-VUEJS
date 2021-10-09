@extends('layouts.app', ['title' => 'Users'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-user-circle"></i> USERS</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.user.index') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm pt-2"><i class="fa fa-plus-circle"></i> Tambah</a>
                                    </div>
                                    <input type="text" name="q" class="form-control" placeholder="cari berdasarkan nama kategori">
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
                                        <th scope="col">No.</th>
                                        <th scope="col">NAMA USER</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $no => $user)
                                        <tr>
                                            <th scope="row">
                                                {{ ++$no + ($users->currentPage()-1) * $users->perPage() }}
                                            </th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <button onclick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $user->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">Data Belum Tersedia !</div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $users->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--container fluid-->

    <script>
        // ajax delete
        function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function (isConfirm){
                if (isConfirm) {
                    
                    // ajax delete
                    $.ajax({
                        url: "{{ route('admin.user.index') }}/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',

                        success: function (response)
                        {
                            if (response.status == "success")
                            {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function (){
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'GAGAL',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function (){
                                    location.reload();
                                });
                            }
                        }
                    });
                } else {
                    return true
                }
            })
        }
    </script>
@endsection