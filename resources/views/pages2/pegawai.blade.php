@extends('dashboard')
@section('content')
@include('sweetalert::alert')
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            
        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Karyawan  Perusahaan</h3>
                  <div class="box-header" align="right">
                  <h3 class="box-title"> <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal"> + Pegawai</button></h3>
                </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
               
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Foto</th>
                        <th>Nama Lengkap</th>
                        <th>TTL</th>
                        <th>Email</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Jabatan</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th width="100px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pegawai as $items )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td><img  src="{{ asset('/fotopegawai/' . $items->foto) }}" alt="User Image" width="60px" /></td>
                        <td>{{ $items->nama_pegawai }}</td>
                        <td>{{ $items->tempat_lahir }} {{ $items->tgl_lahir }}</td>
                        <td>{{ $items->email }}</td>
                        <td>{{ $items->no_hp }}</td>
                        <td>{{ $items->alamat }}</td>
                        <td>{{ $items->jabatan }}</td>
                        <td>{{ $items->tgl_masuk }}</td>
                        <td>{{ $items->status }}</td>
                        <td><button type="button" class="btn btn-success  btn-md" data-toggle="modal" data-target="#editPegawai{{ $items->id_pegawai }}"><i class="glyphicon glyphicon-pencil"></i></button>
                  <a href="hapususer/{{ $items->id_pegawai }}"><button type="button" class="btn btn-danger  btn-md" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i class="glyphicon glyphicon-remove-circle"></i></button></a></td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Input Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="simpanpegawai" method="POST" enctype="multipart/form-data">
       @csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Nama Lengkap</label>
    <input type="text" name="nama_pegawai" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Tempat Lahir</label>
    <input type="text" name="tempat_lahir" class="form-control" id="exampleFormControlInput1"  required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Tanggal Lahir</label>
    <input type="date" name="tgl_lahir" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Tanggal Masuk</label>
    <input type="date" name="tgl_masuk" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">No Hp</label>
    <input type="text" name="no_hp" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Jabatan</label>
    <input type="text" name="jabatan" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="text" name="email" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Alamat</label>
    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Foto</label>
    <input type="file" name="foto" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Status</label>
    <select name="status" multiple class="form-control" id="exampleFormControlSelect1">
      <option value="Y">Training</option>
      <option value="N">THL</option>
    </select>
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

@foreach ($pegawai as $items )
<div class="modal fade" id="editPegawai{{ $items->id_pegawai }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="simpanpegawai" method="POST" enctype="multipart/form-data">
       @csrf
       <input type="hidden" name="id" value="{{ $items->id_pegawai }}" >
       <div class="form-group">
    <label for="exampleFormControlInput1">Nama Lengkap</label>
    <input type="text" name="nama_pegawai" value="{{ $items->nama_pegawai }}" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Tempat Lahir</label>
    <input type="text" name="tempat_lahir" value="{{ $items->tempat_lahir }}" class="form-control" id="exampleFormControlInput1"  required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Tanggal Lahir</label>
    <input type="date" name="tgl_lahir" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Tanggal Masuk</label>
    <input type="date" name="tgl_masuk" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">No Hp</label>
    <input type="text" name="no_hp" value="{{ $items->no_hp }}" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Jabatan</label>
    <input type="text" name="jabatan" value="{{ $items->jabatan }}" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="text" name="email" value="{{ $items->email }}" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Alamat</label>
    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"> {{ $items->alamat }}</textarea>
  </div>
  <div class="form-group">
  <br>
    <img  src="{{ asset('/fotopegawai/' . $items->foto) }}" alt="User Image" width="60px" /><br>
    
    <label for="exampleFormControlInput1">Foto</label>
    <input type="file" name="foto" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Status</label>
    <select name="status" multiple class="form-control" id="exampleFormControlSelect1">
      <option value="Y">Training</option>
      <option value="N">THL</option>
    </select>
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