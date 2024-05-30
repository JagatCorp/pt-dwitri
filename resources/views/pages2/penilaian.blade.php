@extends('dashboard')
@section('content')
@include('sweetalert::alert')
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            
        
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Form Penilaian Karyawan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Tahun Masuk</label>
                    <select name="tahun"  class="form-control" id="exampleFormControlSelect1">
                      <?php for ($i=2020; $i<2030; $i++){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                </div>
                </div>
                <!-- form start -->
                <form action="detail_penilaian" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="box-body">
                  <div class="form-group">
                        <label for="exampleFormControlSelect1">Nama Karyawan Belum Penilaian</label>
                        <select name="id_pegawai" multiple class="form-control" id="exampleFormControlSelect1">
                        <?php $menu = DB::table('pegawai')
                                ->where('status', 'N')
                                ->get();
                            foreach ($menu as $key => $value) {
                            
                            ?>
                        <option value="<?php echo $value->id_pegawai ?>"><?php echo $value->nama_pegawai ?></option>
                    <?php } ?>
                        </select>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        @endsection

      