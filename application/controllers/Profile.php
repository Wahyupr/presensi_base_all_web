<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
	}
	
	public function index()
	{
		$data['title'] = 'Profile';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Profile' => '',
		];
		$data['user'] = $this->ion_auth->user()->row();
		//$this->layout->set_privilege(1);
		$data['message'] = $this->session->message;
		
        $data['page'] = 'profile';
		$this->load->view('template/backend', $data);
	}


	public function gantipassword(){
		$data['title'] = 'Profile';
		$data['subtitle'] = 'Ganti Password';
        $data['crumb'] = [
            'Profile' => 'Change Password',
		];
		$data['user'] = $this->ion_auth->user()->row();

		$data['message'] = $this->session->message;

			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['old_password'] = array(
				'name' => 'old',
				'id' => 'old',
				'type' => 'password',
				'class' => 'form-control',
				'placeholder' => 'Password'
			);
			$data['new_password'] = array(
				'name' => 'new',
				'id' => 'new',
				'type' => 'password',
				'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
				'class' => 'form-control',
				'placeholder' => 'Password Baru'
			);
			$data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
				'class' => 'form-control',
				'placeholder' => 'Konfirmasi Password Baru'
			);
			$data['user_id'] = array(
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $data['user']->id,
			);
        //$this->layout->set_privilege(1);
        $data['page'] = 'change_password';
		$this->load->view('template/backend', $data);
	}

	public function action_changepass(){
		$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect(site_url('auth/logout'));
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('profile/gantipassword', 'refresh');
			}
	}

	public function actioneditprofile(){
		$data = array(
			'first_name' => $this->input->post('firstname'),
			'last_name' => $this->input->post('lastname'),
			'email' => $this->input->post('email'),
			'company' => $this->input->post('company'),
			'phone' => $this->input->post('phone'),
		);
		$iduser = $this->ion_auth->user()->row()->id;
		$this->db->set($data);
		$this->db->where('id', $iduser);
		$update = $this->db->update('users');
		if($update){
			$this->session->set_flashdata('message', "Profil berhasil diupdate");
			redirect('profile');
		}else{
			$this->session->set_flashdata('message', "profil gagal diupdate");
			redirect('profile');
		}
	}
}
