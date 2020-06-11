<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcode extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
    }
	
	public function index()
	{
		$data['title'] = 'Presensi QR Code';
        $data['subtitle'] = 'Generate QR Code Untuk Presensi';
        $data['crumb'] = [
            'Qrcode' => '',
        ];
        $data['code_js'] = 'Qrcode/codejs';
        $data['page'] = 'Qrcode/index';
        $this->load->view('template/backend', $data); 
	}
}