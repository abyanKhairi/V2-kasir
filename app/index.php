<?php
include("../database/koneksi.php");
include "../database/class/auth.php";

$pdo = Koneksi::connect();
$user = Auth::getInstance($pdo);
$currentUser = $user->getUser();

// Cek user apakah sudah login atau belum
if (!$user->isLoggedIn() && $user->isLoggedIn() == false) {
    $login = isset($_GET['auth']) ? $_GET['auth'] : 'auth';
    switch ($login) {
        case 'login':
            include 'auth/login.php';
            break;
        case 'register':
            include 'auth/register.php';
            break;
        case 'forget':
            include 'auth/forgotPassword.php';
            break;
        default:
            include 'auth/login.php';
            break;
    }
} else {


    $cetak = isset($_GET['cetak']) ? $_GET['cetak'] : 'cetak';
    switch ($cetak) {
        case 'struk':
            include 'page/cetak/cetak.php';
        case 'transaksi':
            include 'page/transaksi/report.php';
    }


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

                        case 'dashboard':
                            include('page/dashboard/index.php');

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