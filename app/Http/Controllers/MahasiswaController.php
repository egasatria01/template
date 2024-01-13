<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // Read Data Mahasiswa ----------------------------------------------------------------------------------------------
    public function index() {
        $mahasiswa = Mahasiswa::All();
        return view('mahasiswa', compact('mahasiswa'));
    }

    // Tambah Data Mahasiswa ----------------------------------------------------------------------------------------------
    public function tambah(Request $req){
        $mahasiswa = new Mahasiswa;

        $mahasiswa->nama = $req->get('name');
        $mahasiswa->npm = $req->get('npm');
        $mahasiswa->email = $req->get('email');
        $mahasiswa->tanggalLahir = $req->get('tanggalLahir');
        $mahasiswa->alamat = $req->get('alamat');
        $mahasiswa->jurusan = $req->get('jurusan');
        $mahasiswa->angkatan = $req->get('angkatan');
        $mahasiswa->programStudi = $req->get('programStudi');

        $mahasiswa->save();

        $notification = array(
            'message' =>'Data Mahasiswa berhasil ditambahkan', 'alert-type' =>'success'
        );
        return redirect()->route('mahasiswa')->with($notification);
    }

    // Get Data Mahasiswa ----------------------------------------------------------------------------------------------
    public function getDataMahasiswa($id){
        $mahasiswa = Mahasiswa::find($id);
        return response()->json($mahasiswa);
    }

    // Ubah Data Mahasiswa ----------------------------------------------------------------------------------------------
    public function ubah(Request $req) {
        $mahasiswa = Mahasiswa::find($req->get('id'));

        $mahasiswa->nama = $req->get('name');
        $mahasiswa->npm = $req->get('npm');
        $mahasiswa->email = $req->get('email');
        $mahasiswa->tanggalLahir = $req->get('tanggalLahir');
        $mahasiswa->alamat = $req->get('alamat');
        $mahasiswa->jurusan = $req->get('jurusan');
        $mahasiswa->angkatan = $req->get('angkatan');
        $mahasiswa->programStudi = $req->get('programStudi');

        $mahasiswa->save();

        $notification = array(
            'message' => 'Data Mahasiswa berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('mahasiswa')->with($notification);
    }

    // Hapus Data Mahasiswa ----------------------------------------------------------------------------------------------
    public function hapus($id){
        $mahasiswa = Mahasiswa::find($id);

        $mahasiswa->delete();

        $success = true;
        $message = "Data Mahasiswa berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}