<?php
$pdo = Koneksi::connect();
$costumer = costumer::getInsatance($pdo);

$id_pembeli = $_GET['id'];

$getMember = $costumer->showMember($id_pembeli);

if (isset($_POST["edit"])) {
   $nama = htmlspecialchars($_POST['nama']);
   $alamat = htmlspecialchars($_POST['alamat']);
   $no_tlp = htmlspecialchars($_POST['no_tlp']);
   $anggota = htmlspecialchars($_POST['member']);
   $id_member = htmlspecialchars($_POST['id_member']);

   if ($costumer->update($id_pembeli, $nama, $alamat, $no_tlp, $anggota, $id_member)) {
?>
      <script>
         window.location.href = "index.php?page=costumer"
      </script>
<?php
   }
}

if (isset($id_pembeli)) {
   extract($costumer->getID($id_pembeli));
}

?>


<div class="section-header">
   <h1>Costumers</h1>
</div>
<div class="row">
   <div class="col-12 col-md-6 col-lg-8">
      <div class="card">
         <form method="post">
            <div class="card-header">
               <h4>Tambah Costumer</h4>
            </div>
            <div class="card-body">

               <div class="row">
                  <div class="form-group col-md-6">
                     <label>Name</label>
                     <input type="text" autocomplete="off" class="form-control" name="nama" required value="<?php echo $nama ?>">
                  </div>
                  <div class="form-group col-md-6">
                     <label>Alamat</label>
                     <input type="text" autocomplete="off" class="form-control" required name="alamat" value="<?php echo $alamat ?>">
                  </div>
               </div>

               <div class="row">
                  <div class="form-group col-md-6">
                     <label>Member</label>
                     <select name="member" class="form-control selectric">
                        <option value="<?php echo $getMember ?>"><?php echo $getMember ?> (Saat Ini)</option>
                        <option value="NONE">NONE</option>
                        <option value="SILVER">SILVER</option>
                        <option value="GOLD">GOLD</option>
                        <option value="PLATINUM">PLATINUM</option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label>Nomor Telpon</label>
                     <input type="text" autocomplete="off" class="form-control" required name="no_tlp" value="<?php echo $no_tlp ?>">
                  </div>
               </div>
               <div class=" form-group">
                  <button class="btn btn-primary btn-lg btn-block" type="submit" name="edit">Edit</button>
               </div>
            </div>
            <input type="hidden" autocomplete="off" class="form-control" required name="id_member" value="<?= $id_member ?>">
         </form>
      </div>
   </div>
</div>