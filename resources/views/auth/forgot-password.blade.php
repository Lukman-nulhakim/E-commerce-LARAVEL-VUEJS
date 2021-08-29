@extends('layouts.auth', ['title' => 'login'])

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
                            <h1 class="h5 text-gray-900 mb-3">RESET PASSWORD</h1>
                        </div>

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan email">
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">SEND PASSWORD RESET LINK</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection