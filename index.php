<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
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
    <link rel="shortcut icon" href="./bootstrap/assets/images/favicon.ico" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // Function to change the status of the jemuran (clothesline)
        function ubahStatus(status) {
            var statusText = status ? "Buka" : "Tutup";
            document.getElementById('status').innerHTML = statusText + ' Jemuran';

            // AJAX to update the status in the backend
            var xmlhtml = new XMLHttpRequest();
            xmlhtml.onreadystatechange = function() {
                if (xmlhtml.readyState == 4 && xmlhtml.status == 200) {
                    document.getElementById('status').innerHTML = xmlhtml.responseText;
                }
            };
            xmlhtml.open("GET", "conf/jemur.php?stat=" + (status ? 'Buka' : 'Tutup'), true);
            xmlhtml.send();
        }

        // Function to change the mode (manual/automatic)
        function ubahMode(mode) {
            var modeText = mode ? "Otomatis" : "Manual";
            document.getElementById('default-range').disabled = mode;
            document.getElementById('default-range2').disabled = mode;
            document.getElementById('flexSwitchCheckDefault').disabled = mode;
            document.getElementById('mode').innerHTML = modeText;

            // AJAX to update the mode in the backend
            var xmlhtml = new XMLHttpRequest();
            xmlhtml.onreadystatechange = function() {
                if (xmlhtml.readyState == 4 && xmlhtml.status == 200) {
                    document.getElementById('mode').innerHTML = xmlhtml.responseText;
                }
            };
            xmlhtml.open("GET", "conf/mode.php?mode=" + (mode ? 'Otomatis' : 'Manual'), true);
            xmlhtml.send();
        }

        // Function to change the position of the clothesline
        function ubahPosisi(status) {
            document.getElementById('posisi').innerHTML = status;

            // AJAX to update the position in the backend
            var xmlhtml = new XMLHttpRequest();
            xmlhtml.onreadystatechange = function() {
                if (xmlhtml.readyState == 4 && xmlhtml.status == 200) {
                    document.getElementById('posisi').innerHTML = xmlhtml.responseText;
                }
            };
            xmlhtml.open("GET", "conf/posisi.php?pos=" + status, true);
            xmlhtml.send();
        }

        function ubahPosisiTutup(status) {
            document.getElementById('posisiTutup').innerHTML = status;

            // AJAX to update the position in the backend
            var xmlhtml = new XMLHttpRequest();
            xmlhtml.onreadystatechange = function() {
                if (xmlhtml.readyState == 4 && xmlhtml.status == 200) {
                    document.getElementById('posisiTutup').innerHTML = xmlhtml.responseText;
                }
            };
            xmlhtml.open("GET", "conf/posisiTutup.php?pos=" + status, true);
            xmlhtml.send();
        }

        // Function to load data periodically from the backend (AJAX)
        function loadData() {
            $.ajax({
                url: "conf/load_data.php", // PHP file to load data from the backend
                method: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.jemur == 1) {
                        $("#status").text("Buka Jemuran");
                        // $("input[type='checkbox']").prop("checked", true); // Default state for jemuran
                        document.getElementById('flexSwitchCheckDefault').checked = true; // Sync the mode toggle with the server state

                    } else {
                        $("#status").text("Tutup Jemuran");
                        // $("input[type='checkbox']").prop("checked", false); // Default state for jemuran
                        document.getElementById('flexSwitchCheckDefault').checked = false; // Sync the mode toggle with the server state

                    }

                    // Update the mode state based on the response
                    if (response.mode == 1) {
                        $("#mode").text("Otomatis");
                        document.getElementById('default-range').disabled = true;
                        document.getElementById('default-range2').disabled = true;
                        document.getElementById('flexSwitchCheckDefault').disabled = true;
                        document.getElementById('flexSwitchCheckDefault1').checked = true; // Sync the mode toggle with the server state
                    } else {
                        $("#mode").text("Manual");
                        document.getElementById('default-range').disabled = false;
                        document.getElementById('default-range2').disabled = false;
                        document.getElementById('flexSwitchCheckDefault').disabled = false;
                        document.getElementById('flexSwitchCheckDefault1').checked = false; // Sync the mode toggle with the server state
                    }



                    // Update the position of the clothesline
                    $("#posisi").text(response.posisi);
                    $("#default-range").val(response.posisi);

                    $("#posisiTutup").text(response.posisiTutup);
                    $("#default-range2").val(response.posisiTutup);

                    $("#cuaca").text(response.cuaca);

                    if (response.hujan == 0) {
                        $("#hujan").text("Tidak Hujan");
                    } else {
                        $("#hujan").text("Sedang Hujan");
                    }

                    if (response.cahaya == 0) {
                        $("#cahaya").text("Gelap");
                    } else {
                        $("#cahaya").text("Terang");
                    }

                },
                error: function() {
                    console.error("Gagal memuat data.");
                }
            });
        }

        // Call loadData periodically
        setInterval(loadData, 2000); // Refresh data every 1 second
    </script>
