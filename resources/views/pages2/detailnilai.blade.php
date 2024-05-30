@extends('dashboard')
@section('content')
@include('sweetalert::alert')
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            
        
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Form Penilain Pegawai</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="simpanpenilaian" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                  <div class="form-group">
                        <label for="exampleFormControlSelect1">Nama Pegawai</label>
                        <select name="id_pegawai" multiple class="form-control" id="exampleFormControlSelect1">
                        <?php $menu=DB::table('pegawai')->get();
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

      