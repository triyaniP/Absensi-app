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
                        <form action="{{ route('updateDataStudents') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="NIM">NIM</label>
                                <input type="text" class="form-control" id="NIM" name="NIM"
                                    placeholder="Masukkan Kode Mata Kuliah" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama mata kuliah" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Masukkan nama dosen" required>
                            </div>
                            <div class="form-group">
                                <label for="departement">Kampus</label>
                                <input type="text" class="form-control" id="departement" name="departement"
                                    placeholder="Masukkan semester" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('getAllDataStudents') }}" class="btn btn-secondary">Batal</a>
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
