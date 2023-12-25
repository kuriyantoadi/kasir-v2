<?php 
require_once '../../../koneksi.php';

if($_GET['action'] == "table_data"){
 
 
      $columns = array( 
                               0 =>'nama', 
                               1 =>'id_barang_masuk',
                               2=> 'kode_produk',
                               3=> 'qty',
                               4=> 'harga_per_item',
                               5=> 'diproses_oleh',
                               6=> 'tanggal_input',
                               7=> 'key_barang_masuk',
                           );
 
      $querycount = $koneksi->query("SELECT count(id_barang_masuk) as jumlah FROM produk AS pdk
      INNER JOIN barang_masuk AS bm ON pdk.id_produk = bm.kode_produk
      INNER JOIN `user` AS usr ON bm.diproses_oleh = usr.id_user");
      $datacount = $querycount->fetch_array();
    
   
        $totalData = $datacount['jumlah'];
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {            
         $query = $koneksi->query("SELECT
         * 
     FROM
         produk AS pdk
         INNER JOIN barang_masuk AS bm ON pdk.id_produk = bm.kode_produk
         INNER JOIN `user` AS usr ON bm.diproses_oleh = usr.id_user order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $koneksi->query("SELECT
            * 
        FROM
            produk AS pdk
            INNER JOIN barang_masuk AS bm ON pdk.id_produk = bm.kode_produk
            INNER JOIN `user` AS usr ON bm.diproses_oleh = usr.id_user WHERE bm.tanggal_input LIKE '%$search%'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
           $querycount = $koneksi->query("SELECT count(id_barang_masuk) as jumlah FROM produk AS pdk
           INNER JOIN barang_masuk AS bm ON pdk.id_produk = bm.kode_produk
           INNER JOIN `user` AS usr ON bm.diproses_oleh = usr.id_user WHERE bm.tanggal_input LIKE '%$search%'");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = $query->fetch_array())
            {
                $key_barang_masuk                   = $r['key_barang_masuk'];
                $nestedData['no']               = $no;
                $nestedData['nama_produk']    = $r['nama_produk'];
                $nestedData['qty']    = $r['qty'];
                $nestedData['harga_per_item']    = $r['harga_per_item'];
                $nestedData['tanggal_input']    = $r['tanggal_input'];
                $nestedData['nama']    = $r['nama'];
                //$nestedData['aksi']             =  '<center><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" value='.$key_barang_masuk.' onclick="hapusdata(this.value)"><i class="fa fa-trash"></i> Hapus</button></center>';
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