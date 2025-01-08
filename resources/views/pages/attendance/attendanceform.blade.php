@extends('layout.master')
@section('style')

@endsection
@section('contents')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Absensi Mahasiswa</h3>
            </div>

            <!-- Tampilkan data absensi mahasiswa -->
            @foreach ($data as $d)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nama: {{ $d->students->name }}</h5>
                    <p class="card-text">Mata Kuliah: {{ $d->courses->course_name }}</p>
                    <p class="card-text">Batas Waktu: {{ $d->time_attendance }}</p>
                    <p class="card-text">Status: {{ $d->status }}</p>
                    <!-- Form Absensi -->
                    <form action="{{ route('absensi', $d->id) }}" method="POST">
                        @csrf
                        <label for="latitude">Latitude:</label>
                        <input type="text" id="latitude" name="latitude" required>
                        <br><br>
                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" required>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Absen</button>
                    </form>
                </div>
            </div>
            @endforeach

            <!-- Form Absensi Lokasi -->
            @if (session('status') === 'success')
                <!-- Jika absensi berhasil -->
                <div class="alert alert-success">
                    Absensi berhasil! Anda berada dalam radius 500 meter. Jarak Anda: {{ session('jarak') }} meter.
                </div>
            @elseif (session('status') === 'fail')
                <!-- Jika absensi gagal -->
                <div class="alert alert-danger">
                    Absensi gagal! Anda berada di luar radius 500 meter. Jarak Anda: {{ session('jarak') }} meter.
                </div>
            @elseif (session('status') === 'error')
                <!-- Jika terdapat error -->
                <div class="alert alert-warning">
                    {{ session('pesan') }}
                </div>
            @endif

            <!-- Form input untuk latitude dan longitude -->

        </div>
    </div>
</section>
@endsection
@section('script')

@endsection
