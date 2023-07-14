<?php
require_once "../config/server.php";

$url = $baseUrl . "kewenangan";
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

    foreach ($data["data"] as $kewenangan) {
        echo "<tr>";
        echo "<td class='text-center'>" . $nomor . "</td>"; // add the number column
        echo "<td class='text-center'>" . $kewenangan["GroupID"] . "</td>";
        echo "<td class='text-center'>" . $kewenangan["MenuID"] . "</td>";
        echo "<td class='text-center'>" . $kewenangan["IsCreated"] . "</td>";
        echo "<td class='text-center'>" . $kewenangan["IsUpdated"] . "</td>";
        echo "<td class='text-center'>" . $kewenangan["IsDeleted"] . "</td>";

        echo '<td>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-danger" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#deleteKewenangan' .
            $kewenangan["GroupID"] .
            '"><i class="fas fa-trash"></i> </button>

                <div class="modal fade" id="deleteKewenangan' .
            $kewenangan["GroupID"] .
            '" tabindex="-1" aria-labelledby="deleteKewenangan" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteKewenangan">Modal title</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">Apakah yakin ingin menghapus data kewenangan ini?</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Batal</button>
                                <form method="POST" action="../actions/kewenangan/delete_kewenangan.php">
                                    <input type="hidden" name="GroupID" value="' .
            $kewenangan["GroupID"] .
            '">
                                    <button type="submit" class="btn btn-danger" >Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-link btn-rounded btn-sm fw-bold text-warning" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#editKewenangan' .
            $kewenangan["GroupID"] .
            '">  <i class="fas fa-edit"></i> </button>

                <div class="modal fade" id="editKewenangan' . $kewenangan["GroupID"] . '" tabindex="-1" aria-labelledby="editKewenangan" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editKewenangan">Edit kewenangan</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="../actions/kewenangan/put_kewenangan.php" enctype="multipart/form-data">
                                    <div class="mb-3" style="display:none;">
                                        <label class="form-label" for="GroupID">ID :</label>
                                        <div class="form-outline">
                                            <input type="hidden" id="GroupID" name="GroupID" class="form-control" value="' . $kewenangan["GroupID"] . '">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="MenuID">Menu :</label>
                                        <select class="form-select" name="MenuID" aria-label="Default select example">';

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

        $dataMenu = json_decode($response, true);

        if (isset($dataMenu["data"])) {
            foreach ($dataMenu["data"] as $menu) {
                $selected = ($menu["MenuID"] == $kewenangan["MenuID"]) ? "selected" : ""; // Check if this option is selected
                $optionValue = $menu["MenuID"];
                $optionText = $menu["MenuID"] . " - " . $menu["MenuNama"];
                echo "<option value='" . $optionValue . "' data-menunama='" . $menu["MenuNama"] . "' $selected>" . $optionText . "</option>";
            }
        } else {
            echo '<option value="" disabled selected>Tidak ada data menu</option>';
        }

        echo '
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="IsCreated">IsCreated :</label>
                                        <div class="form-outline">
                                            <input type="text" id="IsCreated" name="IsCreated" class="form-control" value="' . $kewenangan["IsCreated"] . '">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="IsUpdated">IsUpdated :</label>
                                        <div class="form-outline">
                                            <input type="text" id="IsUpdated" name="IsUpdated" class="form-control" value="' . $kewenangan["IsUpdated"] . '">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="IsDeleted">IsDeleted :</label>
                                        <div class="form-outline">
                                            <input type="text" id="IsDeleted" name="IsDeleted" class="form-control" value="' . $kewenangan["IsDeleted"] . '">
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
                </div>
            </td>';
        echo "</tr>";
        $nomor++; // increment the variable
    }
} else {
    echo '<div class="alert alert-warning" role="alert">Tidak ada data kewenangan</div>';
}
?>