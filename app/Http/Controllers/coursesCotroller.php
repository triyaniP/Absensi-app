<?php

namespace App\Http\Controllers;

use App\Models\coursesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class coursesCotroller extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model courseModel
        $data = coursesModel::all();
        // Mengirimkan data ke view 'course.Index' dengan variabel 'data'
        return view('pages.course.course')->with('data', $data);
    }

    // Fungsi untuk membuat atau menyimpan data course baru
    public function createData(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'course_code' => 'required|numeric',
                'course_name' => 'required',
                'lecturer_name' => 'required',
                'semester' => 'required|numeric',
            ]
        );
        if($validation->fails()){
            $message = $validation->errors()->all();
            Alert::error('gagal', $message);
            return back();
        }
        // Membuat instance baru dari model courseModel
        $data = new coursesModel();
        // Mengambil nilai dari input form dan mengisi kolom pada model
        $data->course_code = $request->input('course_code');
        $data->course_name = $request->input('course_name');
        $data->lecturer_name = $request->input('lecturer_name');
        $data->semester = $request->input('semester');
        // Menyimpan data ke dalam database
        $data->save();
        // Setelah menyimpan, redirect ke route yang menampilkan semua data course
        if ($data){
            Alert::success('create data successfully');
            return redirect()->route('getAllDataCourse');;
        }else{
            Alert::error('failed to create data');
            return back();
        }
    }

    public function createForm()
    {
        return view('pages.course.create');
    }


    // Fungsi untuk mendapatkan data course berdasarkan ID untuk keperluan edit
    public function getDataById($id)
    {
        // Mengambil satu data course berdasarkan ID
        $data = coursesModel::where('id', $id)->first();
        // Mengirimkan data ke view 'course.edit' untuk ditampilkan di form edit
        return view('pages.course.edit')->with('data', $data);
    }

    // Fungsi untuk mengupdate data course berdasarkan ID
    public function updateData(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'course_code' => 'required|numeric',
                'course_name' => 'required',
                'lecturer_name' => 'required',
                'semester' => 'required|numeric',
            ]
        );
        if($validation->fails()){
            $message = $validation->errors()->all();
            Alert::error('gagal', $message);
            return back();
        }
        // Mengambil data course berdasarkan ID
        $data = coursesModel::where('id', $id)->first();
        // Mengambil inputan baru dari form dan mengupdate data pada model
        $data->course_code = $request->input('course_code');
        $data->course_name = $request->input('course_name');
        $data->lecturer_name = $request->input('lecturer_name');
        $data->semester = $request->input('semester');
        // Menyimpan perubahan data ke dalam database
        $data->save();
        // Setelah data berhasil diupdate, redirect ke halaman yang menampilkan semua data course
        if ($data){
            Alert::success('create data successfully');
            return redirect()->route('getAllDataCourse');;
        }else{
            Alert::error('failed to create data');
            return back();
        }
    }

    // Fungsi untuk menghapus data course berdasarkan ID
    public function deleteData($id)
    {
        // Mengambil data course berdasarkan ID
        $data = coursesModel::where('id', $id)->first();

        $data->delete();
        // Setelah penghapusan, redirect ke halaman yang menampilkan semua data course
        Alert::success('delete data successfully');
        return redirect()->route('getAllDataCourse');
    }

}
