@extends('dashboard')
@section('content')
@include('sweetalert::alert')
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            
        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Hasil Penilaian Rekomendasi Pegawai</h3>

                </div><!-- /.box-header -->
                
                <div class="box-body">
                <h3 class="box-title">Langkah 1 : Data Skor Penilaian</h3>
                  <table  class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Foto</th>
                        <th>Nama Lengkap</th>
                        <th>Kategori 1</th>
                        <th>Kategori 2</th>
                        <th>Kategori 3</th>
                        <th>Kategori 4</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pegawai as $items )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td><img  src="{{ asset('/fotopegawai/' . $items->foto) }}" alt="User Image" width="60px" /></td>
                        <td>{{ $items->nama_pegawai }}</td>
                        <td>{{ $items->K1 }}</td>
                        <td>{{ $items->K2 }}</td>
                        <td>{{ $items->K3 }}</td>
                        <td>{{ $items->K4 }}</td>
                    </tr>
                    @endforeach 
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
                <div class="box-body">
                <h3 class="box-title">Langkah 2 : Data Bobot Kategori</h3>
                  <table  class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Nama Kategori</th>
                        <th>Skor Bobot (%)</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($kategori as $items )
                   
                      <tr>
                        <td>{{ $no++ }}</td>
                         <td>{{ $items->nama_kategori }} </td>
                        <td>{{ $items->prosentase }} %</td>
                    </tr>
                    @endforeach 
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
                <div class="box-body">
                <h3 class="box-title">Langkah 3 : Data Skor Pembobotan</h3>
                  <table   class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Foto</th>
                        <th>Nama Lengkap</th>
                        <th>Kategori 1</th>
                        <th>Kategori 2</th>
                        <th>Kategori 3</th>
                        <th>Kategori 4</th>
                        <th>Skor Nilai</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pegawai as $items )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td><img  src="{{ asset('/fotopegawai/' . $items->foto) }}" alt="User Image" width="60px" /></td>
                        <td>{{ $items->nama_pegawai }}</td>
                        @php $B = 1; $total=0; @endphp
                        @foreach ($kategori as $items2 )
                        <td><?php $a="K".$B++;  ?>{{ (($items->$a)*($items2->prosentase))/100 }}</td>
                        <?php  $total=((($items->$a)*($items2->prosentase))/100)+$total;  ?>
                        @endforeach 
                        
                        <td>
                        <form action="updatenilai" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{ $items->id_pegawai }}" >
                        <input type="hidden" name="total" value="<?php echo $total; ?> " >
                        @csrf
                          <?php echo $total; ?> 
                        </td>
                        <td>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan </button>
                        </form>
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

    
