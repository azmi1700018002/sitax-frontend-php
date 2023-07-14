<?php include('../helpers/token_session.php'); ?>
<?php include('../includes/header.php'); ?>

<!-- Sweet Alert Success kewenangan -->
<?php if (isset($_SESSION["message_kewenangan_success"])) { ?>
<script>
Swal.fire({
    icon: 'success',
    title: '<?php echo $_SESSION["message_kewenangan_success"]; ?>',
    showConfirmButton: false,
    timer: 8000
});
</script>
<?php unset($_SESSION["message_kewenangan_success"]); ?>

<?php } ?>

<!-- Sweet Alert Faield kewenangan -->
<?php if (isset($_SESSION["message_kewenangan_failed"])) { ?>
<script>
Swal.fire({
    icon: 'error',
    title: '<?php echo $_SESSION["message_kewenangan_failed"]; ?>',
    showConfirmButton: false,
    timer: 8000
});
</script>
<?php unset($_SESSION["message_kewenangan_failed"]); ?>
<?php } ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <h3>Kewenangan</h3>
        <p>data tampilan kewenangan</p>
        <button type="button" class="btn btn-outline-primary ms-auto" data-mdb-ripple-color="dark"
            data-mdb-toggle="modal" data-mdb-target="#tambahKewenangan">
            <i class="fas fa-plus me-2"></i>
            Kewenangan
        </button>
        <section>
            <div class="my-4 table-responsive">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ID Group</th>
                            <th class="text-center">ID Menu</th>
                            <th class="text-center">IsCreated</th>
                            <th class="text-center">IsUpdated</th>
                            <th class="text-center">IsDeleted</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../actions/kewenangan/get_kewenangan.php"; ?>
                    </tbody>
                </table>
            </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="tambahKewenangan" tabindex="-1" aria-labelledby="tambahKewenangan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kewenangan</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/kewenangan/add_kewenangan.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label" for="GrupID">Gruop :</label>
                            <select class="form-select" name="GroupID" aria-label="Default select example">
                                <?php
                                require_once "../config/server.php";

                                $url = $baseUrl . "group";
                                $token = $_SESSION["token"];
                                $headers = ["Authorization: Bearer " . $token];
                                $curl = curl_init();
                                curl_setopt_array($curl, [
                                    CURLOPT_URL => $url,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                                    CURLOPT_HTTPHEADER => $headers,
                                ]);
                                $response = curl_exec($curl);
                                curl_close($curl);
                                $data = json_decode($response, true);
                                if (isset($data["data"])) {
                                    // Loop untuk menghasilkan opsi dalam elemen select
                                    foreach ($data["data"] as $group) {
                                        $selected = ($group["GroupID"] == $selectedGroupID) ? "selected" : ""; // Menentukan apakah opsi ini dipilih
                                        $optionValue = $group["GroupID"]; // Menggunakan GroupID sebagai nilai opsi
                                        $optionText = $group["GroupID"] . " - " . $group["GroupNama"]; // Menggabungkan GroupID dan GroupNama sebagai teks opsi
                                        echo "<option value='" . $optionValue . "' data-groupnama='" . $group["GroupNama"] . "' $selected>" . $optionText . "</option>";
                                    }
                                } else {
                                    echo '<option value="" disabled selected>Tidak ada data group</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="MenuID">Menu :</label>
                            <select class="form-select" name="MenuID" aria-label="Default select example">
                                <?php
                                require_once "../config/server.php";

                                $url = $baseUrl . "menu";
                                $token = $_SESSION["token"];
                                $headers = ["Authorization: Bearer " . $token];
                                $curl = curl_init();
                                curl_setopt_array($curl, [
                                    CURLOPT_URL => $url,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                                    CURLOPT_HTTPHEADER => $headers,
                                ]);
                                $response = curl_exec($curl);
                                curl_close($curl);
                                $data = json_decode($response, true);
                                if (isset($data["data"])) {
                                    // Loop untuk menghasilkan opsi dalam elemen select
                                    foreach ($data["data"] as $menu) {
                                        $selected = ($menu["MenuID"] == $selectedGroupID) ? "selected" : ""; // Menentukan apakah opsi ini dipilih
                                        $optionValue = $menu["MenuID"]; // Menggunakan MenuID sebagai nilai opsi
                                        $optionText = $menu["MenuID"] . " - " . $menu["MenuNama"]; // Menggabungkan GroupID dan GroupNama sebagai teks opsi
                                        echo "<option value='" . $optionValue . "' data-menunama='" . $menu["MenuNama"] . "' $selected>" . $optionText . "</option>";
                                    }
                                } else {
                                    echo '<option value="" disabled selected>Tidak ada data menu</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="IsCreated">IsCreated :</label>
                            <div class="form-outline">
                                <input type="text" id="IsCreated" name="IsCreated" class="form-control" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="IsUpdated">IsUpdated :</label>
                            <div class="form-outline">
                                <input type="text" id="IsUpdated" name="IsUpdated" class="form-control" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="IsDeleted">IsDeleted :</label>
                            <div class="form-outline">
                                <input type="text" id="IsDeleted" name="IsDeleted" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </section>
</main>

<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- data table -->
<script>
$(document).ready(function() {
    $("#myTable").DataTable();
});
</script>

<!-- limit textarea form tambah -->
<script>
$(document).ready(function() {
    $('#limittambahDeskripsi').on('input propertychange', function() {
        charLimitTambah(this, 50);
    });
});

function charLimitTambah(input, maxChar) {
    var len = $(input).val().length;
    $('#textCounterTambah').text(len + ' dari ' + maxChar + ' karakter');

    if (len > maxChar) {
        $(input).val($(input).val().substring(0, maxChar));
        $('#textCounterTambah').text('0 karakter tersisa');
    } else {
        $('#textCounterTambah').text(maxChar - len + ' karakter tersisa');
    }
}
</script>

<!-- limit textarea form edit -->
<script>
$(document).ready(function() {
    $('.editDeskripsi').on('input propertychange', function() {
        charLimit(this, 50);
    });
});

function charLimit(input, maxChar) {
    var len = $(input).val().length;
    var counter = $(input).closest('.modal-body').find('.charNum');
    counter.text(len + ' dari ' + maxChar + ' karakter');

    if (len > maxChar) {
        $(input).val($(input).val().substring(0, maxChar));
        counter.text('0 karakter tersisa');
    } else {
        counter.text(maxChar - len + ' karakter tersisa');
    }
}
</script>

</body>

</html>