<?php 
require_once '../../../koneksi.php';

if($_GET['action'] == "table_data"){
 
 
      $columns = array( 
                               0 =>'id_kategori', 
                               1 =>'nama_kategori',
                               2=> 'status_kategori',
                               3=> 'key_kategori',
                           );
 
      $querycount = $koneksi->query("SELECT count(id_kategori) as jumlah FROM kategori");
      $datacount = $querycount->fetch_array();
    
   
        $totalData = $datacount['jumlah'];
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {            
         $query = $koneksi->query("SELECT * FROM kategori order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $koneksi->query("SELECT * FROM kategori WHERE nama_kategori LIKE '%$search%'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
           $querycount = $koneksi->query("SELECT count(id_kategori) as jumlah FROM kategori WHERE nama_kategori LIKE '%$search%'");
         $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = $query->fetch_array())
            {
                $key_kategori                   = $r['key_kategori'];
                if ($r['status_kategori'] == 1) {
                    $new_status_kategori = '<center><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fa fa-check"></i> Aktif</button></center>';
                } else if ($r['status_kategori'] == 2) {
                    $new_status_kategori = '<center><button type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-times"></i> Tidak Aktif</button></center>';
                } else {
                    $new_status_kategori = '<center><button type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-check"></i> Terjadi Gangguan</button></center>'; 

                }
                $nestedData['no']               = $no;
                $nestedData['nama_kategori']    = $r['nama_kategori'];
                $nestedData['status_kategori']  = $new_status_kategori;
                $nestedData['aksi']             =  '
                                                    <center>
                                                        <button type="button" class="btn btn-success btn-sm" value='.$key_kategori.' onclick="ubahdata(this.value)" data-toggle="modal" data-target="#ubah"><i class="fa fa-edit"></i> Ubah</button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" value='.$key_kategori.' onclick="hapusdata(this.value)"><i class="fa fa-trash"></i> Hapus</button>
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