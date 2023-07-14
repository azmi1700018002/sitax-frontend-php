<?php
require_once "../config/server.php";

$url = $baseUrl . "auth/users";
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
    foreach ($data["data"] as $user) {
        echo "<tr>";
        echo "<td class='text-center'>" . $nomor . "</td>"; // add the number column
        echo "<td class='text-center'>" . $user["NamaLengkap"] . "</td>";
        echo "<td class='text-center'>" . $user["Email"] . "</td>";
        echo "<td class='text-center'>" . $user["HostIP"] . "</td>";
        echo "<td class='text-center'>" . $user["StsUser"] . "</td>";
        echo '<td>
        <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#deleteUser' .
            $user["Username"] .
            '"><i class="fas fa-trash"></i> </button>
      <div class="modal fade" id="deleteUser' .
            $user["Username"] .
            '" tabindex="-1" aria-labelledby="deleteUser" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="deleteUser">Modal title</h5>
    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">Apakah yakin ingin menghapus data user ini?</div>
 
  <div class="modal-footer">
  <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
  <form method="POST" action="../actions/user/delete_user.php">
  <input type="hidden" name="Username" value="' .
            $user["Username"] .
            '">
        <button type="submit" class="btn btn-danger" >Hapus</button>
    </form>
  </div>
</div>
</div>
</div>  

            <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-warning" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editUser' .
            $user["Username"] .
            '">  <i class="fas fa-edit"></i> </button>
            <div class="modal fade" id="editUser' .
            $user["Username"] .
            '" tabindex="-1" aria-labelledby="editUser" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUser">Edit user</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../actions/user/put_user.php" enctype="multipart/form-data">
                        <div class="mb-3" style="display:none;">
    <label class="form-label" for="Username">ID :</label>
    <div class="form-outline">
        <input type="hidden" id="Username" name="Username" class="form-control" value="' .
            $user["Username"] .
            '">
        </div>
    </div>
                                <div class="mb-3">
                                <label class="form-label" for="NamaLengkap">Nama Lengkap : </label>
                                <div class="form-outline">
                                    <input type="text" id="NamaLengkap" name="NamaLengkap" class="form-control"
                                    value="' .
            $user["NamaLengkap"] .
            '">
                                </div>
                            </div>
                            <div class="mb-3">
                            <label class="form-label" for="Email">Email : </label>
                            <div class="form-outline">
                                <input type="text" id="Email" name="Email" class="form-control"
                                value="' .
            $user["Email"] .
            '">
                            </div>
                        </div>
    
                            <div class="mb-3">
                                <label class="form-label" for="HostIP">HostIP : </label>
                                <div class="form-outline">
                                    <input type="text" id="HostIP" name="HostIP" class="form-control"
                                    value="' .
            $user["HostIP"] .
            '">
                                </div>
                            </div>
                    
                            <div class="mb-3">
                                <label class="form-label" for="StsUser">StsUser : </label>
                                <div class="form-outline">
                                    <input type="text" id="StsUser" name="StsUser" class="form-control"
                                    value="' .
            $user["StsUser"] .
            '">
                                </div>
                            </div>

                            <div class="mb-3">
                            <label class="form-label" for="KdKantor">KdKantor : </label>
                            <div class="form-outline">
                                <input type="text" id="KdKantor" name="KdKantor" class="form-control"
                                value="' .
            $user["KdKantor"] .
            '">
                            </div>
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
    echo '<div class="alert alert-warning" role="alert">Tidak ada data user</div>';
}
?>