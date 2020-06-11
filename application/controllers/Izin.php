<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Izin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Izin_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Izin';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Izin' => '',
        ];
        $data['code_js'] = 'izin/codejs';
        $data['page'] = 'izin/Izin_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Izin_model->json();
    }

    public function read($id) 
    {
        $row = $this->Izin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_izin' => $row->id_izin,
		'nama_siswa' => $row->nama_siswa,
		'tanggal' => $row->tanggal,
		'alasan' => $row->alasan,
		'foto' => $row->foto,
	    );
        $data['title'] = 'Izin';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'izin/Izin_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('izin'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('izin/create_action'),
	    'id_izin' => set_value('id_izin'),
	    'nama_siswa' => set_value('nama_siswa'),
	    'tanggal' => set_value('tanggal'),
	    'alasan' => set_value('alasan'),
	    'foto' => set_value('foto'),
	);
        $data['title'] = 'Izin';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'izin/Izin_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $nama = $this->input->post('nama_siswa');
        $tanggal = $this->input->post('tanggal');
        $alasan = $this->input->post('alasan');
        $foto = $_FILES['foto'];

        if ($foto='') {}else{
                $config['upload_path']          = './assets/uploads/izin_foto';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto')){
                        echo "Upload Gagal"; die();
                }
                else
                {
                        $foto= $this->upload->data('file_name');
                }
        }
            $data = array(
		      'nama_siswa' => $nama,
              'tanggal' => $tanggal,
              'alasan' => $alasan,
              'foto' => $foto,

          );

            $this->Izin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('izin'));}
    }
}
    
    public function update($id) 
    {
        $row = $this->Izin_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('izin/update_action'),
		'id_izin' => set_value('id_izin', $row->id_izin),
		'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'alasan' => set_value('alasan', $row->alasan),
		'foto' => set_value('foto', $row->foto),
	    );
            $data['title'] = 'Izin';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'izin/Izin_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('izin'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_izin', TRUE));
        } else {
            $data = array(
		'nama_siswa' => $this->input->post('nama_siswa',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'alasan' => $this->input->post('alasan',TRUE),
		'foto' => $this->input->post('foto',TRUE),
	    );

            $this->Izin_model->update($this->input->post('id_izin', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('izin'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Izin_model->get_by_id($id);

        if ($row) {
            $this->Izin_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('izin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('izin'));
        }
    }

    public function deletebulk(){
        $delete = $this->Izin_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('alasan', 'alasan', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id_izin', 'id_izin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Izin.php */
/* Location: ./application/controllers/Izin.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-02 12:31:11 */
/* http://harviacode.com */