<?php
$tanggalSekarang = date('d-M-Y');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Cafe Bisa Ngopi</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}" />
</head>

<body class="font-sans">
    {{$no_meja}}
    <div style="width: 8cm;" class="print-only pt-10 px-3 text-center">
        <p class="text-2xl">Cafe Bisa Ngopi</p>
        <p class="text-sm ">Jl. Cisaranten Kulon No.17, Kota Bandung</p>
        <p class="text-sm ">Telp:022-123456789, WA:0812345678754</p>
        <hr class="border-t-2 border-solid border-black mt-1">
        <table class="w-full">
            @foreach($menus_with_jumlah_keranjang as $item)

            <tr>
                <td colspan="3" class=" text-left">{{ $item['menu']->nama }}</td>
            </tr>
            <tr>
                <td class="text-left">{{ $item['jumlah_keranjang'] }} x</td>
                <td class="text-left">{{ number_format($item['menu']->harga, 0, ',', '.') }}</td>
                <td class="text-left" style="width: 30%;">
                    <?php
                        $total_harga_barang = $item['menu']->harga * $item['jumlah_keranjang'];
                    ?>
                    {{ number_format($total_harga_barang, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-left">Tempe Mendoan</td>
            </tr>
            @endforeach
            <tr>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left">_______</td>
            </tr>
            <tr>
                <td class="text-left"></td>
                <td class="text-left">Total</td>
                <td class="text-left">
                    {{ number_format($transaction->total_harga, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="text-left"></td>
                <td class="text-left">Bayar Cash</td>
                <td class="text-left">
                    {{ number_format($transaction->total_bayar, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="text-left"></td>
                <td class="text-left">Kembalian</td>
                <td class="text-left">
                    <?php
                    $kembalian  = $transaction->total_bayar - $transaction->total_harga;
                    ?>
                    {{ number_format($kembalian, 0, ',', '.') }}
                </td>
            </tr>
        </table>
        <hr class="border-t-2 border-solid border-black mt-3">

        <div class="flex justify-between px-2">
            <p class="text-xs">{{auth()->user()->name}}</p>
            <p class="text-xs">{{$tanggalSekarang}}</p>
        </div>

        <div class="px-2 text-center">
            <p class="text-xs">
                *BARANG YANG TELAH DIBELI TIDAK DAPAT DITUKAR / DIKEMBALIAN*
            </p>
            <p class="text-xs mt-2">
                #TERIMA KASIH#
            </p>
        </div>
    </div>

    <script>
        // Jalankan fungsi cetak saat halaman dimuat
        window.onload = function() {
            document.title = 'Invoice';
            window.print();
            document.title = originalTitle;
        };
        window.onafterprint = function() {
            window.location.href = "{{ route('riwayat') }}";
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>