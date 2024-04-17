<?php

include('config/db.php');
include('models/DB.php');
include('models/Maker.php');
include('models/Template.php');

$maker = new Maker($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$maker->open();
$maker->getMaker();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($maker->addMaker($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'maker.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'maker.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('views/skintabel.html');

$mainTitle = 'Maker';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Maker</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'maker';

while ($div = $maker->getResult()) {
    $data .= '<tr>
        <th scope="row">' . $no . '</th>
        <td>
            <form method="post" action="maker.php?id=' . $div['maker_id'] . '">
                <input type="hidden" name="maker_id" value="' . $div['maker_id'] . '">
                <input type="text" name="maker_name" value="' . $div['maker_name'] . '">
        </td>
        <td style="font-size: 22px;">
            <button type="submit" name="edit" class="btn btn-link" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></button>
            <a href="maker.php?hapus=' . $div['maker_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
            </form>
        </td>
    </tr>';
    $no++;
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($maker->updateMaker($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'maker.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'maker.php';
            </script>";
            }
        }

        $maker->getMakerById($id);
        $row = $maker->getResult();

        $dataUpdate = $row['maker_name'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($maker->deleteMaker($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'maker.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'maker.php';
            </script>";
        }
    }
}

$maker->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
