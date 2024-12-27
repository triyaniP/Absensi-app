<?php

namespace App\Http\Controllers;

use App\Models\studentsModel;
use Illuminate\Http\Request;

class studentsController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model PegawaiModel
        $data = studentsModel::all();
        // Mengirimkan data ke view 'Pegawai.Index' dengan variabel 'data'
        return view('pages.mahasiswa.mahasiswa')->with('data', $data);
    }

    // Fungsi untuk membuat atau menyimpan data pegawai baru
    public function createData(Request $request)
    {
        // Membuat instance baru dari model PegawaiModel
        $data = new studentsModel();
        // Mengambil nilai dari input form dan mengisi kolom pada model
        $data->name = $request->input('name');
        $data->nim = $request->input('nim');
        $data->prodi = $request->input('prodi');
        // Menyimpan data ke dalam database
        $data->save();
        // Setelah menyimpan, redirect ke route yang menampilkan semua data pegawai
        return redirect()->route('getalldatamahasiswa');
    }

    public function createForm()
    {
        return view('pages.mahasiswa.create');
    }


    // Fungsi untuk mendapatkan data pegawai berdasarkan ID untuk keperluan edit
    public function getDataById($id)
    {
        // Mengambil satu data pegawai berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Mengirimkan data ke view 'Pegawai.edit' untuk ditampilkan di form edit
        return view('pages.mahasiswa.edit')->with('data', $data);
    }

    // Fungsi untuk mengupdate data pegawai berdasarkan ID
    public function updateData(Request $request, $id)
    {
        // Mengambil data pegawai berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Mengambil inputan baru dari form dan mengupdate data pada model
        $data->name = $request->input('name');
        $data->nim = $request->input('nim');
        $data->prodi = $request->input('prodi');
        // Menyimpan perubahan data ke dalam database
        $data->save();
        // Setelah data berhasil diupdate, redirect ke halaman yang menampilkan semua data pegawai
        return redirect()->route('getalldatamahasiswa');
    }

    // Fungsi untuk menghapus data pegawai berdasarkan ID
    public function deleteData($id)
    {
        // Mengambil data pegawai berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Menghapus data pegawai dari database
        $data->delete();
        // Setelah penghapusan, redirect ke halaman yang menampilkan semua data pegawai
        return redirect()->route('getalldatamahasiswa');
    }

}
