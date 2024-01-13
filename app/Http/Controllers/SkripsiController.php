<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skripsi;
use Illuminate\Support\Facades\Storage;

class SkripsiController extends Controller
{
    // Tambah Data Skripsi ----------------------------------------------------------------------------------------------
    public function index() {
        $skripsi = Skripsi::All();
        return view('skripsi', compact('skripsi'));
    }

    // Landing Page -----------------------------------------------------------------------------------------------------
    public function landingpage(Request $req) {

        //Searching Data Skripsi ----------------------------------------------------------------------------------------
        $query = Skripsi::query();
        $query->select('id','judul','penulis','rilis', 'abstrak','keterangan','halaman');
        if(!empty($req->judul)){
            $query->where('judul', 'LIKE', '%' . $req->judul . '%');
        }
        if(!empty($req->penulis)){
            $query->where('penulis', 'LIKE', '%' . $req->penulis . '%');
        }
        if(!empty($req->rilis)){
            $query->where('rilis', 'LIKE', '%' . $req->rilis . '%');
        }
        $query->orderBy('created_at','desc');
        //End Searching
        $skripsi = $query->paginate(10);

        return view('welcome', compact('skripsi'));
    }

    // Tambah Data Skripsi ----------------------------------------------------------------------------------------------
    public function tambah(Request $req){
        $skripsi = new Skripsi;

        $skripsi->judul = $req->get('judul');
        $skripsi->penulis = $req->get('penulis');
        $skripsi->abstrak = $req->get('abstrak');
        $skripsi->keterangan = $req->get('keterangan');
        $skripsi->rilis = $req->get('rilis');
        $skripsi->halaman = $req->get('halaman');

        if($req->hasFile('file')){
            $extension = $req->file('file')->extension();
            $filename = 'file_skripsi'.time().'.'. $extension;
            $req->file('file')->storeAs('public/file_skripsi', $filename);
            $skripsi->file = $filename;
        }

        $skripsi->save();
        $notification = array(
            'message' =>'Data Skripsi berhasil ditambahkan', 'alert-type' =>'success'
        );
        return redirect()->route('skripsi')->with($notification);
    }

    // Tampil PDF  Skripsi ----------------------------------------------------------------------------------------------
    public function showPdf($id){
        $data = Skripsi::find($id);
        if ($data) {
            $pdfPath = $data->file; // Tentukan kolom yang berisi path file PDF di model Anda
            return response()->file(Storage::path('public/file_skripsi/'.$pdfPath));
        }
        return abort(404);
    }

    // Get Data Skripsi ----------------------------------------------------------------------------------------------
    public function getDataSkripsi($id){
        $skripsi = Skripsi::find($id);
        return response()->json($skripsi);
    }

    // Ubah Data Skripsi ----------------------------------------------------------------------------------------------
    public function ubah(Request $req) {
        $skripsi = Skripsi::find($req->get('id'));

        $skripsi->judul = $req->get('judul');
        $skripsi->penulis = $req->get('penulis');
        $skripsi->abstrak = $req->get('abstrak');
        $skripsi->keterangan = $req->get('keterangan');
        $skripsi->rilis = $req->get('rilis');
        $skripsi->halaman = $req->get('halaman');


        if ($req->hasFile('file')) {
            $extension = $req->file('file')->extension();
            $filename = 'file_skripsi_'.time().'.'.$extension;
            $req->file('file')->storeAs('public/file_skripsi', $filename );
            Storage::delete('public/file_skripsi/'.$req->get('old_file'));
            $skripsi->file = $filename;
        }

        $skripsi->save();

        $notification = array(
            'message' => 'Data Skripsi berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('skripsi')->with($notification);
    }

    // Hapus Data Skripsi ----------------------------------------------------------------------------------------------
    public function hapus($id){
        $skripsi = Skripsi::find($id);

        $skripsi->delete();

        $success = true;
        $message = "Data Skripsi berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}