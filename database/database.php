<?php
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
$filename = 'database1.db';

// Membaca data dari file database (jika ada)
//$database = [];
if (file_exists($filename)) {
    $database = readDataFromDB($filename);
}

// Melakukan operasi database
// Misalnya, menambahkan data baru
// $newData = [
//     'nama' => 'Aditiya subakti',
//     'umur' => 25,
//     'pekerjaan' => 'Developer'
// ];

// $database[] = $newData;

// Menulis data ke file database
writeDataToDB($filename, $database);

// Menggunakan data dari file database
error_reporting(0);

foreach ($database as $data) {
    if ($data['nama']) {
        echo "Nama: " . $data['nama'] . "<br>";
        echo "Umur: " . $data['umur'] . "<br>";
        echo "Pekerjaan: " . $data['pekerjaan'] . "<br><br>";
    }
}
