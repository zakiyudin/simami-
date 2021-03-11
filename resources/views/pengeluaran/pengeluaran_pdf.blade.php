<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Laporan Pemasukan</title>
    <style>
        table, th, td{
            border: 1px solid black;
            width: 100%;
            margin-top: 5px;
        }
        th{
            background-color: yellow;
            text-align: center;
        }
        p{
            margin-bottom: 0px;
        }
        
    </style>
</head>
<body>
    <h5 class="text-center">BADAN TAKMIR MASJID JAMI' MAKBADUL MUTTAQIN</h5>
    <h5 class="text-center">KEC.MOJOSARI KAB.MOJOKERTO</h5>
    <h5 class="text-center">LAPORAN PENGELUARAN KEUANGAN</h5>
    <hr>
    <p>Kepada Yth :</p>
    <p>Bapak/Ibu/Saudara Donatur</p>
    <p>Bersama ini kami laporkan pengeluaran keuangan masjid</p>


    <table class="tabel">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Nominal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $item)
                <tr>
                    <td>{{ $item->tanggal_pengeluaran }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>Rp. {{ number_format($item->nominal_pengeluaran) }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <div class="float-right">
        <br>
        <br>
        <br>
        <p><b>Hormat Kami, </b></p>
        <br>
        <br>
        <br>
        <p><b><u>Takmir Bendahara</u></b></p> 
    </div>

    
    
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>