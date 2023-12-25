  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Kategori Baru</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th><center>Status Kategori</center></th>
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
          <h4 class="modal-title">Tambah Kategori Produk</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_kategori.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Kategori</label>
              <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" maxlength="50" placeholder="Masukan Nama Kategori" required>
              <span id="pesan_nama_kategori"></span>
            </div>
            <div class="form-group">
              <label>Status Kategori</label>
              <select class="form-control select2" style="width: 100%;" name="status_aktif" required>
                <option value="1" selected="selected">Aktif</option>
                <option value="2">Tidak Aktif</option>
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
        <form action="proses/proses_kategori.php" method="post">
          <div class="modal-body">
            Apa anda yakin ingin menghapus data ?
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" id="key_kategori" name="key_kategori" value="">
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
        <form action="proses/proses_kategori.php" method="post">
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
        function ubahdata(key_kategori){
            var ajaxbos = new XMLHttpRequest();
                ajaxbos.onreadystatechange= function(){
                    if(ajaxbos.readyState==4 && ajaxbos.status==200){
                        document.getElementById("dub").innerHTML= ajaxbos.responseText;
                    }
                };
                ajaxbos.open("GET","ubah/ubah_kategori.php?q="+key_kategori+"&s=#",true);
                ajaxbos.send();
            }
        function hapusdata(key_kategori){
            document.getElementById('key_kategori').value=key_kategori;
        }
  </script>
 
  <script> 
       $(function(){
  
            $('.table').DataTable({
               "responsive": true,
               "processing": true,
               "serverSide": true,
               "ajax":{
                        "url": "ajax/ajax_kategori.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                      },
               "columns": [
                   { "data": "no" },
                   { "data": "nama_kategori" },
                   { "data": "status_kategori" },
                   { "data": "aksi" },
               ]  
  
           });
         });
 
 </script>