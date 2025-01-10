<?php

namespace App\Http\Controllers;

use App\Models\studentsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class studentsController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model studentsModel
        $data = studentsModel::all();
        // Mengirimkan data ke view 'students.Index' dengan variabel 'data'
        return view('pages.students.students')->with('data', $data);
    }

    // Fungsi untuk membuat atau menyimpan data students baru
    public function createData(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'NIM' => 'required|numeric',
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required|numeric',
                'departement' => 'required',
            ]
        );
        if($validation->fails()){
            $message = $validation->errors()->all();
            Alert::error('gagal', $message);
            return back();
        }
        // Membuat instance baru dari model studentsModel
        $data = new studentsModel();
        // Mengambil nilai dari input form dan mengisi kolom pada model
        $data->NIM = $request->input('NIM');
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->departement = $request->input('departement');
        // Menyimpan data ke dalam database
        $data->save();
        // Setelah menyimpan, redirect ke route yang menampilkan semua data students
        if ($data){
            Alert::success('create data successfully');
            return redirect()->route('getAllDataStudents');;
        }else{
            Alert::error('failed to create data');
            return back();
        }
    }

    public function createForm()
    {
        return view('pages.students.create');
    }


    // Fungsi untuk mendapatkan data students berdasarkan ID untuk keperluan edit
    public function getDataById($id)
    {
        // Mengambil satu data students berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Mengirimkan data ke view 'students.edit' untuk ditampilkan di form edit
        return view('pages.students.edit')->with('data', $data);
    }

    // Fungsi untuk mengupdate data students berdasarkan ID
    public function updateData(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'NIM' => 'required|numeric',
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required|numeric',
                'departement' => 'required',
            ]
        );
        if($validation->fails()){
            $message = $validation->errors()->all();
            Alert::error('gagal', $message);
            return back();
        }
        // Mengambil data students berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Mengambil inputan baru dari form dan mengupdate data pada model
        $data->NIM = $request->input('NIM');
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->departement = $request->input('departement');
        // Menyimpan perubahan data ke dalam database
        $data->save();
        if ($data){
            Alert::success('create data successfully');
            return redirect()->route('getAllDataStudents');
        }else{
            Alert::error('failed to create data');
            return back();
        }
        // Setelah data berhasil diupdate, redirect ke halaman yang menampilkan semua data students
    }

    // Fungsi untuk menghapus data students berdasarkan ID
    public function deleteData($id)
    {
        // Mengambil data students berdasarkan ID
        $data = studentsModel::where('id', $id)->first();
        // Menghapus data students dari database
        $data->delete();
        // Setelah penghapusan, redirect ke halaman yang menampilkan semua data students
        Alert::success('delete data successfully');
        return redirect()->route('getAllDataStudents');
    }

}
