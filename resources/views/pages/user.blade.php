@extends('dashboard')
@section('content')
@include('sweetalert::alert')
<section class="content">
          <div class="row">
            <div class="col-xs-12">


              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Users/Pengguna</h3>
                  <div class="box-header" align="right">
                  <h3 class="box-title"> <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal"> + Users</button></h3>
                </div>
                </div><!-- /.box-header -->

                <div class="box-body">

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>Foto</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($users as $items )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td><img  src="{{ asset('/fotouser/' . $items->picture) }}" alt="User Image" width="60px" /></td>
                        <td>{{ $items->name }}</td>
                        <td>{{ $items->username }}</td>
                        <td>{{ $items->email }}</td>
                        <td>{{ $items->phone }}</td>
                        <td>{{ $items->address }}</td>
                        <td>{{ $items->active }}</td>
                        <td>
                        <button type="button" class="btn btn-success  btn-md" data-toggle="modal" data-target="#editUsers{{ $items->id_users }}">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </button>

                        @if(session('user')->id_users != $items->id_users)
                            <a href="hapususer/{{ $items->id_users }}"><button type="button" class="btn btn-danger  btn-md" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i class="glyphicon glyphicon-remove-circle"></i></button></a></td>
                        @endif
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
        <h5 class="modal-title" id="exampleModalLabel">Form Input Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="simpanuser" method="POST" enctype="multipart/form-data">
       @csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Nama Lengkap</label>
    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Username</label>
    <input type="text" name="username" class="form-control" id="exampleFormControlInput1"  required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Password</label>
    <input type="text" name="password" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Telp</label>
    <input type="number" name="phone" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Alamat</label>
    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Foto</label>
    <input type="file" name="picture" class="form-control" id="exampleFormControlInput1" required >
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Status</label>
    <select name="active" multiple class="form-control" id="exampleFormControlSelect1">
      <option value="Y">Aktif</option>
      <option value="N">Tidak Aktif</option>
    </select>
  </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

@foreach ($users as $items)
<div class="modal fade" id="editUsers{{ $items->id_users }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/simpanuser" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_users" value="{{ $items->id_users }}">
        <div class="form-group">
          <label for="exampleFormControlInput1">Nama Lengkap</label>
          <input type="text" name="name" value="{{ $items->name }}" class="form-control" id="exampleFormControlInput1" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Username</label>
          <input type="text" name="username" value="{{ $items->username }}" class="form-control" id="exampleFormControlInput1" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Email</label>
          <input type="email" name="email" value="{{ $items->email }}" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Telp</label>
          <input type="number" name="phone" value="{{ $items->phone }}" class="form-control" id="exampleFormControlInput1" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Alamat</label>
          <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $items->address }}</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Foto</label><br>
          <img src="{{ asset('/fotouser/' . $items->picture) }}" alt="User Image" width="60px"><br>
          <input type="file" name="picture" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Status</label>
          <select name="active" class="form-control" id="exampleFormControlSelect1">
            <option value="Y" {{ $items->active == 'Y' ? 'selected' : '' }}>Aktif</option>
            <option value="N" {{ $items->active == 'N' ? 'selected' : '' }}>Tidak Aktif</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endforeach

