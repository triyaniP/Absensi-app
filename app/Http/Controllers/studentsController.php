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
        return view('pages.students.students')->with('data', $data);
    }

    // Fungsi untuk membuat atau menyimpan data pegawai baru
    public function createData(Request $request)
    {
        // Membuat instance baru dari model PegawaiModel
        $data = new studentsModel();
        // Mengambil nilai dari input form dan mengisi kolom pada model
        $data->NIM = $request->input('NIM');
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->departement = $request->input('departement');
        // Menyimpan data ke dalam database
        $data->save();
        // Setelah menyimpan, redirect ke route yang menampilkan semua data pegawai
        return redirect()->route('getAllDataStudents');
    }

    public function createForm()
    {
        return view('pages.students.create');
    }


    // Fungsi untuk mendapatkan data pegawai berdasarkan ID untuk keperluan edit
    public function getDataById($id)
    {
        // Mengambil satu data pegawai berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Mengirimkan data ke view 'Pegawai.edit' untuk ditampilkan di form edit
        return view('pages.students.edit')->with('data', $data);
    }

    // Fungsi untuk mengupdate data pegawai berdasarkan ID
    public function updateData(Request $request, $id)
    {
        // Mengambil data pegawai berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Mengambil inputan baru dari form dan mengupdate data pada model
        $data->NIM = $request->input('NIM');
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->departement = $request->input('departement');
        // Menyimpan perubahan data ke dalam database
        $data->save();
        // Setelah data berhasil diupdate, redirect ke halaman yang menampilkan semua data pegawai
        return redirect()->route('getAllDataStudents');
    }

    // Fungsi untuk menghapus data pegawai berdasarkan ID
    public function deleteData($id)
    {
        // Mengambil data pegawai berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Menghapus data pegawai dari database
        $data->delete();
        // Setelah penghapusan, redirect ke halaman yang menampilkan semua data pegawai
        return redirect()->route('getDataAllStudents');
    }

}
