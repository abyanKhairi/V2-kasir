<?php
require_once "../vendor/autoload.php";
require_once "../database/class/transaksi.php";
require_once "../database/class/page.php";
$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ZKasir</title>
        <link rel="stylesheet" href="../assets/css/custom.css">
    </head>
        <body>
        <div>
            <div>
                <h4>Transaksi List</h4>
            </div>
        </div>

        <table align="center" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Costumer</th>
                <th>Jumlah</th>
                <th>No Hp</th>
                <th>Alamat</th>
                <th>Status</th>
            </tr>
            '; ?>
<?php
$pdo = Koneksi::connect();
$tanggal = $_GET['tanggal'];
$transaksi = new Transaksi($pdo);
$paging = new Page($pdo, "transaksi");
$bayar = $transaksi->countUang($tanggal);
$rows = $transaksi->getTransaksi(@$tanggal);
$i = 1;
foreach ($rows as $row) :
    $cek = $transaksi->getIdBayar($row["id_transaksi"])
?><?php

    $html .= '<tr>
    <td align="center">' . $i . '</td>
    <td align="center">' . $row["tanggal_transaksi"] . '</td>
    <td align="center">' . $row["nama"] . '</td>
    <td align="center">' . $transaksi->jumlahT($row["id_transaksi"]) . '</td>
    <td align="center">' . $row["no_tlp"] . '</td>
    <td align="center">' . $row["alamat"] . '</td>
';

    if ($row["status"] === "SELESAI") {

        $html .= '<td class="align-middle"><span class="badge badge-success">Dibayar</span></td>';
    } else {
        $html .= ' <td class="align-middle"><span class="badge badge-warning">Belum Dibayar</span></td>';
    }
    $html .= '</tr>';

    $i++;
endforeach;

$html .= '</table>
<br>
    <table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td align="center" width="15cm">Total Pendapatan Keseluruhan / Total Pendapatan Bulan Ini</td>
        <td align="center" width="6cm">Rp.' . number_format($bayar) . '</td>
    </tr>
    </table>
</body>
</html>';

// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);

$mpdf->Output();
