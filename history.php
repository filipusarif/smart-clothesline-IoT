<?php
include './auth/db.php';
include "conf/koneksi.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

// Query untuk mengambil data dari tabel riwayat
$query = "SELECT * FROM tb_riwayat ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$user_id = $_SESSION['user_id'];

// Ambil username dari database
$query2 = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($query2);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result2 = $stmt->get_result();
$user = $result2->fetch_assoc();

$username = $user['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>smart clothesline</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./bootstrap/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./bootstrap/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./bootstrap/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="./bootstrap/assets/images/icon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index.php">IotClothesline</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="./bootstrap/assets/images/faces/face1.jpg" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black"><?php echo $username ?></p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="auth/logout.php">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="./bootstrap/assets/images/faces/face1.jpg" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2"><?php echo $username?></span>
                                <span class="text-secondary text-small">User</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history.php">
                            <span class="menu-title">History</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> History
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">History Penggunaan</h4>
                                    <!-- <p class="card-description"> Add class <code>.table-striped</code> -->
                                    </p>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th> No </th>
                                                <th> Status Jemur </th>
                                                <th> Posisi Buka </th>
                                                <th> Posisi Tutup </th>
                                                <th> Mode </th>
                                                <th> Cuaca </th>
                                                <th> Status Hujan </th>
                                                <th> Status Cahaya </th>
                                                <th> Tanggal </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1; // Nomor urut
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Mapping data dari database
                                                $jemur = $row['jemur'] == 1 ? 'Buka' : 'Tutup';
                                                $posisi = $row['posisi'];
                                                $posisiTutup = $row['posisiTutup'];
                                                $mode = $row['mode'] == 1 ? 'Otomatis' : 'Manual';
                                                $cuaca = $row['cuaca'];
                                                $hujan = $row['hujan'] == 1 ? 'Hujan' : 'Tidak Hujan';
                                                $cahaya = $row['cahaya'] == 1 ? 'Terang' : 'Gelap';
                                                $tanggal = $row['waktu']; // Pastikan kolom tanggal ada di tabel
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $jemur; ?></td>
                                                    <td><?= $posisi; ?></td>
                                                    <td><?= $posisiTutup; ?></td>
                                                    <td><?= $mode; ?></td>
                                                    <td><?= $cuaca; ?></td>
                                                    <td><?= $hujan; ?></td>
                                                    <td><?= $cahaya; ?></td>
                                                    <td><?= $tanggal; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © iotclothesline.com 2024</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="./bootstrap/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./bootstrap/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="./bootstrap/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="./bootstrap/assets/js/off-canvas.js"></script>
    <script src="./bootstrap/assets/js/hoverable-collapse.js"></script>
    <script src="./bootstrap/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./bootstrap/assets/js/dashboard.js"></script>
    <script src="./bootstrap/assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
</body>

</html>