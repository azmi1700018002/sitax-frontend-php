<?php include "../helpers/token_session.php"; ?>
<?php include "../includes/header.php"; ?>

<!-- Sweet Alert Success Pajak -->
<?php if (isset($_SESSION["message_pajak_success"])) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?php echo $_SESSION["message_pajak_success"]; ?>',
            showConfirmButton: false,
            timer: 8000
        });
    </script>
    <?php unset($_SESSION["message_pajak_success"]); ?>
<?php } ?>

<!-- Sweet Alert Faield Pajak -->
<?php if (isset($_SESSION["message_pajak_failed"])) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '<?php echo $_SESSION["message_pajak_failed"]; ?>',
            showConfirmButton: false,
            timer: 8000
        });
    </script>
    <?php unset($_SESSION["message_pajak_failed"]); ?>
<?php } ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <h3>Pajak</h3>
        <p>data tampilan pajak</p>
        <button type="button" class="btn btn-outline-primary ms-auto" data-mdb-ripple-color="dark"
            data-mdb-toggle="modal" data-mdb-target="#tambahPajak">
            <i class="fas fa-plus me-2"></i>
            Pajak
        </button>
        <section>
            <div class="my-4 table-responsive">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ID Pajak</th>
                            <th class="text-center">Nama Pajak</th>
                            <th class="text-center">Parent Pajak</th>
                            <th class="text-center">Sts Pajak</th>
                            <th class="text-center">Ket Pajak</th>
                            <th class="text-center">Sts Parent</th>
                            <th class="text-center">ID File</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../actions/pajak/get_pajak.php"; ?>
                    </tbody>
                </table>
            </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="tambahPajak" tabindex="-1" aria-labelledby="tambahPajak" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pajak</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/pajak/add_pajak.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label" for="PajakID">ID Pajak : </label>
                            <div class="form-outline">
                                <input type="text" id="PajakID" name="PajakID" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="NamaPajak">Nama Pajak : </label>
                            <div class="form-outline">
                                <input type="text" id="NamaPajak" name="NamaPajak" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="ParentPajak">Parent Pajak : </label>
                            <div class="form-outline">
                                <input type="text" id="ParentPajak" name="ParentPajak" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="StsPajak">Parent Pajak : </label>
                            <div class="form-outline">
                                <input type="text" id="StsPajak" name="StsPajak" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="KetPajak">Ket Pajak : </label>
                            <div class="form-outline">
                                <textarea id="limittambahDeskripsi" name="KetPajak" class="form-control"
                                    required></textarea>
                            </div>
                            <div id="textCounterTambah">50 Karakter Tersisa</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="StsParent">Sts Parent : </label>
                            <div class="form-outline">
                                <input type="text" id="StsParent" name="StsParent" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="FileID">ID File : </label>
                            <div class="form-outline">
                                <input type="text" id="FileID" name="FileID" class="form-control" required />
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
    $(document).ready(function () {
        $('#myTable').DataTable({

        });
    });
</script>

<!-- limit textarea form tambah -->
<script>
    $(document).ready(function () {
        $('#limittambahDeskripsi').on('input propertychange', function () {
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
    $(document).ready(function () {
        $('.editDeskripsi').on('input propertychange', function () {
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