  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Transaksi</li>
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
              <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Info!</h5>
                Gunakan fitur search berasarkan <b>kode keranjang</b> saja.
              </div>
                <a href="index.php?hal=menu_keranjang" class="btn bg-gradient-primary"><i class="fa fa-plus"></i> Tambah Transaksi Baru</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Kode Keranjang</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Diproses Oleh</th>
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
  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi hapus data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_transaksi.php" method="post">
          <div class="modal-body">
            Apa anda yakin ingin menghapus data ?
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" id="kode_keranjang" name="kode_keranjang" value="">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="hapus_transaksi" class="btn btn-primary">Hapus</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--------------------------- END MODAL --------------------------->
  <script>
    function hapusdata(kode_keranjang){
        document.getElementById('kode_keranjang').value=kode_keranjang;
    }
  </script>

  <script> 
       $(function(){
  
            $('.table').DataTable({
               "responsive": true,
               "processing": true,
               "serverSide": true,
               "ajax":{
                        "url": "ajax/ajax_transaksi.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                      },
               "columns": [
                   { "data": "no" },
                   { "data": "tanggal_transaksi" },
                   { "data": "kode_keranjang" },
                   { "data": "jumlah_yang_dibeli" },
                   { "data": "total_harga" },
                   { "data": "nama" },
                   { "data": "aksi" },
               ]  
  
           });
         });
 </script>