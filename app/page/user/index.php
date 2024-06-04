<!-- Main Content -->
<div class="main-content">




    <section class="section">
        <div class="section-header">
            <h1>User Management</h1>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="d-inline">Admin And Super Admin</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                    <?php
                    $query = "SELECT * FROM `user`";
                    $crudUser->viewData($query);
                    ?>


                </ul>
            </div>
        </div>
</div>
</div>
</div>

</section>
</div>