<?php
    include '../../../koneksi.php';
    $key_produk                 = addslashes(trim($_GET['q']));
    $query                      = mysqli_query($koneksi, "SELECT * FROM kategori AS ktg RIGHT JOIN produk AS pdk ON pdk.id_kategori_produk=ktg.id_kategori WHERE pdk.key_produk='$key_produk'");
    $hasil_produk               = mysqli_fetch_array($query);
    $nama_produk                = $hasil_produk['nama_produk'];
    $id_kategori_produk         = $hasil_produk['id_kategori_produk'];
    $harga_produk               = $hasil_produk['harga_produk'];
    $status_produk              = $hasil_produk['status_produk'];
    $nama_kategori              = $hasil_produk['nama_kategori'];
    
?>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Nama Produk</label>
    <input type="hidden" class="form-control" name="key_produk" value="<?= $key_produk ?>" readonly required>
    <input type="text" class="form-control" name="nama_produk" maxlength="50" placeholder="Masukan Nama Produk" value="<?= $nama_produk ?>" required>
</div>
<div class="form-group">
    <label>Kategori Produk</label>
    <select class="form-control select2" style="width: 100%;" name="kategori_produk" required>
        <option value="<?= $id_kategori_produk;?>" selected="selected"><?php if ($nama_kategori == NULL) { echo '- Silahkan Pilih Kategori Produk -'; } else { echo $nama_kategori; }?></option>
        <?php 
            $query_kategori   = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status_kategori ='1' AND id_kategori NOT IN ($id_kategori_produk) ORDER BY nama_kategori ASC");
            while ($r = mysqli_fetch_array($query_kategori)) {
            ?>
            <option value="<?= $r['id_kategori'];?>"><?= $r['nama_kategori'];?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Harga Jual</label>
    <input type="text" class="form-control" name="harga_produk" maxlength="12" placeholder="Masukan Harga Jual" onkeypress="return hanyaAngka(event)" value="<?= $harga_produk ?>" required>
</div>
<div class="form-group">
    <label>Status Produk</label>
    <select class="form-control select2" style="width: 100%;" name="status_aktif" required>
        <option value="<?= $status_produk ?>" selected="selected"><?php if ($status_produk == 1) { echo 'Ready Stok'; } else if ($status_produk == 2) { echo 'Stok Habis'; } else { echo 'Terjadi Gangguan'; } ?></option>
        <option value="1">Ready Stok</option>
        <option value="2">Stok Habis</option>
    </select>
</div>