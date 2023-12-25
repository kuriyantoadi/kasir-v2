  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
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
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Pengguna Baru</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th><center>Level</center></th>
                    <th><center>Status Aktif</center></th>
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
          <h4 class="modal-title">Tambah Pengguna Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_pengguna.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Username</label>
              <input type="text" class="form-control" name="username" id="username" maxlength="10" placeholder="Masukan Username Baru" required>
              <span id="pesan_username"></span>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" maxlength="25" placeholder="Masukan Nama Pengguna Baru" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Masukan Email Pengguna Baru" required>
              <span id="pesan_email"></span>
            </div>
            <div class="form-group">
              <label>Level Pengguna</label>
              <select class="form-control select2" style="width: 100%;" name="level" required>
                <option value="2" selected="selected">Kasir</option>
                <option value="1">Superadmin</option>
                <option value="3">Investor</option>
              </select>
            </div>
            <div class="form-group">
              <label>Status Pengguna</label>
              <select class="form-control select2" style="width: 100%;" name="status_aktif" required>
                <option value="1" selected="selected">Aktif</option>
                <option value="2">Blokir</option>
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
  <div class="modal fade" id="ubah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_pengguna.php" method="post">
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
        function ubahdata(id_user){
            var ajaxbos = new XMLHttpRequest();
                ajaxbos.onreadystatechange= function(){
                    if(ajaxbos.readyState==4 && ajaxbos.status==200){
                        document.getElementById("dub").innerHTML= ajaxbos.responseText;
                    }
                };
                ajaxbos.open("GET","ubah/ubah_pengguna.php?q="+id_user+"&s=#",true);
                ajaxbos.send();
            }
  </script>

  <script> 
       $(function(){
  
            $('.table').DataTable({
               "responsive": true,
               "processing": true,
               "serverSide": true,
               "ajax":{
                        "url": "ajax/ajax_pengguna.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                      },
               "columns": [
                   { "data": "no" },
                   { "data": "username" },
                   { "data": "nama" },
                   { "data": "email" },
                   { "data": "level" },
                   { "data": "status_aktif" },
                   { "data": "id_user" },
               ]  
  
           });
         });
 
 </script>