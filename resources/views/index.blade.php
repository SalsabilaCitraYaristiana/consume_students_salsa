<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume REST API Students</title>
</head>
<body>
    <form action="" method="get">
        @csrf
        <input type="text" name="search" placeholder="Cari nama...">
        <button type="submit">Cari</button>
    </form>
    <br>
    <a href="{{route('add')}}">Tambah Data Baru</a>
    <a href="{{route('trash')}}" style="background-color: orange; color:white;">Lihat Data Terhapus</a>
    @if (Session::get('success'))
    <div style="width: 100%; background: green; padding: 10px;">
        {{ Session::get('success') }}
    </div>
    @endif
    @foreach ($students as $student)
    <ol>
            <li>NIS : {{ $student['nis'] }} </li>
            <li>Nama : {{ $student['nama'] }} </li>
            <li>Rombel : {{ $student['rombel'] }} </li>
            <li>Rayon : {{ $student['rayon'] }} </li>
            <li>Aksi : <a href="{{route('edit', $student['id'])}}">Edit</a></li>
            <form action="{{route('delete', $student['id'])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
    </ol>
    @endforeach
</body>
</html>
