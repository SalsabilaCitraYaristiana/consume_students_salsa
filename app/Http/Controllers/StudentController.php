<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // mengambil data dari input search
        $search = $request->search;
        // memanggil libraries BaseApi method nya index dengan mengirim parameter1 berupa path data dari API nya, parameter2 data untuk mengisi search_nama API nya
        $data = (new BaseApi)->index('/api/students', ['search_nama' => $search]);
        // new BaseApi : memanggil libraries baseApi nya, kenapa pakai new? karena si baseApi ini bentukannya class 
        // ambil response jsonnya
        $students = $data->json();
        // kirim hasil pengambilan data ke blade index
        return view('index')->with(['students' => $students ['data']]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ];
        $proses = (new BaseApi)->store('/api/students/tambah-data', $data);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil menambahkan data baru ke students API');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // proses ambil data api ke route REST API /students/{id}
        $data = (new BaseApi)->edit('/api/students/' .$id); // titiknya buat nyambungin string sama variable
        if ($data->failed()) {
            // kalau gagal proses $data diatas, ambil deskripsi errornya dari json property data
            $errors = $data->json('data');
            // balikin ke halaman awal, sama errorsnya 
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            // kalau berhasil, ambil data dari jsonnya
            $student = $data->json(['data']);
            // alihin ke blade edit dengan mengirim data $student diatas agar bisa digunakan pada blade
            return view('edit')->with(['student' => $student]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) 
    {
        // data yg akan dikirim ($request ke REST API nya)
        $payload = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ];
        // panggil method update dari BaseApi, kirim endpoint (route update dari REST APINYA) dan data ($payload diatas)
        $proses = (new BaseApi)->update('/api/students/update/' .$id, $payload); // kenapa sebelum $id nya ada titik sesudah $id nya ada koma? titik itu buat nyatuin koma itu buat misahin, jadi misahin nilai yg pertama sama nilai yg kdua
        if ($proses->failed()) {
            // kalau gagal balikin lagi sama pesan errors dari jsonnya
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            // berhasil balikin ke halaman paling awal dengan pesan
            return redirect('/')->with('success', 'Berhasil mengubah data siswa dari API');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proses = (new BaseApi)->delete('/api/students/delete/' .$id);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil hapus data sementara dari API');
        }
    }

    public function trash()
    {
        $proses = (new BaseApi)->trash('/api/students/show/trash');
        // dd($proses);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            $studentsTrash = $proses->json('data');
            return view('trash')->with(['studentsTrash' => $studentsTrash]);
        }
    }

    public function permanent($id)
    {
        $proses = (new BaseApi)->trash('/api/students/trash/delete/permanent/' .$id);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect()->back()->with('success', 'berhasil menghapus data secara permanent');
        }
    }

    public function restore($id)
    {
        $proses = (new BaseApi)->trash('/api/students/trash/restore/' .$id);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'berhasil mengembalikan data dari sampah');
        }
    }
}
