<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        //
        return view("home");
    }
    public function cek_login(Request $request)
    {
        $username=$request->username;
        $password=$request->password;
        $cek = DB::table('users')->where('username', $username)->count();

        session()->put([
            'username' => $username
        ]);

        if($cek > 0 ){
            toast('Login berhasil', 'success');
            return redirect('user');
        }else{
            toast('Login Tidak berhasil', 'warning');
            return redirect('/');
        }

    }
    // users
    public function user()
    {
        $users = DB::table('users')->get();
        return view('pages.user', compact('users'));
    }


    public function simpanuser(Request $request)
{

    // $request->validate([
    //     'name' => 'required',
    //     'username' => 'required',
    //     'email' => 'required|email',
    //     'password' => 'nullable|min:6',
    //     'phone' => 'required',
    //     'address' => 'required',
    //     'active' => 'required',
    //     'picture' => 'nullable|mimes:doc,docx,pdf,jpg,jpeg,png|max:2000',
    // ]);

    $filename = null;
    if ($request->hasFile('picture')) {
        $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('picture')->getClientOriginalName());
        $request->file('picture')->move(public_path('fotouser'), $filename);
    }

    if ($request->has('update')) {
        $user = DB::table('users')->where('id_users', $request->id_users)->first();

        if ($user && $filename) {
            $oldPicturePath = public_path('fotouser/' . $user->picture);
            if (file_exists($oldPicturePath)) {
                unlink($oldPicturePath);
            }
        }

        $updateData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'active' => $request->active,
        ];

        if ($request->password) {
            $updateData['password'] = bcrypt($request->password);
        }

        if ($filename) {
            $updateData['picture'] = $filename;
        }

        DB::table('users')->where('id_users', $request->id_users)->update($updateData);
    } else {

        DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'picture' => $filename,
            'address' => $request->address,
            'active' => $request->active,
        ]);

    }

    // toast('Data sudah diperbaharui', 'success');
    // return redirect('user');
}


    //Hapus Menu
    public function hapususer($id)
    {
        $value = DB::table('users')->where('id_users', $id)->first();
        $logo = $value->picture;
        $image_path = public_path('fotouser/' . $logo);

        unlink($image_path);


        DB::table('users')->where('id_users', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('user');
    }

    // public function pegawai()
    // {

    //     $pegawai = DB::table('pegawai')->get();
    //     return view('pages.pegawai', compact('pegawai'));
    // }


    // public function simpanpegawai(Request $request)
    // {
    //     $request->validate([
    //         'nama_pegawai' => 'required',
    //         'tempat_lahir' => 'required',
    //         'email' => 'required',
    //         'tgl_lahir' => 'required',
	// 		'jabatan' => 'required',
	// 		'tgl_masuk' => 'required',
    //         'no_hp' => 'required',
    //         'alamat' => 'required',
    //         'status' => 'required',
    //         'foto' => 'required',
    //         'foto.*' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000',
    //     ]);
    //     if (isset($_POST['simpan'])) {
    //         $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('foto')->getClientOriginalName());
    //         $request->file('foto')->move(public_path('fotopegawai'), $filename);

    //         DB::table('pegawai')->insert([
    //             'nama_pegawai' => $request->nama_pegawai,
    //             'tempat_lahir' => $request->tempat_lahir,
    //             'email' => $request->email,
    //             'tgl_lahir' => $request->tgl_lahir,
	// 			'jabatan' => $request->jabatan,
	// 			'tgl_masuk' => $request->tgl_masuk,
    //             'no_hp' => $request->no_hp,
    //             'foto' => $filename,
    //             'alamat' => $request->alamat,
    //             'status' => $request->status,
    //         ]);

    //     } else {
    //         $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('foto')->getClientOriginalName());
    //         $request->file('foto')->move(public_path('fotopegawai'), $filename);
    //         if ($request->foto != "") {

    //             // $value=DB::select("select * from medsos where id_medsos='".$request->id."'");
    //             $value = DB::table('pegawai')->where('id_pegawai', $request->id)->first();

    //             $logo = $value->foto;
    //             $image_path = public_path('fotopegawai/' . $logo);
    //             unlink($image_path);


    //             DB::table('pegawai')->where('id_pegawai', $request->id)->update([
    //                 'nama_pegawai' => $request->nama_pegawai,
    //                 'tempat_lahir' => $request->tempat_lahir,
    //                 'email' => $request->email,
    //                 'tgl_lahir' => $request->tgl_lahir,
	// 				'jabatan' => $request->jabatan,
	// 				'tgl_masuk' => $request->tgl_masuk,
    //                 'no_hp' => $request->no_hp,
    //                 'foto' => $filename,
    //                 'alamat' => $request->alamat,
    //                 'status' => $request->status,
    //             ]);
    //         } else {
    //             DB::table('pegawai')->where('id_pegawai', $request->id)->update([
    //                 'nama_pegawai' => $request->nama_pegawai,
    //                 'tempat_lahir' => $request->tempat_lahir,
    //                 'email' => $request->email,
    //                 'tgl_lahir' => $request->tgl_lahir,
	// 				'jabatan' => $request->jabatan,
	// 				'tgl_masuk' => $request->tgl_masuk,
    //                 'no_hp' => $request->no_hp,
    //                 'alamat' => $request->alamat,
    //                 'status' => $request->status,
    //             ]);

    //         }

    //     }
    //     toast('Data sudah diperbaharui', 'success');
    //     return redirect('pegawai');
    // }
    // //Hapus Menu
    // public function hapuspegawai($id)
    // {
    //     $value = DB::table('pegawai')->where('id_pegawai', $id)->first();
    //     $logo = $value->foto;
    //     $image_path = public_path('fotopegawai/' . $logo);

    //     unlink($image_path);


    //     DB::table('pegawai')->where('id_pegawai', $id)->delete();
    //     // Alert::warning('Data Sudah diHapus');
    //     toast('Data sudah dihapus', 'success');
    //     return redirect('pegawai');
    // }

    public function kategori()
    {

        $kategori = DB::table('kategori')->get();
        return view('pages.kategori', compact('kategori'));
    }
    public function hapuskategori($id)
    {
        DB::table('kategori')->where('id', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('kategori');
    }

    public function simpankategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
			'prosentase' => 'required',
        ]);
        if (isset($_POST['simpan'])) {
            DB::table('kategori')->insert([
                'nama_kategori' => $request->nama_kategori,
				'prosentase' => $request->prosentase,
            ]);

        } else {

            DB::table('kategori')->where('id', $request->id)->update([
                'nama_kategori' => $request->nama_kategori,
				'prosentase' => $request->prosentase,
            ]);

        }
        toast('Data sudah diperbaharui', 'success');
        return redirect('kategori');
    }

    public function pegawai()
    {

        $pegawai = DB::table('tb_pegawai')->get();
        return view('pages.pegawai', compact('pegawai'));
    }
    public function hapuspegawai($id)
    {
        DB::table('tb_pegawai')->where('id', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('pegawai');
    }

    public function simpanpegawai(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required',
			'alamat' => 'required',
			'jk' => 'required',
			'no_telp' => 'required',
        ]);
        if (isset($_POST['simpan'])) {
            DB::table('tb_pegawai')->insert([
                'nama_pegawai' => $request->nama_pegawai,
				'alamat' => $request->alamat,
				'jk' => $request->jk,
				'no_telp' => $request->no_telp,
            ]);

        } else {

            DB::table('tb_pegawai')->where('id', $request->id)->update([
                'nama_pegawai' => $request->nama_pegawai,
				'alamat' => $request->alamat,
				'jk' => $request->jk,
				'no_telp' => $request->no_telp,
            ]);

        }
        toast('Data sudah diperbaharui', 'success');
        return redirect('pegawai');
    }
    //Nidi

    public function nidi()
    {

        $nidi = DB::table('tb_nidi')
                    ->join('tb_peruntukannidi', 'tb_nidi.id_peruntukan', '=', 'tb_peruntukannidi.id')
                    ->select('tb_nidi.*', 'tb_peruntukannidi.nama') // Memilih kolom yang diinginkan
                    ->get();

        $peruntukannidi = DB::table('tb_peruntukannidi')->get();
        return view('pages.nidi', compact('nidi', 'peruntukannidi'));
    }
    public function hapusnidi($id)
    {
        DB::table('tb_nidi')->where('id', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('nidi');
    }

    public function simpannidi(Request $request)
    {
        $request->validate([
            'nama' => 'required',
			'alamat' => 'required',
			'daya' => 'required',
			'tanggal' => 'required',
			'pt' => 'required',
			'sebanyak' => 'required',
			'id_peruntukan' => 'required',
			'hrg_nidi_asli' => 'required',
			'hrg_slo_asli' => 'required',
        ]);

        if (isset($_POST['simpan'])) {

            // Harga nidi setelah
            $hrg_nidi_sebanyak = $request->hrg_nidi_asli * $request->sebanyak;
            if ($request->pt == 'CIPTA MANDIRI') {
                $hrg_nidi_set = $hrg_nidi_sebanyak * 0.65;
                $hrg_nidi_set = $hrg_nidi_sebanyak - $hrg_nidi_set;
            } else {
                $hrg_nidi_set = $hrg_nidi_sebanyak;
            }

            // harga slo setelah
            $hrg_slo_sebanyak = $request->hrg_slo_asli * $request->sebanyak;
            $hrg_slo_set = $hrg_slo_sebanyak * 0.65;
            $hrg_slo_set = $hrg_slo_sebanyak - $hrg_slo_set;

            // dd($hrg_slo_set);

            DB::table('tb_nidi')->insert([
                'nama' => $request->nama,
				'alamat' => $request->alamat,
				'daya' => $request->daya,
				'tanggal' => $request->tanggal,
				'pt' => $request->pt,
				'sebanyak' => $request->sebanyak,
				'id_peruntukan' => $request->id_peruntukan,
				'hrg_nidi_asli' => $request->hrg_nidi_asli,
				'hrg_nidi_set' => $hrg_nidi_set,
				'hrg_slo_asli' => $request->hrg_slo_asli,
				'hrg_slo_set' => $hrg_slo_set,
            ]);

        } else {

            // Harga nidi setelah
            $hrg_nidi_sebanyak = $request->hrg_nidi_asli * $request->sebanyak;
            if ($request->pt == 'CIPTA MANDIRI') {
                $hrg_nidi_set = $hrg_nidi_sebanyak * 0.65;
                $hrg_nidi_set = $hrg_nidi_sebanyak - $hrg_nidi_set;
            } else {
                $hrg_nidi_set = $hrg_nidi_sebanyak;
            }

            // harga slo setelah
            $hrg_slo_sebanyak = $request->hrg_slo_asli * $request->sebanyak;
            $hrg_slo_set = $hrg_slo_sebanyak * 0.65;
            $hrg_slo_set = $hrg_slo_sebanyak - $hrg_slo_set;

            DB::table('tb_nidi')->where('id', $request->id)->update([
                'nama' => $request->nama,
				'alamat' => $request->alamat,
				'daya' => $request->daya,
				'tanggal' => $request->tanggal,
				'pt' => $request->pt,
				'sebanyak' => $request->sebanyak,
				'id_peruntukan' => $request->id_peruntukan,
				'hrg_nidi_asli' => $request->hrg_nidi_asli,
				'hrg_nidi_set' => $hrg_nidi_set,
				'hrg_slo_asli' => $request->hrg_slo_asli,
				'hrg_slo_set' => $hrg_slo_set,
            ]);

        }
        toast('Data sudah diperbaharui', 'success');
        return redirect('nidi');
    }

    public function slo()
    {

        $slo = DB::table('tb_slo')->get();
        return view('pages.slo', compact('slo'));
    }
    public function hapusslo($id)
    {
        DB::table('tb_slo')->where('id', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('slo');
    }

    public function simpanslo(Request $request)
    {
        $request->validate([
            'nama' => 'required',
			'alamat' => 'required',
			'daya' => 'required',
			'rupiah' => 'required',
        ]);
        if (isset($_POST['simpan'])) {
            DB::table('tb_slo')->insert([
                'nama' => $request->nama,
				'alamat' => $request->alamat,
				'daya' => $request->daya,
				'rupiah' => $request->rupiah,
            ]);

        } else {

            DB::table('tb_slo')->where('id', $request->id)->update([
                'nama' => $request->nama,
				'alamat' => $request->alamat,
				'daya' => $request->daya,
				'rupiah' => $request->rupiah,
            ]);

        }
        toast('Data sudah diperbaharui', 'success');
        return redirect('slo');
    }
    public function jenisjasa()
    {

        $jenisjasa = DB::table('tb_jenisjasa')->get();
        return view('pages.jenisjasa', compact('jenisjasa'));
    }
    public function hapusjenisjasa($id)
    {
        DB::table('tb_jenisjasa')->where('id', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('jenisjasa');
    }

    public function simpanjenisjasa(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        if (isset($_POST['simpan'])) {
            DB::table('tb_jenisjasa')->insert([
                'nama' => $request->nama,
            ]);

        } else {

            DB::table('tb_jenisjasa')->where('id', $request->id)->update([
                'nama' => $request->nama,
            ]);

        }
        toast('Data sudah diperbaharui', 'success');
        return redirect('jenisjasa');
    }


    public function peruntukannidi()
    {

        $peruntukannidi = DB::table('tb_peruntukannidi')->get();
        return view('pages.peruntukannidi', compact('peruntukannidi'));
    }
    public function hapusperuntukannidi($id)
    {
        DB::table('tb_peruntukannidi')->where('id', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('peruntukannidi');
    }

    public function simpanperuntukannidi(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        if (isset($_POST['simpan'])) {
            DB::table('tb_peruntukannidi')->insert([
                'nama' => $request->nama,
            ]);

        } else {

            DB::table('tb_peruntukannidi')->where('id', $request->id)->update([
                'nama' => $request->nama,
            ]);

        }
        toast('Data sudah diperbaharui', 'success');
        return redirect('peruntukannidi');
    }

    public function jenispengadaan()
    {

        $jenispengadaan = DB::table('tb_jenispengadaan')->get();
        return view('pages.jenispengadaan', compact('jenispengadaan'));
    }
    public function hapusjenispengadaan($id)
    {
        DB::table('tb_jenispengadaan')->where('id', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('jenispengadaan');
    }

    public function simpanjenispengadaan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        if (isset($_POST['simpan'])) {
            DB::table('tb_jenispengadaan')->insert([
                'nama' => $request->nama,
            ]);

        } else {

            DB::table('tb_jenispengadaan')->where('id', $request->id)->update([
                'nama' => $request->nama,
            ]);

        }
        toast('Data sudah diperbaharui', 'success');
        return redirect('jenispengadaan');
    }
    public function pengadaan()
    {

        $pengadaan = DB::table('tb_pengadaan')->get();
        return view('pages.pengadaan', compact('pengadaan'));
    }
    public function hapuspengadaan($id)
    {
        DB::table('tb_pengadaan')->where('id', $id)->delete();
        // Alert::warning('Data Sudah diHapus');
        toast('Data sudah dihapus', 'success');
        return redirect('pengadaan');
    }

    public function simpanpengadaan(Request $request)
    {
        $request->validate([
            'jenis_pengadaan_id' => 'required',
			'nilai_pengadaan' => 'required',
			'margin_pengadaan' => 'required',
			'pajak' => 'required',
        ]);
        if (isset($_POST['simpan'])) {
            DB::table('tb_pengadaan')->insert([
                'jenis_pengadaan_id' => $request->jenis_pengadaan_id,
				'nilai_pengadaan' => $request->nilai_pengadaan,
				'margin_pengadaan' => $request->margin_pengadaan,
				'pajak' => $request->pajak,
            ]);

        } else {

            DB::table('tb_pengadaan')->where('id', $request->id)->update([
                  'jenis_pengadaan_id' => $request->jenis_pengadaan_id,
				'nilai_pengadaan' => $request->nilai_pengadaan,
				'margin_pengadaan' => $request->margin_pengadaan,
				'pajak' => $request->pajak,
            ]);

        }
        toast('Data sudah diperbaharui', 'success');
        return redirect('pengadaan');
    }



}
