<?php
include("../database/koneksi.php");
include "../database/class/auth.php";

$pdo = Koneksi::connect();
$user = new Auth($pdo);
$currentUser = $user->getUser();

$pdo =  Koneksi::disconnect();

if (!$user->isLoggedIn() && $user->isLoggedIn() == false) {
    $log = isset($_GET['auth']) ? $_GET['auth'] : 'auth';
    switch ($log) {
        case 'login':
            include 'auth/login.php';
            break;
        case 'register':
            include 'auth/register.php';
            break;
        default:
            include 'auth/login.php';
            break;
    }
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>ZKasir</title>
        <?php
        include 'layout/stylecss.php';
        ?>
    </head>

    <body>
        <div id="app">
            <?php
            include("layout/header.php");
            include("layout/sidebar.php");
            ?>
            <div class="main-content">
                <section class="section">

                    <?php
                    $page = isset($_GET["page"]) ? $_GET["page"] : '';
                    switch ($page) {
                        case 'user':
                            include('page/user/default.php');
                            break;

                        case 'costumer':
                            include('page/costumer/default.php');
                            break;

                        case 'product':
                            include('page/product/default.php');
                            break;

                        case 'transaksi':
                            include('page/transaksi/default.php');
                            break;

                        case 'struk':
                            include('page/cetak/default.php');
                            break;

                        default:
                            include('page/dashboard/index.php');
                    }
                    ?>
                </section>
            </div>

        </div>
        <!-- General JS Scripts -->
        <?php
        include 'layout/footer.php';
        include("layout/stylejs.php");
        ?>
    </body>

    </html>

<?php
}
?>