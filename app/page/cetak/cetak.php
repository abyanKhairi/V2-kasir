<?php
require_once "../vendor/autoload.php";
include "../database/class/bayar.php";

$id_struk = $_GET["id_struk"];

$pdo = Koneksi::connect();
$bayar = new Bayar($pdo);
$cek = $bayar->getBayar($id_struk);
$get = $bayar->getTransaksi($cek["id_transaksi"]);
$rows = $bayar->getStruk($cek["id_transaksi"]);
$pdo = Koneksi::disconnect();
$mpdf = new \Mpdf\Mpdf();
?>
<?php
$html = '<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ZKasir</title>
        <link rel="stylesheet" href="../assets/css/custom.css">
    </head>
        <body>
        <div class="cartu">
            <h5 class="zkasir">ZKASIR</h5>
            <h2 class="struk">Struk Transaksi</h2>
            <div class="letakTgl">' . $get["tanggal_transaksi"] . '</div>
            <div>
                <p>ID transaksi : ' . $cek["id_transaksi"] . ' </p>
                <p>ID Pembayaran : ' . $id_struk . ' </p>
            </div>

            <table align="center" border="1" cellspacing="0" cellpadding="10">
            <tr bgcolor="#E1E1E1">
            <th>Nama Product</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
            </tr>
            
            ';
foreach ($rows as $row) {

    $html .= '
        <tr>
                <td align="center"> ' . $row["nama_produk"] . '</td>
                <td align="center">' . $row["qty"] . '</td>
                <td align="center">Rp. ' . number_format($row["harga_produk"]) . '</td>
                <td align="center">Rp. ' . number_format($row["qty"] * $row["harga_produk"]) . '</td>
        </tr>';
}
$html .= '
<tr bgcolor="#E1E1E1">
        <th>Jumlah Yang Dibayarkan</th>
        <th>Kembalian</td>
        <th>Discount</th>
        <th>Total Harga</th>
        </tr>
        <tr>
        <td align="center">Rp.' . number_format($cek["jumlah_bayar"]) . '</td>
        <td align="center">Rp.' . number_format($cek["kembalian"]) . '</td>
        <td align="center">Rp.' . number_format($cek["discount"]) . '</td>
        <td align="center">Rp.' . number_format($cek["total_harga"]) . '</td>
        </tr>
        </table>
    </div>
    </body>
</html>
';


// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);

$mpdf->Output();
