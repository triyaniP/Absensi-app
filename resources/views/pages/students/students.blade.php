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
                        <h3 class="card-title">Table Mahasiswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('createDataStudents') }}" class="btn btn-dark mb-3">
                            <i class="fas fa-plus"></i> Add
                        </a>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                    <th>Kampus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->count() > 0)
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $dt)
                                        <tr class="">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $dt->NIM}}</td>
                                            <td>{{ $dt->name }}</td>
                                            <td>{{ $dt->email }}</td>
                                            <td>{{ $dt->phone }}</td>
                                            <td>{{ $dt->departement }}</td>
                                            <td>
                                                <a href="{{ route('getDataByIdStudents', $dt->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('deleteDataStudents', $dt->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-danger text-center">Data Kosong</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
