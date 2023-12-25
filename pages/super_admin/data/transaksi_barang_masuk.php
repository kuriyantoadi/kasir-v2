  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Barang Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Barang Masuk</li>
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
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Barang Masuk</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table" class="table table-striped table-bordered" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Banyaknya</th>
                    <th>Harga Beli Satuan</th>
                    <th>Diproses Oleh</th>
                    <th>Tanggal Input</th>
                    <!--<th><center>Aksi</center></th>-->
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
          <h4 class="modal-title">Tambah Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_barang_masuk.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Kategori</label>
              <select class="form-control" style="width: 100%;" name="id_kategori" id="get_id_kategori_nya" required>
                <option value=""> Pilih Kategori Produk</option>
              </select>
            </div>
            <div class="form-group">
              <label>Nama Produk</label>
              <select class="form-control" style="width: 100%;" name="id_produk" id="get_id_produk_nya" required>
                <option value=""> Pilih Produk</option>
              </select>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Banyaknya</label>
              <input type="text" class="form-control" name="banyaknya" maxlength="3" placeholder="Masukan Jumlah Barang Masuk" onkeypress="return hanyaAngka(event)" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Harga Beli Satuan</label>
              <input type="text" class="form-control" name="harga_beli" maxlength="10" placeholder="Masukan Harga Beli Per Satuan" onkeypress="return hanyaAngka(event)" required>
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
        <form action="proses/proses_barang_masuk.php" method="post">
          <div class="modal-body">
            Apa anda yakin ingin menghapus data ?
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" id="key_barang_masuk" name="key_barang_masuk" value="">
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
  <script>
        function hapusdata(key_barang_masuk){
            document.getElementById('key_barang_masuk').value=key_barang_masuk;
        }
  </script>

  <script> 
       $(function(){
  
            $('.table').DataTable({
               "responsive": true,
               "processing": true,
               "serverSide": true,
               "ajax":{
                        "url": "ajax/ajax_barang_masuk.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                      },
               "columns": [
                   { "data": "no" },
                   { "data": "nama_produk" },
                   { "data": "qty" },
                   { "data": "harga_per_item" },
                   { "data": "nama" },
                   { "data": "tanggal_input" },
                   //{ "data": "aksi" },
               ]  
  
           });
         });
 
  </script>
  <script type="text/javascript">
	$(document).ready(function(){
      	$.ajax({
            type: 'POST',
          	url: "../../ajax/get_kategori.php",
          	cache: false, 
          	success: function(msg){
              $("#get_id_kategori_nya").html(msg);
            }
        });
        
        $("#get_id_kategori_nya").change(function(){
      	var get_id_kategori_nya = $("#get_id_kategori_nya").val();
          	$.ajax({
          		type: 'POST',
              	url: "../../ajax/get_add_barang_masuk.php",
              	data: {get_id_kategori_nya: get_id_kategori_nya},
              	cache: false,
              	success: function(msg){
                  $("#get_id_produk_nya").html(msg);
                }
            });
        });
     });
  </script>