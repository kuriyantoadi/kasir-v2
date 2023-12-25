  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cash-register"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Transaksi Bulan Ini</span>
                <span class="info-box-number">
                  <?= $total_jumlah_transaksi_bln_ini.' Transaksi/Rp. '.number_format($total_pendapatan_bln_ini) ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cash-register"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Transaksi Kemarin</span>
                <span class="info-box-number">
                  <?= $total_jumlah_transaksi_kemarin.' Transaksi/Rp. '.number_format($total_pendapatan_kmr_ini) ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Uang Keluar Kemarin</span>
                <span class="info-box-number">
                  <?= 'Rp. '.number_format($total_uang_keluar_keluar_kemarin) ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Transaksi Hari Ini</span>
                <span class="info-box-number">
                  <?= $total_jumlah_transaksi_today.' Transaksi/Rp. '.number_format($total_pendapatan_hari_ini) ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Setoran Hari Ini(Tunai)</span>
                <span class="info-box-number">
                  <?php
                    $setoran_hari_ini   = $total_pendapatan_hari_ini_t - $total_uang_keluar_hari_ini;
                    echo 'Rp. '.number_format($setoran_hari_ini);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Riwayat Transaksi Penjualan</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <canvas id="rekam_transaksi_penjualan"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">5 Produk Paling Laris</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 285px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Berhasil Terjual</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $no = 0;
                        $cek_query_lima_terlaris   = mysqlI_query($koneksi, "SELECT
                        nama_produk,
                        SUM( qty_produk ) AS terjual 
                      FROM
                        produk AS pdk
                        INNER JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk 
                      WHERE
                        krj.status_keranjang = 1 
                      GROUP BY
                        krj.id_produk 
                      ORDER BY
                        terjual DESC LIMIT 5");
                        while ($hasil_lima_terlaris       = mysqli_fetch_array($cek_query_lima_terlaris)) {
                        $get_nama_produk                  = $hasil_lima_terlaris['nama_produk'];
                        $get_terjual                      = $hasil_lima_terlaris['terjual'];
                        $no++;
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $get_nama_produk ?></td>
                      <td><?= $get_terjual.' x terjual' ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
		var ctx = document.getElementById("rekam_transaksi_penjualan").getContext('2d');
		var rekam_transaksi_penjualan = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["7 Hari lalu", "6 Hari lalu", "5 Hari lalu", "4 Hari lalu","3 Hari lalu", "2 Hari lalu", "Kemarin", "Hari ini"],
				datasets: [{
					label: '',
					data: [
          <?php 
					$jumlah_tujuh_hari_lalu = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$tujuharilalu%' ");
					echo mysqli_num_rows($jumlah_tujuh_hari_lalu);
					?>,
          <?php 
					$jumlah_enam_hari_lalu = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$enamharilalu%'");
					echo mysqli_num_rows($jumlah_enam_hari_lalu);
					?>,
          <?php 
					$jumlah_lima_hari_lalu = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$limaharilalu%'");
					echo mysqli_num_rows($jumlah_lima_hari_lalu);
					?>,
          <?php 
					$jumlah_empat_hari_lalu = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$empatharilalu%'");
					echo mysqli_num_rows($jumlah_empat_hari_lalu);
					?>,
					<?php 
					$jumlah_tiga_hari_lalu = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$tigaharilalu%'");
					echo mysqli_num_rows($jumlah_tiga_hari_lalu);
					?>, 
					<?php 
					$jumlah_dua_hari_lalu = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$duaharilalu%'");
					echo mysqli_num_rows($jumlah_dua_hari_lalu);
					?>, 
					<?php 
					$jumlah_kemarin = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$satuharilalu%'");
					echo mysqli_num_rows($jumlah_kemarin);
					?>, 
					<?php 
					$jumlah_hari_ini = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tanggal_transaksi LIKE '$tanggal_hari_ini_dari_koneksi%'");
					echo mysqli_num_rows($jumlah_hari_ini);
                    ?>
                    ],
					backgroundColor: [
                    'rgb(200, 255, 255)'
					],
					borderColor: [
                    'rgb(75, 192, 192)'
					],
                    tension: 0.3
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>