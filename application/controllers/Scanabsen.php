<?php

header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Scanabsen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Scanabsen_model');
    }
    public function index()
    {

    }
 
    public function absen($id){
        $absen =$this->Scanabsen_model->absen($id);
        $jam = date("H");
        $masuk = false;
        $keluar = false;
        if($jam > 7 && $jam <= 9){
            $masuk = $this->scanmasuk($id);

        }else if ($jam > 15 && $jam <= 16){
            $keluar = $this->scankeluar($id);
        
        }
        if($masuk || $keluar){
            echo json_encode($absen);
        }else{
            echo "gagal";
        }
        
    }

    public function scanmasuk($id){
        $scanmasuk = $this->Scanabsen_model->scanmasuk($id);
        return $scanmasuk;
    }

    public function scankeluar($id){
        $scankeluar = $this->Scanabsen_model->scankeluar($id);
        return $scankeluar;

    }
}
