<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Untuk Dicetak</title>
</head>
<body>
    <h1>Ini adalah dokumen untuk dicetak</h1>
    @extends('dashboard')
@section('content')
@include('sweetalert::alert')
<section class="content">
          <div class="row">
            <div class="col-xs-12">
            
        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Rekomendasi Karyawan Tetap</h3>
                  <div class="box-header">
                </div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
               
                  <table  class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Foto</th>
                        <th>Nama Lengkap</th>
                        <th>TTL</th>
                        <th>Email</th>
                        <th>Telp</th>
                        <th>Skor Akhir</th>
                        <th width="200px">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pegawai as $items )
                    <?php if($no ==1){$ket="Diterima";}else{$ket="Tidak Diterima";} ?>
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td><img  src="{{ asset('/fotopegawai/' . $items->foto) }}" alt="User Image" width="60px" /></td>
                        <td>{{ $items->nama_pegawai }}</td>
                        <td>{{ $items->tempat_lahir }} {{ $items->tgl_lahir }}</td>
                        <td>{{ $items->email }}</td>
                        <td>{{ $items->no_hp }}</td>
                        <td>{{ $items->total }}</td>
                        <td><?php echo $ket; ?></td>
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



</body>
</html>
