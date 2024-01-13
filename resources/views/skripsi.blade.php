@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Kelola Skripsi</h1>
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
                                Tambah Data Skripsi
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
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Abstrak</th>
                                <th>Keterangan</th>
                                <th>Rilis</th>
                                <th>Halaman</th>
                                <th>File</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($skripsi as $skripsis)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$skripsis->judul}}</td>
                                <td>{{$skripsis->penulis}}</td>
                                <td>{{$skripsis->abstrak}}</td>
                                <td>{{$skripsis->keterangan}}</td>
                                <td>{{$skripsis->rilis}}</td>
                                <td>{{$skripsis->halaman}}</td>
                                <td>
                                    <a href="{{ route('pdf.show', ['id' => $skripsis->id]) }}"  target="_blank">
                                        <button  class="btn btn-success"> Tampilkan PDF </button>
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-skripsi" class="btn btn-success" data-toggle="modal" data-target="#edit" data-id="{{ $skripsis->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="deleteConfirmation('{{$skripsis->id}}' , '{{$skripsis->judul}}' )">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Skripsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="post" action="{{ route('tambah.skripsi')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" name="penulis" id="penulis">
                        </div>
                        <div class="form-group">
                            <label for="abstrak">Abstrak</label>
                            <input type="text" class="form-control" name="abstrak" id="abstrak">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan">
                        </div>
                        <div class="d-flex" style="margin: -7px">
                            <div class="form-group col-md-6">
                                <label for="rilis">Rilis</label>
                                <input type="text" class="form-control" name="rilis" id="rilis" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="halaman">Halaman</label>
                                <input type="text" class="form-control" name="halaman" id="halaman" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file">Pilih File</label>
                            <input type="file" class="form-control" style="padding-bottom: 37px" name="file" id="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Skripsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="post" action="{{ route('ubah.skripsi')}}" enctype="multipart/form-data">
                    @csrf
                    @method ('PATCH')
                    <div class="modal-body">
                        <input type="text" class="form-control" name="id" id="edit-id" hidden>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="edit-judul" required>
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" name="penulis" id="edit-penulis">
                        </div>
                        <div class="form-group">
                            <label for="abstrak">Abstrak</label>
                            <input type="text" class="form-control" name="abstrak" id="edit-abstrak">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="edit-keterangan">
                        </div>
                        <div class="d-flex" style="margin: -7px">
                            <div class="form-group col-md-6">
                                <label for="rilis">Rilis</label>
                                <input type="text" class="form-control" name="rilis" id="edit-rilis" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="halaman">Halaman</label>
                                <input type="text" class="form-control" name="halaman" id="edit-halaman" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file">Pilih File</label>
                            <input type="file" class="form-control" style="padding-bottom: 37px" name="file" id="edit-file">
                            <div class="form-group" id="image-area"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="old_file" id="edit-old-file"/>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')

<script>
        $(function(){
            $(document).on('click','#btn-edit-skripsi', function(){
                let id = $(this).data('id');
                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url: "{{url('/admin/ajaxadmin/dataSkripsi')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                        $('#edit-judul').val(res.judul);
                        $('#edit-penulis').val(res.penulis);
                        $('#edit-abstrak').val(res.abstrak);
                        $('#edit-id').val(res.id);
                        $('#edit-keterangan').val(res.keterangan);
                        $('#edit-rilis').val(res.rilis);
                        $('#edit-volume').val(res.volume);
                        $('#edit-halaman').val(res.halaman);
                        $('#edit-old-file').val(res.file);

                        if (res.file !== null) {
                            $('#image-area').append('[File tersedia]');
                        } else {
                            $('#image-area').append('[File tidak tersedia]');
                        }
                    },
                });
            });
        });

        function deleteConfirmation(id,judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus Skripsi dengan Judul " +judul+"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",

            }).then (function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'GET',
                        url: "{{url('/admin/skripsi/hapus')}}/"+id,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                setTimeout(function(){
                                    location.reload();
                                },1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
</script>
@stop