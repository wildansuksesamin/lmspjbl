@extends('layouts.appregister')

@section('content')
<link rel="shortcut icon" href="{{ asset('images') }}/logoku.webp"/>
<div id="background-container" style="min-height: 100vh;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;">
    <div class="card shadow-lg border-0 rounded-3" style="background: rgba(0, 0, 0, 0.7); color: white; width: 100%; max-width: 400px;">
        <div class="card-header text-center py-4">
            <h3 class="mb-0">{{ __('Register') }}</h3>
        </div>

        <div class="card-body p-4">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('registers.storeRegister') }}" enctype="multipart/form-data">
                @csrf

                <!-- Input nama -->
                <div class="mb-4">
                    <label id="username" type="text" class="form-label">{{ __('Nama') }}</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

                <!-- Input email -->
                <div class="mb-4 position-relative">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <!-- Input Gender -->
                <div class="mb-4 position-relative">
                    <label for="gender" class="form-label">{{ __('Gender') }}</label>
                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">Pilih Gender</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <!-- Input kelas -->
                <div class="mb-4 position-relative">
                    <label for="kelas_id" class="form-label">{{ __('Kelas') }}</label>
                    <select name="kelas_id" id="kelas_id" class="form-control" required>
                    <option value="">Pilih Kelas</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                        @endforeach
                                </select>

                                @error('kelas_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

               <!-- Input password -->
                <div class="mb-4 position-relative">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>

               <!-- Input Confirm Password -->
               <div class="mb-4 position-relative">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <!-- Input Foto -->
                <div class="mb-4 position-relative">
                    <label for="foto" class="form-label">{{ __('Foto') }}</label>
                    <input id="foto" type="file" class="form-control" name="foto" >
                </div>
                <div>
                    <input id="role" type="hidden" name="role" value="siswa">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg" style="background:rgb(42, 6, 204); border-color:rgb(42, 6, 204);">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>

<style>
    #background-container {
        background-image: url('{{ asset('images/login_desktop.jpg') }}');
    }

    /* Ubah background untuk perangkat mobile */
    @media (max-width: 768px) {
        #background-container {
            background-image: url('{{ asset('images/login-mobile.jpg') }}');
        }
    }
</style>

@endsection
