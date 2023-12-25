<?php 
require_once '../../../koneksi.php';

if($_GET['action'] == "table_data"){
 
 
      $columns = array( 
                            0 =>'id_produk', 
                            1 =>'nama_produk',
                            2=> 'id_kategori_produk',
                            3=> 'harga_produk',
                            4=> 'stok',
                            5=> 'status_produk',
                            6=> 'key_produk',
                            7=> 'diproses_oleh',
                            8=> 'date_created',
                        );
 
       $querycount = $koneksi->query("SELECT count(id_produk) as jumlah FROM produk");
       $datacount = $querycount->fetch_array();
    
   
        $totalData = $datacount['jumlah'];
             
        $totalFiltered = $totalData; 
 
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $order  = $columns[$_POST['order']['0']['column']];
        $dir    = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {            
         $query = $koneksi->query("SELECT
         * 
     FROM
         kategori AS ktg
         RIGHT JOIN produk AS pdk ON pdk.id_kategori_produk = ktg.id_kategori
         INNER JOIN user AS usr ON pdk.diproses_oleh = usr.id_user ORDER BY $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query  = $koneksi->query("SELECT * FROM kategori AS ktg RIGHT JOIN produk AS pdk ON pdk.id_kategori_produk=ktg.id_kategori WHERE pdk.nama_produk LIKE '%$search%'
                                                         or pdk.harga_produk LIKE '%$search%'
                                                         or ktg.nama_kategori LIKE '%$search%'
                                                         or pdk.diproses_oleh LIKE '%$search%'
                                                         or pdk.date_created LIKE '%$search%'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
           $querycount      = $koneksi->query("SELECT count(id_produk) as jumlah FROM kategori AS ktg RIGHT JOIN produk AS pdk ON pdk.id_kategori_produk=ktg.id_kategori WHERE pdk.nama_produk LIKE '%$search%' or pdk.harga_produk LIKE '%$search%' or ktg.nama_kategori LIKE '%$search%' or pdk.diproses_oleh LIKE '%$search%' or pdk.date_created LIKE '%$search%'");
           $datacount       = $querycount->fetch_array();
           $totalFiltered   = $datacount['jumlah'];
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = $query->fetch_array())
            {
                $key_produk                   = $r['key_produk'];
                if ($r['status_produk'] == 1) {
                    $new_status_produk = '<center><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fa fa-check"></i> Ready Stok</button></center>';
                } else if ($r['status_produk'] == 2) {
                    $new_status_produk = '<center><button type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-times"></i> Stok Habis</button></center>';
                } else {
                    $new_status_produk = '<center><button type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-check"></i> Terjadi Gangguan</button></center>'; 

                }

                if ($r['nama_kategori'] == NULL) {
                    $new_nama_kategori = '<font color="red"><b>Terjadi Gangguan</b></color>';
                } else {
                    $new_nama_kategori = $r['nama_kategori'];
                }
                
                $nestedData['no']                       = $no;
                $nestedData['nama_produk']              = $r['nama_produk'];
                $nestedData['id_kategori_produk']       = $new_nama_kategori;
                $nestedData['harga_produk']             = 'Rp. '.number_format($r['harga_produk']);
                $nestedData['stok']                     = $r['stok'];
                $nestedData['diproses_oleh']            = $r['nama'];
                $nestedData['date_created']             = $r['date_created'];
                $nestedData['status_produk']            = $new_status_produk;
                $nestedData['aksi']             =  '
                                                    <center>
                                                        <button type="button" class="btn btn-success btn-sm" value='.$key_produk.' onclick="ubahdata(this.value)" data-toggle="modal" data-target="#ubah"><i class="fa fa-edit"></i> Ubah</button>
                                                        <!--<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" value='.$key_produk.' onclick="hapusdata(this.value)"><i class="fa fa-trash"></i> Hapus</button>-->
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