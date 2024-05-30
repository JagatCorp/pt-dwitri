@extends('dashboard')
@section('content')
@include('sweetalert::alert')
<?php use Illuminate\Support\Facades\DB; ?>
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            
        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Nilai Kriteria</h3>
                  <div class="box-header" align="right">
                  <h3 class="box-title"> <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal"> + Nilai Kriteria</button></h3>
                </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
               
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Detail Kriteria</th>
                        <!-- <th>Nilai Kriteria</th> -->
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($soal as $items )
                      <tr>
                        <td>{{ $no++ }}</td>
                       <td>{{ $items->deskripsi_soal }}</td>
                        <!-- <td>{{ $items->skor_nilai }}</td> -->
                        <td><button type="button" class="btn btn-success  btn-md" data-toggle="modal" data-target="#editPegawai{{ $items->id_soal }}"><i class="glyphicon glyphicon-pencil"></i></button>
                  <a href="hapussoal/{{ $items->id_soal }}"><button type="button" class="btn btn-danger  btn-md" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i class="glyphicon glyphicon-remove-circle"></i></button></a></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Form Input Penilaian Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="simpansoal" method="POST" enctype="multipart/form-data">
       @csrf
        <div class="form-group">
            <label for="exampleFormControlSelect1">Kategori Penilaian</label>
            <select name="id_kategori" multiple class="form-control" id="exampleFormControlSelect1">
            <?php $menu=DB::table('kategori')->get();
                foreach ($menu as $key => $value) {
                   
                ?>
            <option value="<?php echo $value->id ?>"><?php echo $value->nama_kategori ?></option>
           <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Detail Penilaian Kriteria</label>
            <input type="text" name="deskripsi_soal" class="form-control" id="exampleFormControlInput1" required >
        </div>
        
        <div class="form-group">
            <label for="exampleFormControlInput1">Skor Kriteria</label>
            <input type="text" name="skor_nilai" class="form-control" id="exampleFormControlInput1" required >
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

@foreach ($soal as $items )
<div class="modal fade" id="editPegawai{{ $items->id_soal }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Penilaian Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="simpansoal" method="POST" enctype="multipart/form-data">
       @csrf
       <input type="hidden" name="id" value="{{ $items->id_soal }}" >
       <div class="form-group">
            <label for="exampleFormControlSelect1">Kriteria Penilaian</label>
            <select name="id_kategori" multiple class="form-control" id="exampleFormControlSelect1">
            <option value="<?php echo $items->id ?>" selected><?php echo $items->nama_kategori ?></option>
            <?php $menu=DB::table('kategori')->get();
                foreach ($menu as $key => $value) {
                   
                ?>
            <option value="<?php echo $value->id ?>"><?php echo $value->nama_kategori ?></option>
           <?php } ?>
            </select>
        </div>
       <div class="form-group">
            <label for="exampleFormControlInput1">Detail Penilaian Kriteria</label>
            <input type="text" name="deskripsi_soal" value="{{ $items->deskripsi_soal }}" class="form-control" id="exampleFormControlInput1" required >
        </div>
        
        <div class="form-group">
            <label for="exampleFormControlInput1">Skor Kriteria</label>
            <input type="text" name="skor_nilai" value="{{ $items->skor_nilai }}" class="form-control" id="exampleFormControlInput1" required >
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