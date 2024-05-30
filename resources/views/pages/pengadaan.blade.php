@extends('dashboard')
@section('content')
@include('sweetalert::alert')
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            
        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pengadaan  Perusahaan</h3>
                  <div class="box-header" align="right">
                  <h3 class="box-title"> <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal"> + Pengadaan</button></h3>
                </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
               
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Jenis</th>
                        <th>Nilai Pengadaan</th>
                        <th>Margin</th>
                        <th>Pajak</th>
                        <th width="100px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pengadaan as $items )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $items->jenis_pengadaan_id }}</td>
                        <td>{{ $items->nilai_pengadaan }}</td>
                        <td>{{ $items->margin_pengadaan }}</td>
                        <td>{{ $items->pajak }}</td>
                        <td><button type="button" class="btn btn-success  btn-md" data-toggle="modal" data-target="#editPengadaan{{ $items->id }}"><i class="glyphicon glyphicon-pencil"></i></button>
                  <a href="hapuspengadaan/{{ $items->id }}"><button type="button" class="btn btn-danger  btn-md" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i class="glyphicon glyphicon-remove-circle"></i></button></a></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Form Input Pengadaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="simpanpengadaan" method="POST" enctype="multipart/form-data">
       @csrf
       <div class="form-group">
        <label for="exampleFormControlSelect1">Nama Jenis Pengadaan</label>
        <select name="jenis_pengadaan_id" multiple class="form-control" id="exampleFormControlSelect1">
        <?php $menu = DB::table('tb_jenispengadaan')                
                ->get();
            foreach ($menu as $key => $value) {
            
            ?>
        <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
    <?php } ?>
        </select>
    </div>
  

  <div class="form-group">
    <label for="exampleFormControlInput1">Nilai Pengadaan</label>
    <input type="text" name="nilai_pengadaan" class="form-control" id="exampleFormControlInput1"  required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Margin Pengadaan</label>
    <input type="text" name="margin_pengadaan" class="form-control" id="exampleFormControlInput1"  required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Pajak Pengadaan</label>
    <input type="text" name="pajak" class="form-control" id="exampleFormControlInput1"  required>
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

@foreach ($pengadaan as $items )
<div class="modal fade" id="editPengadaan{{ $items->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Pengadaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="simpanpengadaan" method="POST" enctype="multipart/form-data">
       @csrf
       <input type="hidden" name="id" value="{{ $items->id }}" >
       <div class="form-group">
        <label for="exampleFormControlInput1">Nama Lengkap</label>
        <input type="text" name="jenis_pengadaan_id" value="{{ $items->jenis_pengadaan_id }}" class="form-control" id="exampleFormControlInput1" required >
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Nilai Pengadaan</label>
        <textarea name="nilai_pengadaan" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $items->nilai_pengadaan }}</textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
        <select name="margin_pengadaan" multiple class="form-control" id="exampleFormControlSelect1">
          <option value="L">Laki-laki</option>
          <option value="P">Perempuan</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1">Pajak</label>
        <input type="text" name="pajak" value="{{ $items->pajak }}" class="form-control" id="exampleFormControlInput1"  required>
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