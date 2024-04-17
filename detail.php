<?php

include('config/db.php');
include('models/DB.php');
include('models/Maker.php');
include('models/Steel.php');
include('models/Knife.php');
include('models/Template.php');

$knife = new Knife($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$knife->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $knife->getKnifeById($id);
        $row = $knife->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['knife_name'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['knife_pic'] . '" class="img-thumbnail" alt="' . $row['knife_pic'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['knife_code'] . '</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>' . $row['knife_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Material</td>
                                    <td>:</td>
                                    <td>' . $row['knife_material'] . '</td>
                                </tr>
                                <tr>
                                    <td>Steel</td>
                                    <td>:</td>
                                    <td>' . $row['steel_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Maker</td>
                                    <td>:</td>
                                    <td>' . $row['maker_name'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="#"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="#"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$knife->close();
$detail = new Template('views/skindetail.html');
$detail->replace('DATA_DETAIL_KNIFE', $data);
$detail->write();
