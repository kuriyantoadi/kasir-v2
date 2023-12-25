  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Uang Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Uang Keluar</li>
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
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Uang Keluar</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>Kode Transaksi</th>
                      <th>Nama Barang/Jasa</th>
                      <th>Jumlah Uang</th>
                      <th>Tanggal Uang Keluar</th>
                      <th><center>Aksi</center></th>
                    </tr>
                    </thead>
                  <tbody>
                    <?php 
                        $query_uang_keluar                = mysqli_query($koneksi, "SELECT * FROM t_uang_keluar");
                        while ($hasil_uang_keluar         = mysqli_fetch_array($query_uang_keluar)) {
                        $id_uang_keluar                   = $hasil_uang_keluar['id_uang_keluar'];
                        $kode_transaksi                 = $hasil_uang_keluar['kode_transaksi'];
                        $nama_barang               = $hasil_uang_keluar['nama_barang'];
                        $jumlah_uang               = $hasil_uang_keluar['jumlah_uang'];
                        $tanggal_uang_keluar               = $hasil_uang_keluar['tanggal_uang_keluar'];
                        $diproses_oleh                      = $hasil_uang_keluar['diproses_oleh'];
                    ?>
                        <tr>
                            <td><?= $kode_transaksi ?></td>
                            <td><?= $nama_barang ?></td>
                            <td><?= 'Rp. '.number_format($jumlah_uang) ?></td>
                            <td><?= tglblnthn($tanggal_uang_keluar) ?></td>
                            <td>
                                <center>
                                    <button type="button" class="btn btn-group btn-success btn-sm" value='<?php echo $id_uang_keluar ?>' onclick="ubahdata(this.value)" data-toggle="modal" data-target="#ubah">Edit</button>
                                </center>
                            </td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
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
  <!--------------------------- MODAL --------------------------->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Uang Keluar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_barang_keluar.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label>Tanggal Uang Keluar</label>
              <input name="tanggal_uang_keluar" type="date" class="form-control" maxlength="150" required="">
            </div>
            <div class="form-group">
              <label>Kode Transaksi/No Invoice</label>
              <input name="kode_transaksi" type="text" class="form-control" placeholder="Masukkan Kode Transaksi/No Invoice" maxlength="50" required="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input name="nama_barang" type="text" class="form-control" placeholder="Masukkan Nama" maxlength="150" required="">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Jumlah Uang Keluar</label>
              <input type="text" class="form-control" name="jumlah_uang" maxlength="10" placeholder="Masukan Jumlah Uang Keluar" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="tambah_uang_keluar" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
  <div class="modal fade" id="ubah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Data Uang Keluar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_barang_keluar.php" method="post">
          <div class="modal-body">
            <span id="dub"></span>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="ubah" class="btn btn-primary">Perbaharui</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--------------------------- END MODAL --------------------------->
  <script>
        function ubahdata(id_uang_keluar){
            var ajaxbos = new XMLHttpRequest();
                ajaxbos.onreadystatechange= function(){
                    if(ajaxbos.readyState==4 && ajaxbos.status==200){
                        document.getElementById("dub").innerHTML= ajaxbos.responseText;
                    }
                };
                ajaxbos.open("GET","ubah/ubah_uang_keluar.php?q="+id_uang_keluar+"&s=#",true);
                ajaxbos.send();
            }
  </script>
