<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Siswa_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Siswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Siswa' => '',
        ];
        $data['code_js'] = 'siswa/codejs';
        $data['page'] = 'siswa/Siswa_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Siswa_model->json();
    }

    public function read($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id_siswa' => $row->id_siswa,
        'id_user' => $row->id_user,
		'nis' => $row->nis,
		'nama' => $row->nama,
		'jurusan_kelas' => $row->jurusan_kelas,
	    );
        $data['title'] = 'Siswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'siswa/Siswa_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('siswa/create_action'),
        'id_siswa' => set_value('id_siswa'),
        'id_user' => set_value('id_user'),
	    'nis' => set_value('nis'),
	    'nama' => set_value('nama'),
	    'jurusan_kelas' => set_value('jurusan_kelas'),
	);
        $data['title'] = 'Siswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['users'] = $this->Siswa_model->getEmail(); 
        $data['page'] = 'siswa/Siswa_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'nis' => $this->input->post('nis',TRUE),
        'id_user' => $this->input->post('id_user',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'jurusan_kelas' => $this->input->post('jurusan_kelas',TRUE),
	    );$this->Siswa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('siswa'));}
    }
    
    public function update($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siswa/update_action'),
        'id_siswa' => set_value('id_siswa', $row->id_siswa),
        'id_user' => set_value('id_user'),
		'nis' => set_value('nis', $row->nis),
		'nama' => set_value('nama', $row->nama),
		'jurusan_kelas' => set_value('jurusan_kelas', $row->jurusan_kelas),
	    );
            $data['title'] = 'Siswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['users'] = $this->Siswa_model->getEmail(); 
        $data['page'] = 'siswa/Siswa_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_siswa', TRUE));
        } else {
            $data = array(
        'nis' => $this->input->post('nis',TRUE),
        'id_user' => $this->input->post('id_user',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'jurusan_kelas' => $this->input->post('jurusan_kelas',TRUE),
	    );

            $this->Siswa_model->update($this->input->post('id_siswa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $this->Siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function deletebulk(){
        $delete = $this->Siswa_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nis', 'nis', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jurusan_kelas', 'jurusan kelas', 'trim|required');

	$this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "siswa.xls";
        $judul = "siswa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nis");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Jurusan Kelas");

	foreach ($this->Siswa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jurusan_kelas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

  public function printdoc(){
        $data = array(
            'siswa_data' => $this->Siswa_model->get_all(),
            'start' => 0
        );
        $this->load->view('siswa/siswa_print', $data);
    }

}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-17 12:59:56 */
/* http://harviacode.com */