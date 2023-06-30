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
    <title>update</title>
    <link rel="stylesheet" href="css/upload.css">
</head>

<body>
    <h1>Dasboard Edit Barang</h1>
    <?php
    function readDataFromDB($filename)
    {
        $data = file_get_contents($filename); // Read the entire file
        $dataArray = unserialize($data); // Convert data to an array

        return $dataArray;
    }

    $filename = 'database/database.db';
    if (file_exists($filename)) {
        $database = readDataFromDB($filename);
    } else {
        $database = [];
    }

    // Get the product name to search for
    $nama = htmlspecialchars($_GET['produc']);
    $idCari = $nama;

    // Find data based on the product name
    $result = array_filter($database, function ($data) use ($idCari) {
        return $data['id'] === $idCari;
    });

    if (!empty($result)) {
        foreach ($result as $key => $data) {
            if (isset($_POST['update'])) {
                $namabarang = $_POST['nama_barang'];
                $harga = $_POST['harga_barang'];
                $des = $_POST['deskripsi_barang'];
                $gambar = $_FILES['gambar_barang']['name'];
                $tmp = $_FILES['gambar_barang']['tmp_name'];
                $folder = "product/";

                function saveDataToDB($filename, $data)
                {
                    $serializedData = serialize($data); // Convert array to serialized data
                    file_put_contents($filename, $serializedData); // Save data to file
                }

                // Update the found data
                $database[$key]['namab'] = $namabarang;
                $database[$key]['harga'] = $harga;
                $database[$key]['des'] = $des;

                if ($gambar != false) {
                    foreach ($result as $data) {
                        unlink("product/" . $data['gambar']);
                    }
                    move_uploaded_file($tmp, $folder . $gambar);
                    $database[$key]['gambar'] = $gambar;
                }

                saveDataToDB($filename, $database); // Save the updated data to the file
                echo ("<script LANGUAGE='JavaScript'>
                window.alert('Succesfully Updated');
                window.location.href='./';
                </script>");
            }
    ?>

            <form name="barangForm" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" id="nama_barang" name="nama_barang" value="<?= $data['namab'] ?>" required>

                <label for="harga_barang">Harga Barang:</label>
                <input type="text" id="harga_barang" name="harga_barang" pattern="[0-9]+" value="<?= $data['harga'] ?>" required>

                <label for="deskripsi_barang">Deskripsi Barang:</label>
                <textarea id="deskripsi_barang" name="deskripsi_barang" required><?= $data['des'] ?></textarea>

                <div class="image-preview">
                    <label for="gambar_barang">Gambar Barang:</label>
                    <input type="file" id="gambar_barang" name="gambar_barang" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                    <div id="image-preview"></div>
                </div>

                <input type="submit" name="update" value="Update">
            </form>
    <?php
        }
    } else {
        echo "Data with name '$idCari' not found.";
    }
    ?>

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
            var description = document.forms["barangForm"]["deskripsi_barang"].value;

            if (name == "") {
                alert("Nama barang harus diisi");
                return false;
            }

            if (price == "") {
                alert("Harga barang harus diisi");
                return false;
            }

            if (description == "") {
                alert("Deskripsi barang harus diisi");
                return false;
            }
        }
    </script>

</body>

</html>