<?php 
require_once '../../../koneksi.php';
session_start();
$oleh                       = $_SESSION['id_user'];
if($_GET['action'] == "table_data"){
 
 
        $columns = array( 
                            0 =>'id_keranjang', 
                            1 =>'kode_keranjang',
                            2=> 'id_produk',
                            3=> 'qty_produk',
                            4=> 'harga_satuan',
                            5=> 'key_keranjang',
                        );
 
        $querycount = $koneksi->query("SELECT 
        id_keranjang,
        nama_kategori,
        nama_produk,
        harga_satuan,
        qty_produk,
        ( harga_satuan * qty_produk ) AS hargakaliqty,
        status_keranjang,
        key_keranjang,
        oleh 
        FROM
        kategori AS ktg
        RIGHT JOIN produk AS pdk ON ktg.id_kategori = pdk.id_kategori_produk
        RIGHT JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk WHERE krj.status_keranjang='2' AND krj.oleh='$oleh'");
        $datacount = $querycount->fetch_array();
    
   
        $totalData = $datacount['jumlah'];
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {            
         $query = $koneksi->query("SELECT nama_kategori,
         id_keranjang,
         nama_produk,
         harga_satuan,
         qty_produk,
         ( harga_satuan * qty_produk ) AS hargakaliqty,
         status_keranjang,
         key_keranjang,
         oleh 
        FROM
         kategori AS ktg
         RIGHT JOIN produk AS pdk ON ktg.id_kategori = pdk.id_kategori_produk
         RIGHT JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk WHERE krj.status_keranjang='2' AND krj.oleh='$oleh' order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $koneksi->query("SELECT nama_kategori,
            id_keranjang,
            nama_produk,
            harga_satuan,
            qty_produk,
            ( harga_satuan * qty_produk ) AS hargakaliqty,
            status_keranjang,
            key_keranjang,
            oleh 
            FROM
            kategori AS ktg
            RIGHT JOIN produk AS pdk ON ktg.id_kategori = pdk.id_kategori_produk
            RIGHT JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk WHERE ktg.nama_kategori LIKE '%$search%' OR pdk.nama_produk LIKE '%$search%' AND krj.oleh='$oleh' AND krj.status_keranjang='2'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
           $querycount = $koneksi->query("SELECT count(id_keranjang) as jumlah, 
           nama_kategori,
           id_keranjang,
           nama_produk,
           harga_satuan,
           qty_produk,
           ( harga_satuan * qty_produk ) AS hargakaliqty,
           status_keranjang,
           key_keranjang,
           oleh 
           FROM
           kategori AS ktg
           RIGHT JOIN produk AS pdk ON ktg.id_kategori = pdk.id_kategori_produk
           RIGHT JOIN keranjang AS krj ON pdk.id_produk = krj.id_produk WHERE ktg.nama_kategori LIKE '%$search%' OR pdk.nama_produk LIKE '%$search%' AND krj.oleh='$oleh' AND krj.status_keranjang='2'");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = $query->fetch_array())
            {
                $nestedData['no']               = $no;
                $nestedData['nama_produk']      = $r['nama_produk'];
                $nestedData['nama_kategori']    = $r['nama_kategori'];
                $nestedData['qty_produk']       = $r['qty_produk'];
                $nestedData['harga_satuan']     = 'Rp. '.number_format($r['harga_satuan']);
                $nestedData['hargakaliqty']     = 'Rp. '.number_format($r['hargakaliqty']);
                $nestedData['key_keranjang']    = '
                                                    <center>
                                                        <button type="button" class="btn btn-success btn-sm" value='.$r['id_keranjang'].' onclick="ubahdata(this.value)" data-toggle="modal" data-target="#ubah"><i class="fa fa-edit"></i> Ubah</button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" value='.$r['id_keranjang'].' onclick="hapusdata(this.value)"><i class="fa fa-trash"></i> Hapus</button>
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