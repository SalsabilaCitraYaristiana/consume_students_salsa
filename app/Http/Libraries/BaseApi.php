<?php
// perbedaan helpers dan libraries
// helpers = bikin API
// libraries = pake API, methodnya lebih dari satu
namespace App\Http\Libraries;

use Illuminate\Support\Facades\Http;

class BaseApi 
{
    // variable yg cuma bisa diakses di class ini dan turunannya
    protected $baseUrl;
    // constructor : menyiapkan isi data, dijalankan otomatis tanpa dipanggil
    public function __construct()
    {
        // variable $baseUrl yang diatas diisi nilainya dari isian file .env bagian API_HOST
        // variable ini diisi otomatis ketika file / class BaseApi dipanggil di controller 
        $this->baseUrl = "http://127.0.0.1:2222";
    }
    private function client()
    {
        // koneksikan ip dari var $baseUrl ke depedency Http
        // menggunakan depedency Http karena project API nya berbasis web (protocol Http)
        return Http::baseUrl($this->baseUrl);
    }
    public function index (String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }
    public function store (String $endpoint, Array $data = [])
    {
        // pake post() karena buat route tambah data di project rest api nya pake ::post
        return $this->client()->post($endpoint, $data);
    }
    public function edit (String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }
    public function update (String $endpoint, Array $data = [])
    {
        return $this->client()->patch($endpoint, $data);
    }
    public function delete (String $endpoint, Array $data = [])
    {
        return $this->client()->delete($endpoint, $data);
    }
    public function trash (String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }
    public function restore (String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }
    public function permanent (String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }
}