</head>

<body onload="loadData()">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.html"><img src="./bootstrap/assets/images/logo.svg" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="./bootstrap/assets/images/logo-mini.svg" alt="logo" /></a>
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
                                <p class="mb-1 text-black">David Greymaax</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="./bootstrap/assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="./bootstrap/assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="./bootstrap/assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notifications</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-calendar"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-settings"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-link-variant"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                        </div>
                    </li>
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li> -->
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
                                <span class="font-weight-bold mb-2">David Grey. H</span>
                                <span class="text-secondary text-small">Project Manager</span>
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
                            </span> Dashboard
                        </h3>
                        <!-- <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                    <div class="row">
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-danger card-img-holder text-white">
                                <div class="card-body">
                                    <img src="./bootstrap/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Cuaca <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5" id="cuaca">Cerah</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-info card-img-holder text-white">
                                <div class="card-body">
                                    <img src="./bootstrap/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Status Hujan <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5" id="hujan">Tidak Hujan</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card bg-gradient-success card-img-holder text-white">
                                <div class="card-body">
                                    <img src="./bootstrap/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                    <h4 class="font-weight-normal mb-3">Status Cahaya <i class="mdi mdi-diamond mdi-24px float-right"></i>
                                    </h4>
                                    <h2 class="mb-5" id="cahaya">Terang</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="text-center mb-4">Jemur Pakaian</h1>
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-lg" style="width: 100px; height: 50px;" type="checkbox" role="switch" id="flexSwitchCheckDefault" onchange="ubahStatus(this.checked)">
                                        </div>
                                    </div>
                                    <label class="form-check-label d-block text-center mt-4" for="flexSwitchCheckDefault" id="status">Loading</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="text-center mb-4">Mode Control</h1>
                                    <div class="d-flex justify-content-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-lg" style="width: 100px; height: 50px;" type="checkbox" role="switch" id="flexSwitchCheckDefault1" onchange="ubahMode(this.checked)">
                                        </div>
                                    </div>
                                    <label class="form-check-label d-block text-center mt-4" for="flexSwitchCheckDefault1" id="mode">Loading</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h1>Posisi Buka Jemuran</h1>
                                        <div class="d-flex justify-content-center gap-3">
                                            <p>Jauh</p>
                                            <input type="range" class="form-range" min="60" max="89" id="default-range" onchange="ubahPosisi(this.value)">
                                            <label for="customRange1" class="form-label" id="posisi">Example range</label>
                                            <p>Dekat</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h1>Posisi Tutup Jemuran</h1>
                                        <div class="d-flex justify-content-center gap-3">
                                            <p>Dekat</p>
                                            <input type="range" class="form-range" min="97" max="120" id="default-range2" onchange="ubahPosisiTutup(this.value)">
                                            <label for="customRange1" class="form-label" id="posisiTutup">Example range</label>
                                            <p>Jauh</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
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