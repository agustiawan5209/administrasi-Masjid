<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
   body{
    background-color: blue;
   }
</style>
<body>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Kode</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Tanggal</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Kas Masuk</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Keterangan Kas Masuk</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Kas Keluar</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Keterangan Kas Keluar</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Total Kas</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($kas as $item)
                <tr>
                    <td style="padding: 5px 6px;">{{ $item->kode }}</td>
                    <td style="padding: 5px 6px;">{{ $item->tanggal }}</td>
                    <td style="padding: 5px 6px;">Rp.{{ number_format($item->kas_masuk,0,2) }}</td>
                    <td style="padding: 5px 6px;">{{ $item->ket_kas_masuk }}</td>
                    <td style="padding: 5px 6px;">Rp.{{ number_format($item->kas_keluar,0,2) }}</td>
                    <td style="padding: 5px 6px;">{{ $item->ket_kas_keluar }}</td>
                    <td style="padding: 5px 6px;">Rp.{{ number_format($item->total_kas,0,2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
