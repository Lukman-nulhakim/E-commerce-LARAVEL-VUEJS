@extends('layouts.auth', ['title' => 'Update Password'])

@section('content')
    <div class="continer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card o-hidden border-0 shaddow-lg mt-5">
                    <div class="card-body p-4">
                        @if (Session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ Session('status') }}
                            </div>
                        @endif

                        <div class="text-center">
                            <h1 class="h5 text-gray-900 mb-3">UPDATE PASSWORD</h1>
                        </div>

                        <form action="{{ url('/reset-password') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan email">
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan password">
                                @error('password')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru" autocomplete="new-password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">UPDATE PASSWORD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection