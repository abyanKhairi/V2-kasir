<?php

if (isset($_POST["submit"])) {
   $nama = $_POST['nama'];
   $alamat = $_POST['alamat'];
   $no_tlp = $_POST['no_tlp'];
   $member = $_POST['member'];

   $pdo = Koneksi::connect();

   $costumer = new costumer($pdo);
   if ($costumer->tambah($nama, $alamat, $no_tlp)) {
      //untuk mendapatkan id pembeli yang terakhir kali dimasukkan
      $id_pembeli = $pdo->lastInsertId();

      if ($member) {
         $id_member = $costumer->addMember($member);
         if ($id_member) {
            $costumer->memberPembeli($id_pembeli, $id_member);
         }
      }

      echo "<script>window.location.href = 'index.php?page=costumer'</script>";
   };
   $pdo =  Koneksi::disconnect();
}

?>

<div class="section-header">
   <h1>Costumers</h1>
</div>

<div class="row">
   <div class="col-12 col-md-6 offset-lg-3 col-lg-6">
      <div class="card">
         <form method="post">
            <div class="card-header">
               <h4>Tambah Costumer</h4>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <label>Name</label>
                  <input type="text" autofocus autocomplete="off" class="form-control" name="nama" required>
               </div>
               <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" autocomplete="off" class="form-control" required name="alamat">
               </div>
               <div class="form-group">
                  <label>Member</label>
                  <select name="member" class="form-control selectric">
                     <option value="NONE">NONE</option>
                     <option value="SILVER">SILVER</option>
                     <option value="GOLD">GOLD</option>
                     <option value="PLATINUM">PLATINUM</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Nomor Telpon</label>
                  <input type="text" autocomplete="off" class="form-control" required name="no_tlp">
               </div>
            </div>
            <div class="card-footer text-right">
               <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>