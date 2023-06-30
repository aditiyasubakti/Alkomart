<?php
session_start();
$session = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/colom.css">
    <link rel="stylesheet" href="css/check.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/start.css">


    <link rel="icon" href="img/icon.png">
    <title>Alkomart</title>
</head>

<body>

    <nav>
        <ul>
            <a href="./"><img class="logo" src="img/Alkomart.png" alt="Alkomart"></a>
        </ul>
        <ul>
            <li>
                <div class="line">
                    <hr>
                    <hr>
                    <hr>
                </div>
                <ul>
                    <li><a class="navbar nav-a" href="./">Home</a></li>
                    <li><a class="navbar nav-a " href="about.html">About</a></li>
                    <li><a class="navbar nav-a" href="#">Product</a></li>
                    <li><a class="navbar nav-a" href="#">Contact</a></li>
                </ul>
            </li>
            <li class="search">
                <form method="get">
                    <div class="search-box">
                        <input type="text" placeholder="Search....">
                        <button type="submit">Search</button>
                    </div>
                </form>

            </li>
        </ul>
    </nav>
    <main>

        <?php
        function readDataFromDB($filename)
        {
            $data = file_get_contents($filename); // Membaca seluruh isi file
            $dataArray = unserialize($data); // Mengubah data menjadi array

            return $dataArray;
        }

        $filename = 'database/database.db';
        if (file_exists($filename)) {
            $database = readDataFromDB($filename);
        } else {
            $database = [];
        }

        // Nama yang akan dicari

        $nama = htmlspecialchars($_GET['produc']);
        $namaCari = $nama;

        // Mencari data berdasarkan nama
        $result = array_filter($database, function ($data) use ($namaCari) {
            return $data['id'] === $namaCari;
        });

        ?>
        <section class="check">
            <?php if (!empty($result)) {
                foreach ($result as $data) {
            ?>
                    <img class="img-gambar" src="product/<?= $data['gambar'] ?>" alt="">
                    <div class="check-col">
                        <h2><?= $data['namab']; ?></h2>
                        <div class="stars">
                            <a class="rating" href="">4.4</a>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                            <div class="star"></div>
                        </div>
                        <strong class="cash">Rp.<?= $data['harga'] ?></strong>
                        <br>
                        <br>
                        <p>Diskon : 50%</p>
                        <br>
                        <p>Berat : 20kg | 30kg | 60kg</p>
                        <p><?= $data['des']; ?></p>
                        <div class="roll">
                            <button class="buy">Beli</button>
                            <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) { ?>
                                <a href="login.php">
                                    <div class="cart-icon">
                                        <span class="item-count">0</span>

                                    </div>
                                </a>
                            <?php } else { ?>
                                <?php

                                if (!isset($_SESSION['hasil'])) {
                                    $_SESSION['hasil'] = 0; // Initialize the session variable if it doesn't exist
                                }

                                if (isset($_POST['tambah'])) {
                                    $a = $_POST['n'];
                                    $_SESSION['hasil'] += $a; // Update the session variable
                                }
                                $hasil = $_SESSION['hasil']; // Get the updated value from the session

                                ?>

                                <form method="post">
                                    <input type="hidden" name="n" value="1">
                                    <button name="tambah">
                                        <div class="cart-icon">
                                            <span class="item-count"><?= $hasil; ?></span>
                                        </div>
                                    </button>

                                </form>
                                <a href="logout.php">Logout</a>
                            <?php } ?>
                            <div>
                                <?php if ($session == "aditiyatampan@gmail.com") : ?>
                                    <a href="update.php?produc=<?= $data['id'] ?>">edit</a>|
                                    <a href="">hapus</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "Data dengan nama '$namaCari' tidak ditemukan.";
            }
            ?>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer">
                <p><b>Layanan Pelanggan</b></p>
                <p class="newLine"><a class="fonts" href="#">Bantuan</a></p>
                <p class="newLine"><a class="fonts" href="#">Metode Pembayaran</a></p>
                <p class="newLine"><a class="fonts" href="#">AlkomartPay</a></p>
                <p class="newLine"><a class="fonts" href="#">Koin</a></p>
                <p class="newLine"><a class="fonts" href="#">Hubungi Kami</a></p>
            </div>
            <div class="footer">
                <p><b>Jelajahi</b></p>
                <p class="newLine"><a class="fonts" href="#">Tentang Kami</a></p>
                <p class="newLine"><a class="fonts" href="#">Karir</a></p>
                <p class="newLine"><a class="fonts" href="#">Blog</a></p>
                <p class="newLine"><a class="fonts" href="#">Kontak Media</a></p>

            </div>
            <div class="footer">
                <p><b>Pembayaran</b></p>
                <div class="colom-img">
                    <img src="icon/pembayaran/BRI.jpg" width="30" alt="">
                    <img src="icon/pembayaran/mandiri.jpg" width="30" alt="">
                    <img src="icon/pembayaran/BNI.jpg" width="30" alt="">
                </div>
                <div class="colom-img">
                    <img src="icon/pembayaran/BRI.jpg" width="30" alt="">
                    <img src="icon/pembayaran/mandiri.jpg" width="30" alt="">
                    <img src="icon/pembayaran/BNI.jpg" width="30" alt="">

                </div>
            </div>
            <div class="footer">
                <p><b>Ikuti Kami</b></p>
                <p><img src="icon/medsos/facebook.png" width="30" alt="logo"> Facebook</p>
                <p><img src="icon/medsos/instagram.png" width="30" alt="logo"> Instagram</p>
                <p><img src="icon/medsos/twitter.png" width="30" alt="logo"> Twitter</p>

            </div>
            <div class="footer">
                <p><b>Download Aplikasi Alkomart</b></p>
                <br>
                <p><a href="">https//www.playstore.com/Alkomart</a></p>
            </div>
        </div>
        <div id="line-footer">
            <div class="garis"></div>
        </div>
        <div class="footer-content-c">
            <p class="copyraght"><i>© Alkomart 2023. Hak Cipta Dilindungi</i></p>
            <p class="copyraght">Negara:<a class="fonts" href="">Indonesia</a> | <a class="fonts" href="">Malaysia</a> |
                <a class="fonts" href="">Taiwan</a> | <a class="fonts" href="">Singapura</a> |
                <a class="fonts" href="">Thailand</a> | <a class="fonts" href="">Filipina</a> |
                <a class="fonts" href="">Vietnam</a>
            </p>
        </div>

    </footer>

</body>

</html>