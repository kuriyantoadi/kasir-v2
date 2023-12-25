<?php
    $query_kode_transaksi     = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE status_keranjang='2' AND oleh='$id_dari_session_header'");
    $sql_kode_transaksi       = mysqli_fetch_array($query_kode_transaksi);
    $kode_keranjang           = $sql_kode_transaksi['kode_keranjang'];
?>
<?php
    $query_kode_total_bayar   = mysqli_query($koneksi,"SELECT
    harga_satuan,
    qty_produk,
    SUM( harga_satuan * qty_produk ) AS totalbayar,
    SUM( qty_produk ) AS jumlah_qty, 
    status_keranjang,
    oleh 
  FROM
    kategori AS ktg
    RIGHT JOIN produk AS pdk ON ktg.id_kategori = pdk.id_kategori_produk
    RIGHT JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk 
  WHERE
    krj.status_keranjang = '2' 
    AND krj.oleh = '$id_dari_session_header'");
    $sql_total_bayar          = mysqli_fetch_array($query_kode_total_bayar); 
    $total_pembayaran         = $sql_total_bayar['totalbayar'];
    $total_qty                = $sql_total_bayar['jumlah_qty'];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Keranjang Belanja <?php if ($kode_keranjang == NULL) { echo $id_dari_session_header.date('dmyhis'); } else { echo $kode_keranjang; }?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Keranjang Transaksi</li>
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
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Info!</h5>
                  Konfirmasi ulang pesanan kepada pelanggan sebelum anda menekan tombol bayar dan cetak.
                </div>
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah layanan baru kedalam keranjang</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table" class="table table-striped table-bordered" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Layanan</th>
                    <th>Kategori Layanan</th>
                    <th>Banyaknya</th>
                    <th>Harga Satuan</th>
                    <th>Total Harga</th>
                    <th><center>Aksi</center></th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" value="<?= 'Total pembayaran Rp. '.number_format($total_pembayaran) ?>" readonly>
                  <span class="input-group-append">
                    <?php
                      if ($total_pembayaran == NULL) {
                        echo '<button type="button" class="btn bg-gradient-danger" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah produk baru kedalam keranjang</button>';
                      } else { 
                        echo '<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-check-out">Check Out</button>';
                      }
                    ?>
                  </span>
                </div>
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
          <h4 class="modal-title">Tambah Layanan Kedalam Keranjang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_transaksi.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Kategori</label>
              <select class="form-control" style="width: 100%;" name="id_kategori" id="get_id_kategori_nya" required>
                <option value=""> Pilih Kategori Layanan</option>
              </select>
            </div>
            <div class="form-group">
              <label>Nama Layanan</label>
              <select class="form-control" style="width: 100%;" name="id_produk" id="get_id_produk_nya" required>
                <option value=""> Pilih Layanan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Banyaknya</label>
              <input type="text" class="form-control" name="banyaknya" maxlength="3" placeholder="Masukan Jumlah Yang Akan Dibeli" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" class="form-control" name="kode_keranjang" value="<?php if ($kode_keranjang == NULL) { echo $id_dari_session_header.date('dmyhis'); } else { echo $kode_keranjang; }?>" readonly required>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="tambah" class="btn btn-primary">Masukan kedalam keranjang</button>
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
        <form action="proses/proses_transaksi.php" method="post">
          <div class="modal-body">
            Apa anda yakin ingin menghapus layanan ini dari keranjang belanja ?
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" id="id_keranjang" name="id_keranjang" value="">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="hapus_keranjang_peitem" class="btn btn-primary">Hapus</button>
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
          <h4 class="modal-title">Ubah Keranjang Belanja</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_transaksi.php" method="post">
          <div class="modal-body">
            <span id="dub"></span>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="ubah" class="btn btn-primary">Perbaharui Keranjang</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--------------------------- END MODAL --------------------------->
  <!--------------------------- MODAL --------------------------->
  <div class="modal fade" id="modal-check-out">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Keranjang Belanja</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="proses/proses_transaksi.php" method="post">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" class="form-control" name="total_qty" value="<?= $total_qty ?>" required readonly>
              <label for="recipient-name" class="col-form-label">No Keranjang</label>
              <input type="text" class="form-control" name="kode_keranjang" value="<?php if ($kode_keranjang == NULL) { echo $id_dari_session_header.date('dmyhis'); } else { echo $kode_keranjang; }?>" required readonly>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Total Yang Harus Dibayar</label>
              <input type="hidden" class="form-control" name="total_bayar_hidden" id="total_bayar_hidden" onkeyup="sum();" value="<?= $total_pembayaran ?>" required readonly>
              <input type="text" class="form-control" name="total_bayar" value="<?= 'Rp. '.number_format($total_pembayaran) ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Metode Pembayaran</label>
                <select class="form-control" name="dari_mana_mengetahui" id="dari_mana_mengetahui" required>
                  <option value="Tunai">Tunai</option>
                  <option value="Lainnya">Non Tunai</option>
                </select>
                <br>
             	<input type="text" name="result_lainya" id="result_lainya" placeholder="Masukan note (Transfer ke rekening bca/ovo/shoopepay dsb)" class="form-control" value="" hidden />
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Masukan Uang Pelanggan</label>
              <input type="text" class="form-control" name="uang_pelanggan" id="uang_pelanggan" onkeyup="sum();" maxlength="9" placeholder="Masukan Uang Pelanggan" onkeypress="return hanyaAngka(event)" required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Uang Kembalian Pelanggan</label>
              <input type="text" class="form-control" name="kembalian_pelanggan" id="kembalian_pelanggan" maxlength="9" placeholder="Jumlah Kembalian Uang Pelanggan" onkeypress="return hanyaAngka(event)" readonly required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Catatan/ Pesan</label>
              <input type="text" class="form-control" name="catatan" value="-" maxlength="100" required>
              <!-- <small>Catatan bersifat opsianal, isi jika ada catatan *contoh Sambalnya dipisah, dll</small> -->
              <small>Catatan bersifat opsianal, isi jika ada catatan</small>

            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" name="bayar_dan_cetak" class="btn btn-primary">Bayar Dan Cetak</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--------------------------- END MODAL --------------------------->
  <script>
        function ubahdata(id_keranjang){
            var ajaxbos = new XMLHttpRequest();
                ajaxbos.onreadystatechange= function(){
                    if(ajaxbos.readyState==4 && ajaxbos.status==200){
                        document.getElementById("dub").innerHTML= ajaxbos.responseText;
                    }
                };
                ajaxbos.open("GET","ubah/ubah_keranjang.php?q="+id_keranjang+"&s=#",true);
                ajaxbos.send();
            }
        function hapusdata(id_keranjang){
            document.getElementById('id_keranjang').value=id_keranjang;
        }
  </script>

  <script> 
       $(function(){
  
            $('.table').DataTable({
               "responsive": true,
               "processing": true,
               "serverSide": true,
               "ajax":{
                        "url": "ajax/ajax_keranjang.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                      },
               "columns": [
                   { "data": "no" },
                   { "data": "nama_produk" },
                   { "data": "nama_kategori" },
                   { "data": "qty_produk" },
                   { "data": "harga_satuan" },
                  //  { "data": "hargakaliqty" },
                   { "data": "key_keranjang" },
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
              	url: "../../ajax/get_produk.php",
              	data: {get_id_kategori_nya: get_id_kategori_nya},
              	cache: false,
              	success: function(msg){
                  $("#get_id_produk_nya").html(msg);
                }
            });
        });
     });
</script>
<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('total_bayar_hidden').value;
      var txtSecondNumberValue = document.getElementById('uang_pelanggan').value;
      var result = parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);
      if (!isNaN(result)) {
         document.getElementById('kembalian_pelanggan').value = result;
      }
}
</script>