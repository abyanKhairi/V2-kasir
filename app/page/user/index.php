<!-- Main Content -->
<div class="main-content">




    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>
ss
        <div class="card">
            <div class="card-header">
                <h4 class="d-inline">User List</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                    <?php
                    $show = "SELECT * FROM `user`";
                    $crudUser->viewData($show);
                    ?>


                </ul>
            </div>
        </div>
</div>
</div>
</div>

</section>
</div>