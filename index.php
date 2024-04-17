<?php

include('config/db.php');
include('models/DB.php');
include('models/Maker.php');
include('models/Steel.php');
include('models/Knife.php');
include('models/Template.php');

// buat instance knife
$listKnife = new Knife($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listKnife->open();
// tampilkan data knife
$listKnife->getKnifeJoin();

// cari knife
if (isset($_POST['btn-cari'])) {
    // methode mencari data knife
    $listKnife->searchKnife($_POST['cari']);
} else {
    // method menampilkan data knife
    $listKnife->getKnifeJoin();
}

$data = null;

// ambil data knife
// gabungkan dgn tag html
// untuk di passing ke skin/view
while ($row = $listKnife->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 knife-thumbnail">
        <a href="detail.php?id=' . $row['knife_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['knife_pic'] . '" class="card-img-top" alt="' . $row['knife_pic'] . '">
            </div>
            <div class="card-body">
                <p class="card-text knife-name my-0">' . $row['knife_name'] . '</p>
                <p class="card-text maker-name">' . $row['maker_name'] . '</p>
                <p class="card-text steel-name my-0">' . $row['steel_name'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listKnife->close();

// buat instance view
$home = new Template('views/skin.html');

// simpan data ke view
$home->replace('DATA_KNIFE', $data);
$home->write();
