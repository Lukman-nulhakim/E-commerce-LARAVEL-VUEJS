@extends('layouts.app', ['title' => 'Edit User'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-user-circle"></i> EDIT USER</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>NAMA LENGKAP</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama">
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>ALAMAT EMAIL</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukan Email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>PASSWORD</label>
                                        <input type="password" name="password" value="{{ old('password') }}" placeholder="Masukan Password" class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>KONFIRMASI PASSWORD</label>
                                        <input type="password" name="password_confirmation" placeholder="Masukan Konfirmasi Password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-sm btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                            <button class="btn btn-sm btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection