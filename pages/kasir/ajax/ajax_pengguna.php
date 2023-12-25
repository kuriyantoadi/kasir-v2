<?php 
require_once '../../../koneksi.php';
session_start();
$id_dari_session_header             = $_SESSION['id_user'];
if($_GET['action'] == "table_data"){
 
 
      $columns = array( 
                               0 =>'id_user', 
                               1 =>'username',
                               2=> 'nama',
                               3=> 'email',
                               4=> 'level',
                               5=> 'status_aktif',
                               6=> 'id_user',
                           );
 
      $querycount = $koneksi->query("SELECT count(id_user) as jumlah FROM user WHERE id_user NOT IN('$id_dari_session_header')");
      $datacount = $querycount->fetch_array();
    
   
        $totalData = $datacount['jumlah'];
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {            
         $query = $koneksi->query("SELECT * FROM user WHERE id_user NOT IN('$id_dari_session_header') order by $order $dir
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $koneksi->query("SELECT * FROM user WHERE id_user NOT IN('$id_dari_session_header') AND nama LIKE '%$search%' OR username LIKE '%$search%' OR email LIKE '%$search%'
                                                         order by $order $dir
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
           $querycount = $koneksi->query("SELECT count(id_user) as jumlah FROM user WHERE id_user NOT IN('$id_dari_session_header') AND nama LIKE '%$search%' OR username LIKE '%$search%' OR email LIKE '%$search%'");
           $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = $query->fetch_array())
            {
                $id_user                   = $r['id_user'];

                if ($r['status_aktif'] == 1) {
                    $new_status_aktif = '<center><button type="button" class="btn btn-block btn-primary btn-sm"><i class="fa fa-check"></i> Aktif</button></center>';
                } else if ($r['status_aktif'] == 2) {
                    $new_status_aktif = '<center><button type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-times"></i> Blokir</button></center>';
                } else {
                    $new_status_aktif = '<center><button type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-check"></i> Terjadi Gangguan</button></center>'; 

                }

                if ($r['level'] == 1) {
                    $new_level = '<center><button type="button" class="btn btn-block btn-primary btn-sm">Superadmin</button></center>';
                } else if ($r['level'] == 2) {
                    $new_level = '<center><button type="button" class="btn btn-block btn-warning btn-sm">Kasir</button></center>';
                } else {
                    $new_level = '<center><button type="button" class="btn btn-block btn-danger btn-sm"><i class="fa fa-check"></i> Terjadi Gangguan</button></center>'; 

                }

                $nestedData['no']          = $no;
                $nestedData['username']         = $r['username'];
                $nestedData['nama']             = $r['nama'];
                $nestedData['email']            = $r['email'];
                $nestedData['level']            = $new_level;
                $nestedData['status_aktif']     = $new_status_aktif;
                $nestedData['id_user']             =  '
                                                    <center>
                                                        <button type="button" class="btn btn-block btn-success btn-sm" value='.$id_user.' onclick="ubahdata(this.value)" data-toggle="modal" data-target="#ubah"><i class="fa fa-edit"></i> Ubah</button>
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