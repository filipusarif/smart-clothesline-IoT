<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Smart Clothesline</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
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
        xmlhtml.open("GET", "jemur.php?stat=" + (status ? 'Buka' : 'Tutup'), true);
        xmlhtml.send();
    }

    // Function to change the mode (manual/automatic)
    function ubahMode(mode) {
        var modeText = mode ? "Otomatis" : "Manual";
        document.getElementById('mode').innerHTML = modeText;

        // AJAX to update the mode in the backend
        var xmlhtml = new XMLHttpRequest();
        xmlhtml.onreadystatechange = function() {
            if (xmlhtml.readyState == 4 && xmlhtml.status == 200) {
                document.getElementById('mode').innerHTML = xmlhtml.responseText;
            }
        };
        xmlhtml.open("GET", "mode.php?mode=" + (mode ? 'Otomatis' : 'Manual'), true);
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
        xmlhtml.open("GET", "posisi.php?pos=" + status, true);
        xmlhtml.send();
    }

    // Function to load data periodically from the backend (AJAX)
    function loadData() {
        $.ajax({
            url: "load_data.php", // PHP file to load data from the backend
            method: "GET",
            dataType: "json",
            success: function(response) {
                if (response.jemur == 1) {
                    $("#status").text("Buka Jemuran");
                    $("input[type='checkbox']").prop("checked", true);  // Default state for jemuran
                } else {
                    $("#status").text("Tutup Jemuran");
                    $("input[type='checkbox']").prop("checked", false); // Default state for jemuran
                }

                // Update the mode state based on the response
                if (response.mode == 1) {
                    $("#mode").text("Otomatis");
                    document.getElementById('modeToggle').checked = true;  // Sync the mode toggle with the server state
                } else {
                    $("#mode").text("Manual");
                    document.getElementById('modeToggle').checked = false;  // Sync the mode toggle with the server state
                }

                // Update the position of the clothesline
                $("#posisi").text(response.posisi);
                $("#default-range").val(response.posisi);
            },
            error: function() {
                console.error("Gagal memuat data.");
            }
        });
    }

    // Call loadData periodically
    setInterval(loadData, 1500); // Refresh data every 1 second
</script>
</head>

<body onload="loadData()">
    <section class="w-full h-screen">
        <main class="container flex h-full justify-center items-center mx-auto">
            <!-- Jemuran toggle -->
            <div class="bg-gray-500 w-1/3 h-1/6 flex justify-center items-center">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="jemurToggle" class="sr-only peer" onchange="ubahStatus(this.checked)">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300" id="status">Loading...</span>
                </label>
            </div>

            <!-- Mode toggle -->
            <div class="bg-gray-500 w-1/3 h-1/6 flex justify-center items-center">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="modeToggle" class="sr-only peer" onchange="ubahMode(this.checked)">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300" id="mode">Loading...</span>
                </label>
            </div>

            <!-- Posisi control -->
            <div class="bg-slate-500 w-1/3 h-1/6 flex justify-center items-center">
                <label for="default-range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Posisi Jemuran</label>
                <input id="default-range" onchange="ubahPosisi(this.value)" type="range" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                <span id="posisi">Loading...</span>
            </div>
        </main>
    </section>
</body>
</html>