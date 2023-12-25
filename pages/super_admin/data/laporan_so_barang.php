  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master So Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Laporan So Produk</li>
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
            <div class="card">
              <div class="card-header">
                Laporan So Produk
              </div>
              <!-- /.card-header -->
              <form action="laporan/laporan_so_barang.php" target="_blank" methon="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <select class="form-control select2" style="width: 100%;" name="kategori_produk" required>
                                <option value="" selected>Pilih Kategori Produk</option>
                                <?php 
                                    $query_kategori   = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status_kategori ='1' ORDER BY nama_kategori ASC");
                                    $no       = 1; // nomor baris
                                    while ($r = mysqli_fetch_array($query_kategori)) {
                                    $no++;
                                    ?>
                                    <option value="<?= $r['id_kategori'];?>"><?= $r['nama_kategori'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="lihat_dan_cetak" class="form-control btn bg-gradient-primary"><i class="fa fa-print"></i> Lihat Dan Cetak Data</button>
                        </div>
                    </div>
                </div>
              </form>
              <!-- /.card-body -->
            </div>
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