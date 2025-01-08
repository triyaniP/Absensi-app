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
        // Mengambil semua data dari model attandanceModel
        $data = attendanceModel::with('courses', 'students')->get();
        // Mengirimkan data ke view 'attandance.Index' dengan variabel 'data'
        return view('pages.attendance.attendance', compact('data'));
    }

    public function createForm()
    {
        $courses = coursesModel::all();
        $students = studentsModel::all();
        return view('pages.attendance.create', compact('courses', 'students'));
    }

    // Fungsi untuk membuat atau menyimpan data attandance baru
    public function createData(Request $request)
    {
        // Membuat instance baru dari model attandanceModel
        $data = new attendanceModel();
        // Mengambil nilai dari input form dan mengisi kolom pada model
        $data->date_attendance = $request->input('date_attendance');
        $data->time_attendance = $request->input('time_attendance');
        $data->status = 'absent';
        $data->courses_id = $request->input('courses_id');
        $data->students_id = $request->input('students_id');
        // Menyimpan data ke dalam database
        $data->save();
        // Setelah menyimpan, redirect ke route yang menampilkan semua data attandance
        return redirect()->route('getAllDataAttendance');
    }

    // Fungsi untuk mendapatkan data attandance berdasarkan ID untuk keperluan edit
    public function getDataById($id)
    {
        // Mengambil satu data attandance berdasarkan ID
        $data = attendanceModel::where('id', $id)->first();
        $courses = coursesModel::all();
        $students = studentsModel::all();
        // Mengirimkan data ke view 'attendance.edit' untuk ditampilkan di form edit
        return view('pages.attendance.edit', compact('data', 'courses','students'));
    }

    // Fungsi untuk mengupdate data absen berdasarkan ID
    public function updateData(Request $request, $id)
    {
        // Mengambil data attandance berdasarkan ID
        $data = attendanceModel::where('id', $id)->first();
        // Mengambil inputan baru dari form dan mengupdate data pada model
        $data->date_attendance = $request->input('date_attendance');
        $data->time_attendance = $request->input('time_attendance');
        $data->status = 'absent';
        $data->courses_id = $request->input('courses_id');
        $data->students_id = $request->input('students_id');
        // Menyimpan perubahan data ke dalam database
        $data->save();
        // Setelah data berhasil diupdate, redirect ke halaman yang menampilkan semua data absen
        return redirect()->route('getAllDataAttendance');
    }

    public function deleteData($id)
    {
        $data = attendanceModel::where('id', $id)->first();
        $data->delete();
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

    public function absensi(Request $request, $id)
    {
        // Lokasi tetap
        $lokasiTetap = [
            'latitude' => -0.8867313695270926,
            'longitude' => 119.86131697078548
        ];

        // Lokasi pengguna dari form input
        $latitudePengguna = $request->input('latitude');
        $longitudePengguna = $request->input('longitude');

        // Validasi input
        if (!$latitudePengguna || !$longitudePengguna ||
            !is_numeric($latitudePengguna) || !is_numeric($longitudePengguna)) {
            return redirect()->back()->with([
                'status' => 'error',
                'pesan' => 'Data lokasi tidak valid. Pastikan Anda mengisi dengan benar.'
            ]);
        }

        // Ambil data absensi berdasarkan ID
        $dataAbsensi = attendanceModel::find($id);

        if (!$dataAbsensi) {
            return redirect()->back()->with([
                'status' => 'error',
                'pesan' => 'Data absensi tidak ditemukan.'
            ]);
        }

        // Hitung jarak pengguna ke lokasi tetap
        $jarak = $this->hitungJarak(
            $latitudePengguna,
            $longitudePengguna,
            $lokasiTetap['latitude'],
            $lokasiTetap['longitude']
        );

        // Cek batas waktu
        $currentTime = now(); // Waktu sekarang
        $timeAttendance = Carbon::parse($dataAbsensi->time_attendance); // Batas waktu

        if ($jarak > 500) {
            $dataAbsensi->status = 'out of range';
            $message = 'Anda berada di luar radius 500 meter.';
        } elseif ($currentTime->greaterThan($timeAttendance)) {
            $dataAbsensi->status = 'late';
            $message = 'Anda berada dalam radius 500 meter tetapi terlambat.';
        } else {
            $dataAbsensi->status = 'present';
            $message = 'Absensi berhasil! Anda berada dalam radius 500 meter dan tepat waktu.';
        }

        // Simpan status ke database
        $dataAbsensi->save();

        // Redirect dengan pesan dan jarak
        return redirect()->back()->with([
            'status' => $dataAbsensi->status,
            'pesan' => $message,
            'jarak' => $jarak
        ]);
    }

    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $radiusBumi = 6371000; // Radius bumi dalam meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $radiusBumi * $c; // Jarak dalam meter
    }

}

