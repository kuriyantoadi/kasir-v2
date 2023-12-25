<?php
    include '../../../koneksi.php';
    $id_keranjang                   = addslashes(trim($_GET['q']));
    $query                          = mysqli_query($koneksi, "SELECT
	* 
    FROM
	produk AS pdk
	INNER JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk WHERE krj.id_keranjang='$id_keranjang'");
    $hasil_keranjang                = mysqli_fetch_array($query);
    $nama_produk                    = $hasil_keranjang['nama_produk'];
    $qty_produk                     = $hasil_keranjang['qty_produk'];
?>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Nama Produk</label>
    <input type="hidden" class="form-control" name="id_keranjang" value="<?= $id_keranjang ?>" readonly required>
    <input type="text" class="form-control" name="nama_produk" maxlength="50" value="<?= $nama_produk ?>" readonly required>
</div>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Banyaknya</label>
    <input type="text" class="form-control" name="qty_produk" value="<?= $qty_produk ?>" maxlength="3" onkeypress="return hanyaAngka(event)" placeholder="Masukan Jumlah Yang Akan Dibeli" onkeypress="return hanyaAngka(event)" required>
</div>
