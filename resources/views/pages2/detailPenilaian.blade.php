@extends('dashboard')
@section('content')
@include('sweetalert::alert')
<?php use Illuminate\Support\Facades\DB; ?>
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            
        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Isian Penilaian Karyawan</h3>
                  <div class="box-header">
                 
                </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <form action="simpan_detail" method="POST" enctype="multipart/form-data">
                @csrf
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Detail Penilaian</th>
                        <!-- <th>Skor Nilai</th> -->
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
                        <td>
                        
                        <input type="hidden" name="id_soal[]" value="{{ $items->id_soal }}" >
                        <input type="hidden" name="id_kategori[]" value="{{ $items->id_kategori }}" >
                        <input type="hidden" name="id_pegawai[]" value="<?php echo $id_pegawai; ?>" >
                <div class="form-check">
                <input class="form-check-input" type="radio" name="nilai<?php echo $items->id_soal; ?>" id="exampleRadios1" value="20" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Selalu (20)
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="nilai<?php echo $items->id_soal; ?>" id="exampleRadios1" value="15" >
                <label class="form-check-label" for="exampleRadios1">
                    Sering  (15)
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="nilai<?php echo $items->id_soal; ?>" id="exampleRadios1" value="10" >
                <label class="form-check-label" for="exampleRadios1">
                    Kadang-kadang (10)
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="nilai<?php echo $items->id_soal; ?>" id="exampleRadios2" value="5">
                <label class="form-check-label" for="exampleRadios2">
                    Tidak Pernah (5)
                </label>
                </div>
</td></tr>
                    @endforeach 
                    <tr><td colspan="2">Simpan Jawaban</td><td><button type="submit" name="simpan" class="btn btn-primary">Simpan </button></td></tr>
                    </tbody>
                </form>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        @endsection

        <!-- Button trigger modal -->

