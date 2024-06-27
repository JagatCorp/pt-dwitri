@extends('dashboard')
@section('content')
    @include('sweetalert::alert')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Transkaksi Keuangan Perusahaan</h3>
                        <div class="box-header" align="right">
                            <h3 class="box-title">
                                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal"> + Peruntukan Nidi</button>
                            </h3>
                        </div>
                        <div align="right">
                            <form action="{{ route('export-transaksi-keuangan') }}" method="GET" class="form-inline">
                                <div class="form-group">
                                    <label for="start_date">Dari Tanggal:</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">Sampai Tanggal:</label>
                                    <input type="date" name="end_date" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success">Export to Excel</button>
                            </form>
                        </div>
                        <h3>SALDO : Rp. {{ number_format($transaksi_keuangan_terakhir->saldo_akhir, 0, ',', '.') }}</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Tanggal </th>
                                    <th>Keterangan </th>
                                    <th>Penerimaan </th>
                                    <th>Pemasukan </th>
                                    <th>Saldo </th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transaksi_keuangan as $items)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $items->tanggal }}</td>
                                        <td>{{ $items->keterangan }}</td>
                                        <td>{{ $items->status == 'penerimaan' ? $items->jml_transaksi : 0 }}</td>
                                        <td>{{ $items->status == 'pengeluaran' ? $items->jml_transaksi : 0 }}</td>
                                        <td>{{ $items->saldo_akhir }}</td>
                                        <td>
                                            @if ($transaksi_keuangan_terakhir->id == $items->id)
                                                @if($items->id_relasi == null)
                                                    <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#editPegawai{{ $items->id }}">
                                                        <i class="glyphicon glyphicon-pencil"></i>
                                                    </button>
                                                @endif
                                                <a href="hapustransaksi_keuangan/{{ $items->id }}">
                                                    <button type="button" class="btn btn-danger btn-md" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');">
                                                        <i class="glyphicon glyphicon-remove-circle"></i>
                                                    </button>
                                                </a>
                                            @endif
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
                <h5 class="modal-title" id="exampleModalLabel">Form Input Peruntukan Nidi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpantransaksi_keuangan" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- saldo akhir --}}
                    <input type="hidden" name="saldo_awal" class="form-control" id="exampleFormControlInput1"
                        value="{{ $transaksi_keuangan_terakhir->saldo_akhir }}" required>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal </label>
                        <input type="datetime-local" name="tanggal" class="form-control" id="exampleFormControlInput1" required >
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Keterangan </label>
                        <textarea name="keterangan" class="form-control" id="exampleFormControlInput1" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Status </label>
                        <select name="status" id="" class="form-control">
                            <option value="penerimaan">Penerimaan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Jumlah Transaksi </label>
                        <input type="number" name="jml_transaksi" class="form-control" id="exampleFormControlInput1"
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

@foreach ($transaksi_keuangan as $items)
    <div class="modal fade" id="editPegawai{{ $items->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Peruntukan Nidi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="simpantransaksi_keuangan" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $items->id }}">

                        <input type="hidden" name="saldo_awal" class="form-control" id="exampleFormControlInput1"
                            value="{{ $items->saldo_awal }}" required>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal </label>
                            <input type="datetime-local" name="tanggal" class="form-control"
                                value="{{ $items->tanggal }}"
                                id="exampleFormControlInput1" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Keterangan </label>
                            <textarea name="keterangan" class="form-control" id="exampleFormControlInput1" required>{{ $items->keterangan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Status </label>
                            <select name="status" id="" class="form-control">
                                <option value="penerimaan" {{ $items->status == 'penerimaan' ? 'selected' : '' }}>Penerimaan</option>
                                <option value="pengeluaran" {{ $items->status == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jumlah Transaksi </label>
                            <input type="number" name="jml_transaksi" class="form-control"
                                value="{{ $items->jml_transaksi }}"
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
