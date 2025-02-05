@extends('layout2.app')

@section('konten')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Menu Manajemen Ujian</h2>
        <div>
            <a href="{{ route('guru.manajemen-ujian.index') }}" class="btn btn-warning text-white">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="#" class="btn btn-primary text-white">
                <i class="fas fa-print"></i> Cetak
            </a>
            <a href="{{ route('guru.daftar-siswa.export', $ujian_id) }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>


        </div>
    </div>

    <h5 class="text-info">Daftar Siswa Yang Melaksanakan Ujian</h5>

    <table class="table table-bordered table-hover">
        <thead class="bg-light">
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Nilai PG</th>
                <th>Nilai Essay</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswaSudahUjian as $index => $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>
                        @if(!is_null($siswa->ujian_id) && !is_null($siswa->siswa_id))
                            <a href="{{ route('guru.manajemen-ujian.koreksi.analisa_pg', ['ujian_id' => $siswa->ujian_id, 'siswa_id' => $siswa->siswa_id]) }}" class="btn btn-primary btn-sm">
                                {{ $siswa->nilai_pg ?? 'N/A' }} <span class="badge bg-info">Analisa</span>
                            </a>
                        @else
                            <span class="text-muted">Data tidak tersedia</span>
                        @endif
                    </td>

                    <td>
                        @if(!is_null($siswa->total_nilai_essay))
                            <a href="{{ route('guru.manajemen-ujian.koreksi.koreksi_essay', ['ujian_id' => $siswa->ujian_id, 'siswa_id' => $siswa->siswa_id]) }}" class="btn btn-success btn-sm">
                                {{ $siswa->total_nilai_essay }}
                            </a>
                        @else
                            <a href="{{ route('guru.manajemen-ujian.koreksi.koreksi_essay', ['ujian_id' => $siswa->ujian_id, 'siswa_id' => $siswa->siswa_id]) }}" class="btn btn-warning btn-sm">Belum Koreksi</a>
                        @endif
                    </td>


                    <td>
                        @php
                            $total_nilai = (($siswa->nilai_pg ?? 0) + ($siswa->total_nilai_essay ?? 0)) / 2;
                        @endphp
                        <span class="badge bg-light">{{ $total_nilai }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="alert alert-info mt-3">
        <p><strong>Catatan:</strong></p>
        <ul>
            <li>Hanya jawaban soal Essay yang bisa dikoreksi.</li>
            <li>Penilaian soal pilihan ganda otomatis oleh sistem.</li>
        </ul>
    </div>
</div>
@endsection
