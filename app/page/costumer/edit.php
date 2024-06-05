<?php

$id_pembeli = $_GET['id_pembeli'];


if (isset($_POST["edit"])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];
    $costumer->update($id_pembeli, $nama, $alamat, $no_tlp);
            
    if ($costumer->update($id_pembeli, $nama, $alamat, $no_tlp) == true) {
        ?> <script>window.location.href="index.php?page=costumer/index"</script> <?php  
      }
  }


  if (isset($id_pembeli)) {
      extract($costumer->getID($id_pembeli));
  }

?>


<div class="main-content">
            <section class="section">
               <div class="section-header">
                  <h1>Costumers</h1>
               </div>
               <div class="row">
                  <div class="col-12 col-md-6 col-lg-6">
                     <div class="card">
                        <form method="post">
                           <div class="card-header">
                              <h4>Tambah Costumer</h4>
                           </div>
                           <div class="card-body">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" class="form-control" name="nama" required value="<?php echo $nama ?>">
                              </div>
                              <div class="form-group">
                                 <label>Alamat</label>
                                 <input type="text" class="form-control" required name="alamat" value="<?php echo $alamat ?>">
                              </div>
                              <div class="form-group">
                                 <label>Nomor Telpon</label>
                                 <input type="text" class="form-control" required name="no_tlp" value="<?php echo $no_tlp ?>">
                              </div>
                           </div>
                           <div class="card-footer text-right">
                              <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                           </div>
                        </form>
                     </div>
                  </div>


               </div>
            </section>
         </div>
