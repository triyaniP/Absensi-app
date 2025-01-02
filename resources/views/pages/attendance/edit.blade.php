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
                        <h3 class="card-title">Edit Data Mahasiswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('updateDataAttendance', $data->id) }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label for="date_attendance">Tanggal Kehadiran</label>
                                <input type="date" name="date_attendance" id="date_attendance" class="form-control" 
                                    value="{{ old('date_attendance', $data->date_attendance) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="time_attendance">Waktu Kehadiran</label>
                                <input type="time" name="time_attendance" id="time_attendance" class="form-control" 
                                    value="{{ old('time_attendance', $data->time_attendance) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="courses_id">Pilih Mata Kuliah</label>
                                <select name="courses_id" id="courses_id" class="form-control" required>
                                    <option value="" selected disabled hidden>Choose here</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" 
                                            {{ old('courses_id', $data->courses_id) == $course->id ? 'selected' : '' }}>
                                            {{ $course->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="students_id">Pilih Mahasiswa</label>
                                <select name="students_id" id="students_id" class="form-control" required>
                                    <option value="" selected disabled hidden>Choose here</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" 
                                            {{ old('students_id', $data->students_id) == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>  

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('getAllDataAttendance') }}" class="btn btn-secondary">Batal</a>
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
