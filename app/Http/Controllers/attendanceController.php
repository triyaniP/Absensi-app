<?php

namespace App\Http\Controllers;

use App\Models\attendanceModel;
use App\Models\coursesModel;
use App\Models\studentsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class attendanceController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model PegawaiModel
        $data = attendanceModel::with('courses', 'students')->get();
        // Mengirimkan data ke view 'Pegawai.Index' dengan variabel 'data'
        return view('pages.attendance.attendance', compact('data'));
    }
    
    public function createForm()
    {
        $courses = coursesModel::all();
        $students = studentsModel::all();
        return view('pages.attendance.create', compact('courses', 'students'));
    }

    // Fungsi untuk membuat atau menyimpan data pegawai baru
    public function createData(Request $request)
    {
        // Membuat instance baru dari model PegawaiModel
        $data = new attendanceModel();
        // Mengambil nilai dari input form dan mengisi kolom pada model
        $data->date_attendance = $request->input('date_attendance');
        $data->time_attendance = $request->input('time_attendance');
        $data->status = 'absent';
        $data->courses_id = $request->input('courses_id');
        $data->students_id = $request->input('students_id');
        // Menyimpan data ke dalam database
        $data->save();
        // Setelah menyimpan, redirect ke route yang menampilkan semua data pegawai
        return redirect()->route('getAllDataAttendance');
    }

    // Fungsi untuk mendapatkan data pegawai berdasarkan ID untuk keperluan edit
    public function getDataById($id)
    {
        // Mengambil satu data pegawai berdasarkan ID
        $data = attendanceModel::where('id', $id)->first();
        $courses = coursesModel::all();
        $students = studentsModel::all();
        // Mengirimkan data ke view 'Pegawai.edit' untuk ditampilkan di form edit
        return view('pages.attendance.edit', compact('data', 'courses','students'));
    }

    // Fungsi untuk mengupdate data pegawai berdasarkan ID
    public function updateData(Request $request, $id)
    {
        // Mengambil data pegawai berdasarkan ID
        $data = attendanceModel::where('id', $id)->first();
        // Mengambil inputan baru dari form dan mengupdate data pada model
        $data->date_attendance = $request->input('date_attendance');
        $data->time_attendance = $request->input('time_attendance');
        $data->status = 'absent';
        $data->courses_id = $request->input('courses_id');
        $data->students_id = $request->input('students_id');
        // Menyimpan perubahan data ke dalam database
        $data->save();
        // Setelah data berhasil diupdate, redirect ke halaman yang menampilkan semua data pegawai
        return redirect()->route('getAllDataAttendance');
    }

    // Fungsi untuk menghapus data pegawai berdasarkan ID
    public function deleteData($id)
    {
        // Mengambil data pegawai berdasarkan ID
        $data = attendanceModel::where('id', $id)->first();
        // Menghapus data pegawai dari database
        $data->delete();
        // Setelah penghapusan, redirect ke halaman yang menampilkan semua data pegawai
        return redirect()->route('getAllDataAttendance');
    }

    public function attendance(Request $request, $id){
        $data = attendanceModel::find($id);

        $deadlineTime = Carbon::parse($data->time_attendance); 
        $currentTime = Carbon::now();

        if ($currentTime->gt($deadlineTime)) {
            $data->status = 'late'; // Jika waktu saat ini melewati batas waktu
        } else {
            $data->status = 'present'; // Jika sesuai waktu
        }
        $data->save();
        return redirect()->route('attendanceform');
    }

    public function showAttendance()
{
    // Ambil data absensi dengan relasi mahasiswa dan mata kuliah
    $data = attendanceModel::with('students', 'courses')->get();
    // Kirim data ke view
    return view('pages.attendance.attendanceform', compact('data'));
}

}
