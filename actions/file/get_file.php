<?php
require_once "../config/server.php";

$url = $baseUrl . "auth/file";
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
  $nomor = 1; // initialize the variable
  foreach ($data["data"] as $file) {
    echo "<tr>";
    echo "<td class='text-center'>" . $nomor . "</td>"; // add the number column
    echo "<td class='text-center'>" . $file["FileID"] . "</td>";
    echo "<td class='text-center'>" . $file["FileJudul"] . "</td>";
    echo "<td class='text-center'>" . $file["FilePath"] . "</td>";
    echo "<td class='text-center'>" . $file["FileDate"] . "</td>";
    echo "<td class='text-center'>" . $file["FileJenis"] . "</td>";
    echo '<td>
    <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#deleteFile' .
      $file["FileID"] .
      '"><i class="fas fa-trash"></i> </button>
    <div class="modal fade" id="deleteFile' .
      $file["FileID"] .
      '" tabindex="-1" aria-labelledby="deleteFile" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="deleteFile">Delete File</h5>
<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">Apakah yakin ingin menghapus data file ini?</div>

<div class="modal-footer">
<button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
<form method="POST" action="../actions/file/delete_file.php">
<input type="hidden" name="FileID" value="' .
      $file["FileID"] .
      '">
    <button type="submit" class="btn btn-danger" >Hapus</button>
</form>
</div>
</div>
</div>
</div> 
<button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-warning" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editFile' .
      $file["FileID"] .
      '">  <i class="fas fa-edit"></i> </button>
    <div class="modal fade" id="editFile' .
      $file["FileID"] .
      '" tabindex="-1" aria-labelledby="editFile" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFile">Edit file</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../actions/file/put_file.php" enctype="multipart/form-data">
                <div class="mb-3" style="display:none;">
<label class="form-label" for="FileID">ID :</label>
<div class="form-outline">
<input type="hidden" id="FileID" name="FileID" class="form-control" value="' .
      $file["FileID"] .
      '">
</div>
</div>
                        <div class="mb-3">
                        <label class="form-label" for="FileJudul">Judul File : </label>
                        <div class="form-outline">
                            <input type="text" id="FileJudul" name="FileJudul" class="form-control"
                            value="' .
      $file["FileJudul"] .
      '">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                    <label class="form-label" for="FilePath">File Path : </label>
                    <div class="form-outline">
                        <input type="text" id="FilePath" name="FilePath" class="form-control"
                        value="' .
      $file["FilePath"] .
      '">
                    </div>
                </div>

                <div class="mb-3">
                <label class="form-label" for="FileJenis">File Jenis : </label>
                <div class="form-outline">
                    <input type="text" id="FileJenis" name="FileJenis" class="form-control"
                    value="' .
      $file["FileJenis"] .
      '">
                </div>
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>
    </td>';
    echo "</tr>";
    $nomor++; // increment the variable
  }
} else {
  echo '<div class="alert alert-warning" role="alert">Tidak ada data file</div>';
}
?>