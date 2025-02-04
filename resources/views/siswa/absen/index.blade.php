@extends('layout2.app')

@section('konten')
<title>Absen Masuk</title>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h3>Absen Masuk</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('siswa.absen.store') }}" method="POST">
                @csrf
                <div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    {{-- <div class="mb-3">
                    <label for="user_id" class="form-label">Siswa</label>
                    <select name="user_id" class="form-control" required>
                        <option selected disabled>-- Pilih Nama --</option>
                        @foreach ($users as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div> --}}
                </div>

                <button type="submit" class="btn btn-primary">Absen Masuk</button>
            </form>
        </div>
    </div>
</div>
@endsection
