  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Laporan Barang Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Laporan Barang Masuk</li>
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
                Laporan Barang Masuk Perhari
              </div>
              <!-- /.card-header -->
              <form action="laporan/laporan_barang_masuk_perhari.php" target="_blank" methon="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <input type="date" class="form-control" name="tanggal" maxlength="12" placeholder="Pilih tanggal transaksi" required>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                Laporan Barang Masuk Perbulan
              </div>
              <!-- /.card-header -->
              <form action="laporan/laporan_barang_masuk_perbulan.php" target="_blank" methon="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <!-- select -->
                            <div class="form-group">
                                <select class="form-control" name="bulan" required>
                                    <option value="">- Pilih Bulan -</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- select -->
                            <div class="form-group">
                                <?php
                                    $now=date('Y');
                                    echo "<select name='tahun' class='form-control' required>";
                                    echo "<option value=''>- Pilih Tahun -</option>";
                                    for ($a=2020;$a<=$now;$a++)
                                    {
                                    echo "<option value='$a'>$a</option>";
                                    }
                                    echo "</select>";
                                ?>
                            </div>
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