<?php
    include '../../../koneksi.php';
    $key_kategori                 = addslashes(trim($_GET['q']));
    $query                        = mysqli_query($koneksi, "SELECT * FROM kategori WHERE key_kategori='$key_kategori'");
    $hasil_kategori               = mysqli_fetch_array($query);
    $nama_kategori                = $hasil_kategori['nama_kategori'];
    $status_kategori              = $hasil_kategori['status_kategori'];
    
?>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Nama Kategori</label>
    <input type="hidden" class="form-control" name="key_kategori" value="<?= $key_kategori ?>" readonly required>
    <input type="text" class="form-control" name="nama_kategori" maxlength="50" placeholder="Masukan Nama Kategori" value="<?= $nama_kategori ?>" required>
</div>
<div class="form-group">
    <label>Status Kategori</label>
    <select class="form-control select2" style="width: 100%;" name="status_aktif" required>
        <option value="<?= $status_kategori ?>" selected="selected"><?php if ($status_kategori == 1) { echo 'Aktif'; } else if ($status_kategori == 2) { echo 'Tidak Aktif'; } else { echo 'Terjadi Gangguan'; } ?></option>
        <option value="1">Aktif</option>
        <option value="2">Tidak Aktif</option>
    </select>
</div>