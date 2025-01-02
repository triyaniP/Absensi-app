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
            @foreach ($data as $d)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nama: {{ $d->students->name }}</h5>
                    <p class="card-text">Mata Kuliah: {{ $d->courses->course_name }}</p>
                    <p class="card-text">Batas Waktu: {{ $d->time_attendance }}</p>
                    <p class="card-text">Status: {{ $d->status }}</p>
                    <form action="{{ route('Attendance', $d->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Absen</button>
                    </form>
                </div>
            </div>
            @endforeach
            
            
        </div>
    </div>
</section>
@endsection
@section('script')

@endsection
