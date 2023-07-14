<?php include "../helpers/token_session.php"; ?>
<?php include "../includes/header.php"; ?>

<!-- Sweet Alert Success Pajak Detail -->
<?php if (isset($_SESSION["message_pajak_detail_success"])) { ?>
<script>
Swal.fire({
    icon: 'success',
    title: '<?php echo $_SESSION["message_pajak_detail_success"]; ?>',
    showConfirmButton: false,
    timer: 8000
});
</script>
<?php unset($_SESSION["message_pajak_detail_success"]); ?>
<?php } ?>

<!-- Sweet Alert Faield Pajak Detail -->
<?php if (isset($_SESSION["message_pajak_detail_failed"])) { ?>
<script>
Swal.fire({
    icon: 'error',
    title: '<?php echo $_SESSION["message_pajak_detail_failed"]; ?>',
    showConfirmButton: false,
    timer: 8000
});
</script>
<?php unset($_SESSION["message_pajak_detail_failed"]); ?>
<?php } ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <h3>Detail Pajak</h3>
        <p>data tampilan detail pajak</p>
        <button type="button" class="btn btn-outline-primary ms-auto" data-mdb-ripple-color="dark"
            data-mdb-toggle="modal" data-mdb-target="#tambahPajakDetail">
            <i class="fas fa-plus me-2"></i>
            Detail Pajak
        </button>
        <section>
            <div class="my-4 table-responsive">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ID Detail Pajak</th>
                            <th class="text-center">ID Pajak</th>
                            <th class="text-center">Ppn</th>
                            <th class="text-center">Pasal23</th>
                            <th class="text-center">Pph Final</th>
                            <th class="text-center">Pajak Lain</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include "../actions/pajak-detail/get_pajak_detail.php"; ?>
                    </tbody>
                </table>
            </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="tambahPajakDetail" tabindex="-1" aria-labelledby="tambahPajakDetail" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Pajak</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../actions/pajak-detail/add_pajak_detail.php" method="POST"
                        enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label" for="PajakDetailID">ID Pajak Detail : </label>
                            <div class="form-outline">
                                <input type="text" id="PajakDetailID" name="PajakDetailID" class="form-control"
                                    required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="PajakID">ID Pajak: </label>
                            <div class="form-outline">
                                <input type="text" id="PajakID" name="PajakID" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Ppn">PPN : </label>
                            <div class="form-outline">
                                <input type="text" id="Ppn" name="Ppn" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="Pasal23">Pasal23 : </label>
                            <div class="form-outline">
                                <input type="text" id="Pasal23" name="Pasal23" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="PphFinal">PPH : </label>
                            <div class="form-outline">
                                <input type="text" id="PphFinal" name="PphFinal" class="form-control" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="PajakLain">Pajak Lain : </label>
                            <div class="form-outline">
                                <input type="text" id="PajakLain" name="PajakLain" class="form-control" required />
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="Keterangan">Keterangan : </label>
                            <div class="form-outline">
                                <textarea id="limittambahDeskripsi" name="Keterangan" class="form-control"
                                    required></textarea>
                            </div>
                            <div id="textCounterTambah">50 Karakter Tersisa</div>
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
    $('#myTable').DataTable({

    });
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