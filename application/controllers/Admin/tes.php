<?php

class tes extends CI_Controller
{

function __construct()
{
parent:: __construct();

$this->load->model('m_pemesanan');
}

function index(){
    $b = ($this->m_pemesanan->getHargaModal(75, 1));
   $modal = $b['harga'];
   echo $modal;
    
    
    
//     $modal = 0;
//     $b = $this->m_pemesanan->getHargaModal(73, 1);
//         foreach ($b as $temp) {
//             $modal = $modal + $temp['harga'];
//         }
//         echo $modal;
// }
}
}
?>