@extends('dashboard')
@section('content')
    @include('sweetalert::alert')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Karyawan Perusahaan</h3>
                        <div class="box-header" align="right">
                            <h3 class="box-title"> <button class="btn btn-block btn-primary" data-toggle="modal"
                                    data-target="#exampleModal"> + Nidi</button></h3>
                            <form action="{{ route('export.nidi') }}" method="GET" style="display:inline-block;">
                                <input type="date" name="start_date" required>
                                <input type="date" name="end_date" required>
                                <button type="submit" class="btn btn-block btn-success">Export Excel</button>
                            </form>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Daya</th>
                                    <th>Tanggal</th>
                                    <th>PT</th>
                                    <th>Sebanyak</th>
                                    <th>Peruntukan</th>
                                    <th>Harga NIDI (asli)</th>
                                    <th>Harga NIDI (setelah)</th>
                                    <th>Harga SLO (asli)</th>
                                    <th>Harga SLO (setelah)</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($nidi as $items)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $items->nama }}</td>
                                        <td>{{ $items->alamat }}</td>
                                        <td>{{ $items->daya }}</td>
                                        <td>{{ $items->tanggal }}</td>
                                        <td>{{ $items->pt }}</td>
                                        <td>{{ $items->sebanyak }}</td>
                                        {{-- nama dari table peruntukannidi --}}
                                        <td>{{ $items->peruntukan_nama }}</td>
                                        <td>{{ number_format($items->hrg_nidi_asli, 0, ',', '.') }}</td>
                                        <td>{{ number_format($items->hrg_nidi_set, 0, ',', '.') }}</td>
                                        <td>{{ number_format($items->hrg_slo_asli, 0, ',', '.') }}</td>
                                        <td>{{ number_format($items->hrg_slo_set, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($items->id == $nidi_terakhir->id && $isNidiEdit)
                                                {{-- <button type="button" class="btn btn-success  btn-md" data-toggle="modal"
                                                    data-target="#editPegawai{{ $items->id }}">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </button> --}}
                                                <a href="hapusnidi/{{ $items->id }}">
                                                    <button type="button" class="btn btn-danger  btn-md"
                                                        onclick="return confirm('Apakah Anda Yakin Menghapus Data?');">
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
                <h5 class="modal-title" id="exampleModalLabel">Form Input NIDI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpannidi" method="POST" enctype="multipart/form-data">
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
                        <label for="exampleFormControlInput1">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="exampleFormControlInput1"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">PT</label>
                        <select name="pt" class="form-control" id="exampleFormControlInput1" required>
                            <option value="">Pilih PT</option>
                            <option value="DWITRI">DWITRI</option>
                            <option value="CIPTA MANDIRI">CIPTA MANDIRI</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Sebanyak</label>
                        <input type="number" name="sebanyak" class="form-control" id="exampleFormControlInput1"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Peruntukan</label>
                        <select name="id_peruntukan" class="form-control" id="exampleFormControlInput1" required>
                            <option value="">Pilih Peruntukan</option>
                            @foreach ($peruntukannidi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Transfer BNI</label>
                        <select name="is_bank" class="form-control" id="exampleFormControlInput1" required>
                            {{-- <option value="">Semua</option> --}}
                            <option value="1">Ya</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Harga NIDI Asli</label>
                        <input type="number" name="hrg_nidi_asli" class="form-control" id="exampleFormControlInput1"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Harga SLO Asli</label>
                        <input type="number" name="hrg_slo_asli" class="form-control" id="exampleFormControlInput1"
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

@foreach ($nidi as $items)
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
                    <form action="simpannidi" method="POST" enctype="multipart/form-data">
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
                            <label for="exampleFormControlInput1">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $items->tanggal }}" class="form-control"
                                id="exampleFormControlInput1" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">PT</label>
                            <select name="pt" class="form-control" id="exampleFormControlInput1" required>
                                <option value="">Pilih PT</option>
                                <option value="DWITRI" {{ $items->pt == 'DWITRI' ? 'selected' : '' }}>DWITRI</option>
                                <option value="CIPTA MANDIRI" {{ $items->pt == 'CIPTA MANDIRI' ? 'selected' : '' }}>
                                    CIPTA MANDIRI</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Sebanyak</label>
                            <input type="number" name="sebanyak" value="{{ $items->sebanyak }}"
                                class="form-control" id="exampleFormControlInput1" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">ID Peruntukan</label>
                            <select name="id_peruntukan" class="form-control" id="exampleFormControlInput1" required>
                                <option value="">Pilih Peruntukan</option>
                                @foreach ($peruntukannidi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $items->id_peruntukan == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga NIDI Asli</label>
                            <input type="number" name="hrg_nidi_asli" value="{{ $items->hrg_nidi_asli }}"
                                class="form-control" id="exampleFormControlInput1" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga SLO Asli</label>
                            <input type="number" name="hrg_slo_asli" value="{{ $items->hrg_slo_asli }}"
                                class="form-control" id="exampleFormControlInput1" required>
                        </div>

                        {{-- <div class="form-group">
    <label for="exampleFormControlInput1">Harga</label>
    <input type="number" name="rupiah" value="{{ $items->rupiah }}" class="form-control" id="exampleFormControlInput1"  required>
  </div> --}}


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
