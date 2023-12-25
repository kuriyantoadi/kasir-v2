  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
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
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Produk Baru</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table" class="table table-striped table-bordered" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori Produk</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Diproses Oleh</th>
                    <th>Tanggal Input</th>
                    <th><center>Status Produk</center></th>
                    <th><center>Aksi</center></th>
                  </tr>
                  </thead>
                  <tbody>
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
          <h4 class="modal-title">Tambah Produk</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_produk.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Produk</label>
              <input type="text" class="form-control" name="nama_produk" id="nama_produk" maxlength="50" placeholder="Masukan Nama Kategori" required>
              <span id="pesan_nama_produk"></span>
            </div>
            <div class="form-group">
              <label>Kategori Produk</label>
              <select class="form-control select2" style="width: 100%;" name="kategori_produk" required>
                <?php 
                    $query_kategori   = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status_kategori ='1' ORDER BY nama_kategori ASC");
                    $no       = 1; // nomor baris
                    while ($r = mysqli_fetch_array($query_kategori)) {
                    $no++;
                    ?>
                    <option  value="<?= $r['id_kategori'];?>"><?= $r['nama_kategori'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Harga Jual</label>
              <input type="text" class="form-control" name="harga" maxlength="12" placeholder="Masukan Harga Jual" onkeypress="return hanyaAngka(event)" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Stok</label>
              <input type="text" class="form-control" name="stok" maxlength="12" placeholder="Masukan Stok" onkeypress="return hanyaAngka(event)" required>
            </div>
            <div class="form-group">
              <label>Status Produk</label>
              <select class="form-control select2" style="width: 100%;" name="status_aktif" required>
                <option value="1" selected="selected">Ready Stok</option>
                <option value="2">Stok Habis</option>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
  <!--------------------------- MODAL --------------------------->
  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi hapus data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_produk.php" method="post">
          <div class="modal-body">
            Apa anda yakin ingin menghapus data ?
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" id="key_produk" name="key_produk" value="">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--------------------------- END MODAL --------------------------->
  <!--------------------------- MODAL --------------------------->
  <div class="modal fade" id="ubah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_produk.php" method="post">
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
        function ubahdata(key_produk){
            var ajaxbos = new XMLHttpRequest();
                ajaxbos.onreadystatechange= function(){
                    if(ajaxbos.readyState==4 && ajaxbos.status==200){
                        document.getElementById("dub").innerHTML= ajaxbos.responseText;
                    }
                };
                ajaxbos.open("GET","ubah/ubah_produk.php?q="+key_produk+"&s=#",true);
                ajaxbos.send();
            }
        function hapusdata(key_produk){
            document.getElementById('key_produk').value=key_produk;
        }
  </script>

  <script> 
       $(function(){
  
            $('.table').DataTable({
               "responsive": true,
               "processing": true,
               "serverSide": true,
               "ajax":{
                        "url": "ajax/ajax_produk.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                      },
               "columns": [
                   { "data": "no" },
                   { "data": "nama_produk" },
                   { "data": "id_kategori_produk" },
                   { "data": "harga_produk" },
                   { "data": "stok" },
                   { "data": "diproses_oleh" },
                   { "data": "date_created" },
                   { "data": "status_produk" },
                   { "data": "aksi" },
               ]  
  
           });
         });
 
 </script>