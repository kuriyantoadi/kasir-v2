<?php 
require_once '../../../koneksi.php';

if($_GET['action'] == "table_data"){
 
 
      $columns = array( 
                               0 =>'id_transaksi', 
                               1 =>'tanggal_transaksi',
                               2=> 'kode_keranjang',
                               3=> 'jumlah_yang_dibeli',
                               4=> 'total_harga',
                               5=> 'nama',
                               6=> 'kode_keranjang',
                           );
 
      $querycount = $koneksi->query("SELECT count(id_transaksi) as jumlah FROM transaksi");
      $datacount = $querycount->fetch_array();
    
   
        $totalData = $datacount['jumlah'];
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {            
         $query = $koneksi->query("SELECT * FROM user AS usr RIGHT JOIN transaksi AS trs ON trs.oleh=usr.id_user order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $koneksi->query("SELECT * FROM user AS usr RIGHT JOIN transaksi AS trs ON trs.oleh=usr.id_user WHERE trs.kode_keranjang LIKE '%$search%' OR trs.total_harga LIKE '%$search%'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
           $querycount = $koneksi->query("SELECT count(id_transaksi) as jumlah FROM user AS usr RIGHT JOIN transaksi AS trs ON trs.oleh=usr.id_user WHERE trs.kode_keranjang LIKE '%$search%' OR trs.total_harga LIKE '%$search%'");
           $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = $query->fetch_array())
            {
                $kode_keranjang                     = $r['kode_keranjang'];

                $nestedData['no']                   = $no;
                $nestedData['tanggal_transaksi']    = tglblnthnjam($r['tanggal_transaksi']);
                $nestedData['kode_keranjang']       = $r['kode_keranjang'];
                $nestedData['jumlah_yang_dibeli']   = $r['jumlah_yang_dibeli'];
                $nestedData['total_harga']          = 'Rp. '.number_format($r['total_harga']);
                $nestedData['nama']                 = $r['nama'];
                $nestedData['aksi']                 =  '
                                                        <center>
                                                            <a href="invoice.php?kode_keranjang='.$kode_keranjang.'" target="_blank" class="btn btn-block btn-success btn-sm" value='.$kode_keranjang.'><i class="fa fa-print"></i> Invoice</a>
                                                            <button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" value='.$kode_keranjang.' onclick="hapusdata(this.value)"><i class="fa fa-trash"></i> Hapus</button>
                                                        </center>';
                $data[] = $nestedData;
                $no++;
            }
        }
           
        $json_data = array(
                    "draw"            => intval($_POST['draw']),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data  
                    );
             
        echo json_encode($json_data); 
 
}
?>