<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    // Read Data Dosen ------------------------------------------------------------------------------------------------
    public function index() {
        $dosen = Dosen::All();
        return view('dosen', compact('dosen'));
    }

    // Tambah Data Dosen ----------------------------------------------------------------------------------------------
    public function tambah(Request $req){
        $dosen = new Dosen;

        $dosen->nama = $req->get('name');
        $dosen->nip = $req->get('nip');
        $dosen->email = $req->get('email');
        $dosen->jabatan = $req->get('jabatan');
        $dosen->kontak = $req->get('kontak');
        $dosen->alamat = $req->get('alamat');
        $dosen->tanggalLahir = $req->get('tanggalLahir');
        if ($req->gelarAkademik == null){
            $dosen->gelarAkademik = '-';
        } else {
            $dosen->gelarAkademik = $req->get('gelarAkademik');
        }
        $dosen->programStudi = $req->get('programStudi');

        $dosen->save();

        $notification = array(
            'message' =>'Data Dosen berhasil ditambahkan', 'alert-type' =>'success'
        );
        return redirect()->route('dosen')->with($notification);
    }

    // Get Data Dosen ----------------------------------------------------------------------------------------------
    public function getDataDosen($id){
        $dosen = Dosen::find($id);
        return response()->json($dosen);
    }

    // Ubah Data Dosen ----------------------------------------------------------------------------------------------
    public function ubah(Request $req) {
        $dosen = Dosen::find($req->get('id'));

        $dosen->nama = $req->get('name');
        $dosen->nip = $req->get('nip');
        $dosen->email = $req->get('email');
        $dosen->jabatan = $req->get('jabatan');
        $dosen->kontak = $req->get('kontak');
        $dosen->alamat = $req->get('alamat');
        $dosen->tanggalLahir = $req->get('tanggalLahir');
        $dosen->gelarAkademik = $req->get('gelarAkademik');
        $dosen->programStudi = $req->get('programStudi');

        $dosen->save();

        $notification = array(
            'message' => 'Data Dosen berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('dosen')->with($notification);
    }

    // Hapus Data Dosen ----------------------------------------------------------------------------------------------
    public function hapus($id){
        $dosen = Dosen::find($id);

        $dosen->delete();

        $success = true;
        $message = "Data Dosen berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

}