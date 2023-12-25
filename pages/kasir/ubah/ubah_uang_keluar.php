<?php
    include '../../../koneksi.php';
    $id_uang_keluar           = addslashes(trim($_GET['q']));
    $query                    = mysqli_query($koneksi, "SELECT * FROM t_uang_keluar WHERE id_uang_keluar='$id_uang_keluar'");
    $hasil_kategori           = mysqli_fetch_array($query);
    $nama_barang              = $hasil_kategori['nama_barang'];
    $jumlah_uang              = $hasil_kategori['jumlah_uang'];
    $tanggal_uang_keluar      = $hasil_kategori['tanggal_uang_keluar'];
?>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Tanggal Uang Keluar</label>
    <input type="date" class="form-control" name="tanggal_uang_keluar" maxlength="50" value="<?= $tanggal_uang_keluar ?>" required>
</div>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Nama</label>
    <input type="hidden" class="form-control" name="id_uang_keluar" value="<?= $id_uang_keluar ?>" readonly required>
    <input type="text" class="form-control" name="nama_barang" maxlength="50" placeholder="Masukan Nama" value="<?= $nama_barang ?>" required>
</div>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Jumlah Uang</label>
    <input type="text" class="form-control" name="jumlah_uang" maxlength="50" placeholder="Masukan Jumlah Uang" value="<?= $jumlah_uang ?>" onkeypress="return hanyaAngka(event)" required>
</div>
