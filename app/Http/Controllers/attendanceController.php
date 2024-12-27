<?php

namespace App\Http\Controllers;

use App\Models\attendanceModel;
use Illuminate\Http\Request;

class attendanceController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model PegawaiModel
        $data = attendanceModel::->with('courses', 'students')->get();
        // Mengirimkan data ke view 'Pegawai.Index' dengan variabel 'data'
        return view('pages.attendance.attendance')->with('data', $data);
    }

    // Fungsi untuk membuat atau menyimpan data pegawai baru
    public function createData(Request $request)
    {
        // Membuat instance baru dari model PegawaiModel
        $data = new attendanceModel();
        // Mengambil nilai dari input form dan mengisi kolom pada model
        $data->date = $request->input('date');
        $data->time = $request->input('time');
        $data->status = $request->input('status');
        $data->courses_id = $request->input('courses_id');
        $data->students_id = $request->input('students_id');
        // Menyimpan data ke dalam database
        $data->save();
        // Setelah menyimpan, redirect ke route yang menampilkan semua data pegawai
        return redirect()->route('getAllDataAttendance');
    }

    public function createForm()
    {
        return view('pages.attendance.create');
    }


    // Fungsi untuk mendapatkan data pegawai berdasarkan ID untuk keperluan edit
    public function getDataById($id)
    {
        // Mengambil satu data pegawai berdasarkan ID
        $data = attendanceModel::where('id', $id)->first();
        // Mengirimkan data ke view 'Pegawai.edit' untuk ditampilkan di form edit
        return view('pages.mahasiswa.edit')->with('data', $data);
    }

    // Fungsi untuk mengupdate data pegawai berdasarkan ID
    public function updateData(Request $request, $id)
    {
        // Mengambil data pegawai berdasarkan ID
        $data = attendanceModel::where('id', $id)->first();
        // Mengambil inputan baru dari form dan mengupdate data pada model
        $data->date = $request->input('date');
        $data->time = $request->input('time');
        $data->status = $request->input('status');
        $data->courses_id = $request->input('courses_id');
        $data->students_id = $request->input('students_id');
        // Menyimpan perubahan data ke dalam database
        $data->save();
        // Setelah data berhasil diupdate, redirect ke halaman yang menampilkan semua data pegawai
        return redirect()->route('getalldataAttendance');
    }

    // Fungsi untuk menghapus data pegawai berdasarkan ID
    public function deleteData($id)
    {
        // Mengambil data pegawai berdasarkan ID
        $data = attendanceModel::where('id', $id)->first();
        // Menghapus data pegawai dari database
        $data->delete();
        // Setelah penghapusan, redirect ke halaman yang menampilkan semua data pegawai
        return redirect()->route('getalldataAttendance');
    }

}
