@extends('layout.master')
@section('style')

@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Mahasiswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('createDataAttendance') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    placeholder="Masukkan Tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="time">NIM</label>
                                <input type="datetime" class="form-control" id="time" name="time"
                                    placeholder="Masukkan waktu" required>
                            </div>
                            <div class="form-group">
                                <label for="courses_id">NIM</label>
                                <input type="text" class="form-control" id="courses_id" name="courses_id"
                                    placeholder="Masukkan waktu" required>
                            </div>
                            <div class="form-group">
                                <label for="students_id">NIM</label>
                                <input type="text" class="form-control" id="students_id" name="students_id"
                                    placeholder="Masukkan waktu" required>
                            </div>
                            <div class="form-group">
                                <label for="status">status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value=""></option>
                                    <option value="present">Hadir</option>
                                    <option value="absent">Tidak Hadir</option>
                                    <option value="late">Lambat</option>
                                    <option value="out of range">tidak dalam jangkauan</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('getalldatamahasiswa') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection
@section('script')

@endsection
