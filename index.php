<?php require "layout/header.php" ?>
<div class="container">
    <div class="promo">
        <div class="promo-image">
            <img class="img-promo" src="img/produc/AlkoJSM.png" alt="Promo Image">
        </div>
        <div class="promo-text">
            <h2>Dapatkan Diskon 20%</h2>
            <p>Gunakan kode promo <strong>DISKON 20%</strong> pada saat checkout</p>
            <a href="#" class="promo-button">Diskon 20%</a>
        </div>
    </div>
</div>

<p class="category">Kategori</p>

<section>
    <div class="warp">
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/Lays.png" width="100" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/Lays.png" width="100" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
    </div>
    <div class="warp">
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/Lays.png" width="100" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
        <div class="col"><img src="product/cheetos.png" width="70" alt=""></div>
    </div>
</section>
<!-- kontent -->
<section class="wrap-content">
    <header>
        <h1 class="tls">REKOMENDASI</h1>
        <div class="header-line"></div>
    </header>
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
    }
    error_reporting(0);
    $baris = 4;
    $kolom = 7; ?>
    <?php for ($i = 0; $i < $kolom; $i++) : ?>
        <div class="content">
            <?php for ($l = 0; $l < $baris; $l++) : ?>
                <?php if (isset($database[$i * $baris + $l])) : ?>
                    <?php $data = $database[$i * $baris + $l]; ?>
                    <a class="bingkai" href="check.php?produc=<?= $data['id'] ?>">
                        <img class="img-gambar" src="product/<?= $data['gambar'] ?>" alt="gambar">
                        <p class="produc-text"><?= $data['namab']; ?></p>
                        <pre><p class="cash">Rp.<?= $data['harga']; ?></p><p class="view">23rb</p></pre>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endfor; ?>

</section>
<?php require "layout/footer.php" ?>