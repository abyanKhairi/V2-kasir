<?php

class Transaksi
{
    private $db;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    //untuk menggambil data dari tabel transaksi yang berelasi dengan pembeli
    public function getTransaksi()
    {
        try {
            $stmt = $this->db->prepare("SELECT transaksi.*, pembeli.id_pembeli , pembeli.nama ,pembeli.alamat , pembeli.no_tlp           
            FROM transaksi 
            JOIN pembeli 
            ON pembeli.id_pembeli = transaksi.id_pembeli");


            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //untuk mengambil data pembeli agar bisa diinput ke transaksi
    public function getCustomer()
    {
        try {
            $stmt =  $this->db->prepare("SELECT * FROM pembeli");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //menambahkan transaksi / menginput data transaksi
    public function tambahTransaksi($id_pembeli, $tanggal)
    {
        try {

            $stmt = $this->db->prepare("INSERT INTO transaksi (id_pembeli, tanggal_transaksi) VALUE ( :id_pembeli , :tanggal )");
            $stmt->bindParam(":id_pembeli", $id_pembeli);
            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    //mengambil data produk
    public function getProduk($que, $id_transaksi)
    {
        try {
            $que = "SELECT * FROM product WHERE id_produk NOT IN (SELECT id_produk FROM detail_transaksi WHERE id_transaksi = :id_transaksi)";
            $stmt =  $this->db->prepare($que);
            $stmt->bindParam(':id_transaksi', $id_transaksi);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cekStok($id_produk, $qty)
    {
        try {
            $stmt = $this->db->prepare("SELECT jumlah_produk FROM product WHERE id_produk = :id_produk");
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->execute();
            $stok = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stok && $stok['jumlah_produk'] >= $qty) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    //menambahkan detail transaksi
    public function tambahDetail($id_transaksi, $id_produk, $qty,)
    {
        try {

            if (!$this->cekStok($id_produk, $qty)) {
                echo 'Stok Tidak Cukup';
                return false;
            }

            $stmt = $this->db->prepare("INSERT INTO detail_transaksi (id_transaksi, id_produk, qty) VALUE ( :id_transaksi , :id_produk, :qty )");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":qty", $qty);
            $stmt->execute();


            //mengurangi stok
            $stmt = $this->db->prepare("UPDATE product SET jumlah_produk = jumlah_produk - :qty WHERE id_produk = :id_produk");
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":qty", $qty);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDetail($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM detail_transaksi, product WHERE detail_transaksi.id_produk = product.id_produk AND id_transaksi = :idTrk");
            $stmt->bindParam(":idTrk", $id_transaksi);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function total($id_transaksi)
    {
        try {

            $stmt = $this->db->prepare("SELECT SUM(detail_transaksi.qty * product.harga_produk) as total_harga FROM detail_transaksi JOIN product ON detail_transaksi.id_produk = product.id_produk WHERE id_transaksi = :id_transaksi");
            $stmt->bindParam("id_transaksi", $id_transaksi);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function hapusDetail($id_produk, $id_transaksi)
    {

        try {
            //cek jumlah qty 
            $stmt = $this->db->prepare("SELECT qty FROM detail_transaksi WHERE id_transaksi = :id_transaksi AND id_produk = :id_produk");
            $stmt->bindParam(':id_transaksi', $id_transaksi);
            $stmt->bindParam(':id_produk', $id_produk);
            $stmt->execute();
            $cek = $stmt->fetch(PDO::FETCH_ASSOC);


            //jika detail tidak ditemukan tidak ditenukan
            if ($cek === false) {
                echo "Data Yang ingin Dihapus Tidak Ada";
                return false;
            }

            $qty = $cek['qty'];

            //hapus data 
            $stmt = $this->db->prepare("DELETE FROM detail_transaksi WHERE id_produk = :id_produk AND id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();

            //kembalikan stok seperti semula
            $stmt = $this->db->prepare("UPDATE product SET jumlah_produk = jumlah_produk + :qty WHERE id_produk = :id_produk");
            $stmt->bindParam(':qty', $qty);
            $stmt->bindParam(':id_produk', $id_produk);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function hapusTransaksi($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM transaksi WHERE id_transaksi = :id");
            $stmt->bindParam(":id", $id_transaksi);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
