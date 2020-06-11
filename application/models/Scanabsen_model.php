<?php

defined('BASEPATH') OR exit ('No direct script access allowed');

class Scanabsen_model extends CI_Model{

    function absen($id){
        $this->db->select("id_siswa, id_user, nis, nama, jurusan_kelas");
        $this->db->where("id_user", $id);
        $query = $this->db->get("siswa");
        return $query->row();
    }
    function scanmasuk($id){
        if($this->cekmasuk($id)){
            $id_siswa = $id;
            $date = date("Y-m-d");
            $masuk = date("H:i:s");
            $data = array(
                'id_siswa' => $id_siswa,
                'masuk' => $masuk,
                'tanggal' => $date
            );
            return $this->db->insert('absen', $data);
        }else{
            return false;
        }
    }
    function scankeluar($id){
        $id_siswa = $id;
        $date = date("Y-m-d");
        $keluar = date("H:i:s");
        $data = array(
            'id_siswa' => $id_siswa,
            'keluar' => $keluar,
            'tanggal' => $date
        );
        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('tanggal', $date);
        return $this->db->update('absen', $data);
    }
    function cekmasuk($id){
        $date = date("Y-m-d");
        $this->db->select('id_siswa');
        $this->db->where('tanggal', $date);
        $this->db->where('id_siswa', $id);
        $query = $this->db->get('absen');
        $jml = $query->num_rows();
        if($jml > 0){
            return false;
        }else{
            return true;
        }

        }

    }

