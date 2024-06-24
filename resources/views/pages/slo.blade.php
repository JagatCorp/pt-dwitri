@extends('dashboard')
@section('content')
    @include('sweetalert::alert')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data SLO</h3>
                        <div class="box-header" align="right">
                            <h3 class="box-title"> <button class="btn btn-block btn-primary" data-toggle="modal"
                                    data-target="#exampleModal"> + SLO</button></h3>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
                                    <th>Daya</th>
                                    <th>Harga</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($slo as $items)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $items->nama }}</td>
                                        <td>{{ $items->alamat }}</td>
                                        <td>{{ $items->daya }}</td>
                                        <td>{{ $items->rupiah }}</td>
                                        <td><button type="button" class="btn btn-success  btn-md" data-toggle="modal"
                                                data-target="#editPegawai{{ $items->id }}"><i
                                                    class="glyphicon glyphicon-pencil"></i></button>
                                            <a href="hapusslo/{{ $items->id }}"><button type="button"
                                                    class="btn btn-danger  btn-md"
                                                    onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i
                                                        class="glyphicon glyphicon-remove-circle"></i></button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
@endsection

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input NIDI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpanslo" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama </label>
                        <input type="text" name="nama" class="form-control" id="exampleFormControlInput1"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Daya</label>
                        <input type="number" name="daya" class="form-control" id="exampleFormControlInput1"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Harga</label>
                        <input type="number" name="rupiah" class="form-control" id="exampleFormControlInput1"
                            required>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan </button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($slo as $items)
    <div class="modal fade" id="editPegawai{{ $items->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="simpanslo" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $items->id }}">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama </label>
                            <input type="text" name="nama" value="{{ $items->nama }}" class="form-control"
                                id="exampleFormControlInput1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat</label>
                            <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $items->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Daya</label>
                            <input type="number" name="daya" value="{{ $items->daya }}" class="form-control"
                                id="exampleFormControlInput1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga</label>
                            <input type="number" name="rupiah" value="{{ $items->rupiah }}" class="form-control"
                                id="exampleFormControlInput1" required>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="update" class="btn btn-primary">update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
