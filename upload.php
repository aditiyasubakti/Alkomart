<?php
if ($_SESSION['username'] != "aditiyatampan@gmail.com") {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input data</title>
    <link rel="stylesheet" href="css/upload.css">
</head>
<?php $id = base64_encode(rand()); ?>

<body>
    <h1>Dasboard input Barang</h1>
    <form name="barangForm" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required>

        <label for="harga_barang">Harga Barang:</label>
        <input type="text" id="harga_barang" name="harga_barang" pattern="[0-9]+" required>

        <label for="deskripsi_barang">Deskripsi Barang:</label>
        <textarea id="deskripsi_barang" name="deskripsi_barang" required></textarea>

        <div class="image-preview">
            <label for="gambar_barang">Gambar Barang:</label>
            <input type="file" id="gambar_barang" name="gambar_barang" required accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
            <div id="image-preview"></div>
        </div>

        <input type="submit" name="simpan" value="Submit">
    </form>
</body>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('image-preview');
            var image = new Image();
            image.src = reader.result;
            image.style.width = "100px";
            image.style.height = "100px";
            preview.innerHTML = '';
            preview.appendChild(image);
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function validateForm() {
        var name = document.forms["barangForm"]["nama_barang"].value;
        var price = document.forms["barangForm"]["harga_barang"].value;
        var image = document.forms["barangForm"]["gambar_barang"].value;
        var description = document.forms["barangForm"]["deskripsi_barang"].value;

        if (name == "") {
            alert("Nama barang harus diisi");
            return false;
        }

        if (price == "") {
            alert("Harga barang harus diisi");
            return false;
        }

        if (image == "") {
            alert("Gambar barang harus diunggah");
            return false;
        }

        if (description == "") {
            alert("Deskripsi barang harus diisi");
            return false;
        }
    }
</script>

</html>
<?php
if (isset($_POST['simpan'])) {
    $nameba = $_POST['nama_barang'];
    $harga = $_POST['harga_barang'];
    $des = $_POST['deskripsi_barang'];
    $gambarname = $_FILES['gambar_barang']['name'];
    $tmp = $_FILES['gambar_barang']['tmp_name'];
    $tipe = $_FILES['gambar_barang']['type'];
    $folder = "product/";

    $upload = move_uploaded_file($tmp, $folder . $gambarname);
    if ($upload) {
        // Fungsi untuk membaca data dari file database
        function readDataFromDB($filename)
        {
            $data = file_get_contents($filename); // Membaca seluruh isi file
            $dataArray = unserialize($data); // Mengubah data menjadi array

            return $dataArray;
        }

        // Fungsi untuk menulis data ke file database
        function writeDataToDB($filename, $dataArray)
        {
            $data = serialize($dataArray); // Mengubah array menjadi data serial
            file_put_contents($filename, $data); // Menulis data ke file
        }

        // Nama file database
        $filename = 'database/database.db';

        // Membaca data dari file database (jika ada)
        $database = [];
        if (file_exists($filename)) {
            $database = readDataFromDB($filename);
        }

        // Melakukan operasi database
        // Misalnya, menambahkan data baru
        $newData = [
            'id' => $id,
            'namab' => $nameba,
            'harga' => $harga,
            'des' => $des,
            'gambar' => $gambarname
        ];

        $database[] = $newData;

        // Menulis data ke file database
        writeDataToDB($filename, $database);
        echo ("<script LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated');
    window.location.href='upload.php';
    </script>");
    }
}



?>