<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Absen_model');
        $this->load->model('Siswa_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Absen';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Absen' => '',
        ];
        $data['code_js'] = 'absen/codejs';
        $data['page'] = 'absen/Absen_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Absen_model->json();
    }

    public function read($id) 
    {
        $row = $this->Absen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_absen' => $row->id_absen,
		'id_siswa' => $row->id_siswa,
		'masuk' => $row->masuk,
		'keluar' => $row->keluar,
		'tanggal' => $row->tanggal,
		'status_kehadiran' => $row->status_kehadiran,
	    );
        $data['title'] = 'Absen';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'absen/Absen_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('absen/create_action'),
	        'id_absen' => set_value('id_absen'),
	        'id_siswa' => set_value('id_siswa'),
	        'masuk' => set_value('masuk'),
	        'keluar' => set_value('keluar'),
	        'tanggal' => set_value('tanggal'),
	        'status_kehadiran' => set_value('status_kehadiran'),
    );
        $data['siswa']= $this->Siswa_model->get_all();
        $data['title'] = 'Absen';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'absen/Absen_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_siswa' => $this->input->post('id_siswa',TRUE),
		'masuk' => $this->input->post('masuk',TRUE),
		'keluar' => $this->input->post('keluar',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'status_kehadiran' => $this->input->post('status_kehadiran',TRUE),
	    );$this->Absen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('absen'));}
    }
    
    public function update($id) 
    {
        $row = $this->Absen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('absen/update_action'),
		'id_absen' => set_value('id_absen', $row->id_absen),
		'id_siswa' => set_value('id_siswa', $row->id_siswa),
		'masuk' => set_value('masuk', $row->masuk),
		'keluar' => set_value('keluar', $row->keluar),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'status_kehadiran' => set_value('status_kehadiran', $row->status_kehadiran),
        );
            $data['siswa']= $this->Siswa_model->get_all();
            $data['title'] = 'Absen';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
        ];

        $data['page'] = 'absen/Absen_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_absen', TRUE));
        } else {
            $data = array(
		'id_siswa' => $this->input->post('id_siswa',TRUE),
		'masuk' => $this->input->post('masuk',TRUE),
		'keluar' => $this->input->post('keluar',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'status_kehadiran' => $this->input->post('status_kehadiran',TRUE),
	    );

            $this->Absen_model->update($this->input->post('id_absen', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('absen'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Absen_model->get_by_id($id);

        if ($row) {
            $this->Absen_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('absen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }

    public function deletebulk(){
        $delete = $this->Absen_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_siswa', 'id siswa', 'trim|required');
	$this->form_validation->set_rules('masuk', 'masuk', 'trim|required');
	$this->form_validation->set_rules('keluar', 'keluar', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('status_kehadiran', 'status kehadiran', 'trim|required');

	$this->form_validation->set_rules('id_absen', 'id_absen', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "absen.xls";
        $judul = "absen";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Siswa");
	xlsWriteLabel($tablehead, $kolomhead++, "Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Keluar");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Kehadiran");

	foreach ($this->Absen_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_siswa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keluar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_kehadiran);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

  public function printdoc(){
        $data = array(
            'absen_data' => $this->Absen_model->get_all(),
            'start' => 0
        );
        $this->load->view('absen/absen_print', $data);
    }

}

/* End of file Absen.php */
/* Location: ./application/controllers/Absen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-17 13:00:18 */
/* http://harviacode.com */