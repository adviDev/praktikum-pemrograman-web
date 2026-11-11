<!-- 
    nama      : adytya alviandhika
    nim       : 3202416075
    deskripsi : tampilan beranda
-->
<!DOCTYPE html>
<html lang="{{str_replace('_','-',app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $namaAplikasi }} - Beranda</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icon/bootstrap-icons.min.css') }}">

</head>
<body>
    <h1>{{ $namaAplikasi }}</h1>
    <p>Konfigurasi Berhasil. hari ini {{ $waktu }}</p>
    <table>
        <tr><th>Laravel</th><td>{{ $versiLaravel }}</td></tr>
        <tr><th>PHP</th><td>{{ $versiPhp }}</td></tr>
        <tr><th>MySQL</th><td>{{ $versiMysql }}</td></tr>
        <tr><th>Database</th><td>{{ $namaDatabase }}</td></tr>
    </table>
    <hr>
<i class="bi bi-house-door-fill"></i>
    <i class="bi bi-star-fill" style="color: gold;"></i> 
</body>
</html>