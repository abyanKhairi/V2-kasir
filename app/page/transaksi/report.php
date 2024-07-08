<?php
require_once "../vendor/autoload.php";
require_once "../database/class/transaksi.php";
require_once "../database/class/page.php";
$mpdf = new \Mpdf\Mpdf();


$pdo = Koneksi::connect();
$tanggal = $_GET['tanggal'];
$transaksi = new Transaksi($pdo);
$paging = new Page($pdo, "transaksi");
$bayar = $transaksi->countUang($tanggal);
$rows = $transaksi->getTransaksi(@$tanggal);
$pdo = Koneksi::disconnect();


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
                <h4> Laporan Transaksi Zkasir</h4>
            </div>
        </div>

        <table align="center" border="1" cellspacing="0" cellpadding="10">
            <tr bgcolor="#c9c7c7">
                <th width="1cm">No</th>
                <th width="2cm">Tanggal</th>
                <th width="4cm">Nama Costumer</th>
                <th width="1cm">Jumlah</th>
                <th width="4cm">No Hp</th>
                <th width="6cm">Alamat</th>
                <th width="4cm">Status</th>
            </tr>
            '; ?>

<?php
$i = 1;
foreach ($rows as $row) :
    $cek = $transaksi->getIdBayar($row["id_transaksi"])
?><?php


    $html .= '<tr>
    <td align="center">' . $i . '</td>
    <td class="TrTdSize" align="center">' . $row["tanggal_transaksi"] . '</td>
    <td class="TrTdSize" align="center">' . $row["nama"] . '</td>
    <td class="TrTdSize" align="center">' . $transaksi->jumlahT($row["id_transaksi"]) . '</td>
    <td class="TrTdSize" align="center">' . $row["no_tlp"] . '</td>
    <td class="TrTdSize" align="center">' . $row["alamat"] . '</td>
';

    if ($row["status"] === "SELESAI") {

        $html .= '<td class="TrTdSize" align="center"><span class="badge badge-success">Dibayar</span></td>';
    } else {
        $html .= ' <td class="TrTdSize" align="center"><span class="badge badge-warning">Belum Dibayar</span></td>';
    }
    $html .= '</tr>';
    $i++;

endforeach;

$html .= '</table>
<br>
    <table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td align="center" width="15cm">Total Pendapatan Keseluruhan / Total Pendapatan Hari Ini</td>
        <td align="center" bgcolor="#c9c7c7" width="6cm">Rp.' . number_format($bayar) . '</td>
    </tr>
    </table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();
