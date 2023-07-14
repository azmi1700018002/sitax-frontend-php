<?php include "../helpers/token_session.php"; ?>
<?php include "../includes/header.php"; ?>

<!-- Sweet Alert Success Menu -->
<?php if (isset($_SESSION["message_menu_success"])) { ?>
<script>
Swal.fire({
    icon: 'success',
    title: '<?php echo $_SESSION["message_menu_success"]; ?>',
    showConfirmButton: false,
    timer: 8000
});
</script>
<?php unset($_SESSION["message_menu_success"]); ?>
<?php } ?>

<!-- Sweet Alert Faield Menu -->
<?php if (isset($_SESSION["message_menu_failed"])) { ?>
<script>
Swal.fire({
    icon: 'error',
    title: '<?php echo $_SESSION["message_menu_failed"]; ?>',
    showConfirmButton: false,
    timer: 8000
});
</script>
<?php unset($_SESSION["message_menu_failed"]); ?>
<?php } ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <h3>Menu</h3>
        <p>data tampilan menu</p>
        <button type="button" class="btn btn-outline-primary ms-auto" data-mdb-ripple-color="dark"
            data-mdb-toggle="modal" data-mdb-target="#tambahMenu">
            <i class="fas fa-plus me-2"></i>
            Menu
        </button>
        <section>
            <div class="my-4 table-responsive">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Icon</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Parent ID</th>
                            <th class="text-center">Parent Sts</th>
                            <th class="text-center">No Urut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../actions/menu/get_menu.php"; ?>
                    </tbody>
                </table>
            </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="tambahMenu" tabindex="-1" aria-labelledby="tambahMenu" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/menu/add_menu.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label" for="MenuID">ID Menu : </label>
                            <div class="form-outline">
                                <input type="text" id="MenuID" name="MenuID" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="MenuNama">Nama Menu : </label>
                            <div class="form-outline">
                                <input type="text" id="MenuNama" name="MenuNama" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="MenuLink">Link Menu : </label>
                            <div class="form-outline">
                                <input type="text" id="MenuLink" name="MenuLink" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="MenuDeskripsi"> Deskripsi Menu : </label>
                            <div class="form-outline">
                                <input type="text" id="MenuDeskripsi" name="MenuDeskripsi" class="form-control"
                                    required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="MenuStatus">Status Menu : </label>
                            <div class="form-outline">
                                <input type="text" id="MenuStatus" name="MenuStatus" class="form-control" required />
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="MenuIcon">Icon Menu : </label>
                            <div class="form-outline">
                                <input type="text" id="MenuIcon" name="MenuIcon" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="MenuKategori">Kategori Menu : </label>
                            <div class="form-outline">
                                <input type="text" id="MenuKategori" name="MenuKategori" class="form-control"
                                    required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="ParentID">ID Parent : </label>
                            <div class="form-outline">
                                <input type="text" id="ParentID" name="ParentID" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="ParentSts">Parent Sts : </label>
                            <div class="form-outline">
                                <input type="text" id="ParentSts" name="ParentSts" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="NoUrut">No Urut : </label>
                            <div class="form-outline">
                                <input type="text" id="NoUrut" name="NoUrut" class="form-control" required />
                            </div>
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


    </section>
</main>

<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<!-- data table  -->
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