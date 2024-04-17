<?php

include('config/db.php');
include('models/DB.php');
include('models/Steel.php');
include('models/Template.php');

$steel = new Steel($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$steel->open();
$steel->getSteel();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($steel->addSteel($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'steel.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'steel.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('views/skintabel.html');

$mainTitle = 'Steel';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Steel</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'steel';

while ($div = $steel->getResult()) {
    $data .= '<tr>
        <th scope="row">' . $no . '</th>
        <td>
            <form method="post" action="steel.php?id=' . $div['steel_id'] . '">
                <input type="hidden" name="steel_id" value="' . $div['steel_id'] . '">
                <input type="text" name="steel_name" value="' . $div['steel_name'] . '">
        </td>
        <td style="font-size: 22px;">
            <button type="submit" name="edit" class="btn btn-link" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></button>
            <a href="steel.php?hapus=' . $div['steel_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
            </form>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($steel->updateSteel($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'steel.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'steel.php';
            </script>";
            }
        }

        $steel->getSteelById($id);
        $row = $steel->getResult();

        $dataUpdate = $row['steel_name'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($steel->deleteSteel($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'steel.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'steel.php';
            </script>";
        }
    }
}

$steel->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
