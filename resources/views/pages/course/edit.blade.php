@extends('layout.master')
@section('style')

@endsection
@section('contents')
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
                        <form action="{{ route('updateDataCourse', $data->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="course_code">Kode Mata Kuliah</label>
                                <input type="text" class="form-control" id="course_code" name="course_code"
                                    placeholder="Masukkan Kode Mata Kuliah" value="{{$data->course_code}}" required>
                            </div>
                            <div class="form-group">
                                <label for="course_name">Nama Mata Kuliah</label>
                                <input type="text" class="form-control" id="course_name" name="course_name"
                                    placeholder="Masukkan nama mata kuliah" value="{{$data->course_name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="lecturer_name">Nama Dosen</label>
                                <input type="text" class="form-control" id="lecturer_name" name="lecturer_name"
                                    placeholder="Masukkan nama dosen" value="{{$data->lecturer_name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="text" class="form-control" id="semester" name="semester"
                                    placeholder="Masukkan semester" value="{{$data->semester}}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('getAllDataCourse') }}" class="btn btn-secondary">Batal</a>
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
