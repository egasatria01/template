@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Kelola Jurnal</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="tombol">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Tambah Data Jurnal
                            </button>
                        </div>
                        <div class="tombol">
                            <button type="button" class="btn btn-info" >
                                Export
                            </button>
                        </div>
                    </div>
                    <table id="table-data" class="table table-bordered text-center">
                        <thead>
                            <tr class="text-center">
                                <th>No. Jurnal</th>
                                <th>Nama Kelas</th>
                                <th>Status</th>
                                <th>Harga</th>
                                <th>Picture</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($jurnal as $jurnals)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$jurnals->kelas}}</td>
                                <td>{{$jurnals->status}}</td>
                                <td>{{$jurnals->harga}}</td>
                                <td>{{$jurnals->fasilitas}}</td>
                                <td>
                                    @if($jurnals->picture !== null)
                                        <img src="{{asset('storage/picture_jurnals/'.$jurnals->picture)}}" width="100px">
                                    @else
                                            [Gambar Tidak Tersedia]
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jurnals" class="btn btn-success" data-toggle="modal" data-target="#edit" data-id="{{ $jurnals->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="deleteConfirmation('{{$jurnals->id}}' , '{{$jurnals->kelas}}' )">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jurnal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
@stop