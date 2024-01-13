@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Kelola Mahasiswa</h1>
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
                                Tambah Data Mahasiswa
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
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Tanggal Lahir</th>
                                <th>Angkatan</th>
                                <th>Prodi</th>
                                <th>Jurusan</th>
                                <th>Alamat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach($mahasiswa as $mahasiswas)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$mahasiswas->nama}}</td>
                                <td>{{$mahasiswas->npm}}</td>
                                <td>{{$mahasiswas->tanggalLahir}}</td>
                                <td>{{$mahasiswas->angkatan}}</td>
                                <td>{{$mahasiswas->programStudi}}</td>
                                <td>{{$mahasiswas->jurusan}}</td>
                                <td>{{$mahasiswas->alamat}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-mahasiswa" class="btn btn-success" data-toggle="modal" data-target="#edit" data-id="{{ $mahasiswas->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="deleteConfirmation('{{$mahasiswas->id}}' , '{{$mahasiswas->nama}}' )">
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('tambah.mahasiswa')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-md-6">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control" name="npm" id="npm" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggalLahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-md-6">
                                <label for="angkatan">Angkatan</label>
                                <input type="text" class="form-control" name="angkatan" id="angkatan" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="programStudi">Program Studi</label>
                                <input type="text" class="form-control" name="programStudi" id="programStudi" required>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-md-6">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" class="form-control" name="jurusan" id="jurusan" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" required>
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form method="post" action="{{ route('ubah.mahasiswa')}}" enctype="multipart/form-data">
                    @csrf
                    @method ('PATCH')
                    <div class="modal-body">
                        <input type="text" class="form-control" name="id" id="edit-id" required>
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" id="edit-name" required>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-md-6">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control" name="npm" id="edit-npm" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggalLahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggalLahir" id="edit-tanggalLahir" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="edit-email" required>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-md-6">
                                <label for="angkatan">Angkatan</label>
                                <input type="text" class="form-control" name="angkatan" id="edit-angkatan" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="programStudi">Program Studi</label>
                                <input type="text" class="form-control" name="programStudi" id="edit-programStudi" required>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-md-6">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" class="form-control" name="jurusan" id="edit-jurusan" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="edit-alamat" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
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
            $(document).on('click','#btn-edit-mahasiswa', function(){
                let id = $(this).data('id');
                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url: "{{url('/admin/ajaxadmin/dataMahasiswa')}}/"+id,
                    dataType: 'json',
                    success: function(res){
                        $('#edit-name').val(res.nama);
                        $('#edit-email').val(res.email);
                        $('#edit-alamat').val(res.alamat);
                        $('#edit-id').val(res.id);
                        $('#edit-npm').val(res.npm);
                        $('#edit-angkatan').val(res.angkatan);
                        $('#edit-tanggalLahir').val(res.tanggalLahir);
                        $('#edit-jurusan').val(res.jurusan);
                        $('#edit-programStudi').val(res.programStudi);
                    },
                });
            });
        });

        function deleteConfirmation(id,nama) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data dengan Nama " +nama+"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",

            }).then (function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'GET',
                        url: "{{url('/admin/mahasiswa/hapus')}}/"+id,
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