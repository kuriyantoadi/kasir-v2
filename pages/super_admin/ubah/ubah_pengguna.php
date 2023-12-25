<?php
    include '../../../koneksi.php';
    $id_user                  = addslashes(trim($_GET['q']));
    $query                    = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
    $hasil_user               = mysqli_fetch_array($query);
    $nama_user                = $hasil_user['nama'];
    $email                    = $hasil_user['email'];
    $level                    = $hasil_user['level'];
    $status_aktif             = $hasil_user['status_aktif'];
    
?>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Nama Pengguna</label>
    <input type="hidden" class="form-control" name="id_user" value="<?= $id_user ?>" readonly required>
    <input type="text" class="form-control" name="nama" maxlength="50" placeholder="Masukan Nama Pengguna" value="<?= $nama_user ?>" required>
</div>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Email Pengguna</label>
    <input type="email" class="form-control" name="email" maxlength="50" placeholder="Masukan Email Pengguna" value="<?= $email ?>" required>
</div>
<div class="form-group">
    <label>Level Pengguna</label>
    <select class="form-control select2" style="width: 100%;" name="level" required>
        <option value="<?= $level ?>" selected="selected"><?php if ($level == 1) { echo 'Superadmin'; } else if ($level == 2) { echo 'Kasir'; } else if ($level == 3) { echo 'Investor'; } else { echo 'Terjadi Gangguan'; } ?></option>
        <option value="2">Kasir</option>
        <option value="1">Superadmin</option>
        <option value="3">Investor</option>
    </select>
</div>
<div class="form-group">
    <label>Status Pengguna</label>
    <select class="form-control select2" style="width: 100%;" name="status_aktif" required>
        <option value="<?= $status_aktif ?>" selected="selected"><?php if ($status_aktif == 1) { echo 'Aktif'; } else if ($status_aktif == 2) { echo 'Tidak Aktif'; } else { echo 'Terjadi Gangguan'; } ?></option>
        <option value="1">Aktif</option>
        <option value="2">Tidak Aktif</option>
    </select>
</div>