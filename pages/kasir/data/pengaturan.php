  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengaturan Toko</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Pengaturan Toko</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Toko</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="proses/proses_pengaturan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Toko</label>
                    <input type="text" name="nama" maxlength="25" class="form-control" id="exampleInputEmail1" value="<?= $nama_website ?>" placeholder="Masukan Nama Toko Anda" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Toko</label>
                    <input type="text" name="alamat" class="form-control" id="exampleInputEmail1" value="<?= $alamat_website ?>" placeholder="Masukan Alamat Toko Anda" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">No Telepon Toko</label>
                    <input type="text" name="no_telepon" class="form-control" id="exampleInputEmail1" value="<?= $no_telepon_website ?>" placeholder="Masukan No Telepon Toko" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email Toko</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?= $email_website ?>" placeholder="Masukan Email Aktif T"oko required>
                  </div>
                  <div class="form-group">
                    <label for="customFile">Logo Toko</label>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" id="foto">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <small>Jika logo tidak di ubah maka kosongkan saja</small>
                    <br>
                    <small>* Pastikan ukuran foto 50 x 50</small>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="update_toko" class="btn btn-primary">Perbaharui Data Diri Toko</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->