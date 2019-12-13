<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class peserta extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_peserta', 'pst', TRUE);
		$this->load->model('M_internal', 'INT', TRUE);
    }

	public function index()
	{
        if ($this->session->userdata('logged_in2') == TRUE){       
            redirect('peserta/','refresh');
        } else {     
		//$this->load->vars($data);
		$this->load->view('peserta/login');
		 }
	}
	
	public function ceklogin()
	{
		$pst_npm		= validasi_sql($this->input->post('pst_npm'));
		$pst_password	= validasi_sql($this->input->post('pst_password'));
		$do				= validasi_sql($this->input->post('masuk'));
		
		$where_login['pst_npm']	= $pst_npm;
		$where_login['pst_password']	= do_hash($pst_password, 'md5');
		
		
		if ($do && $this->pst->cek_login($where_login) === TRUE){
			redirect("peserta/home");
		} else {
			$this->session->set_flashdata('warning',' NPM atau Password tidak cocok!');
            redirect("peserta");
		}
		
	}
	
	public function keluar()
	{
		$this->pst->remov_session();
      	session_destroy();
		redirect("peserta");
	}

	public function home ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in2') == TRUE){
			$where_peserta['pst_npm']		= $this->session->userdata('pst_npm');
			$data['peserta']				= $this->pst->get_peserta('',$where_peserta);
			$data['content']				= '/peserta/content/home';
			$data['action']					= (empty($filter1))?'view':$filter1;
			if($data['action'] == 'tambah' ) {
				$data['pst_npm']				=  $this->session->userdata('pst_npm');
				$data['unit_id']					= ($this->input->post('unit_id'))?$this->input->post('unit_id'):'';		
				$data['pendaftaran_status']		= '?';		
				$data['pendaftaran_tahun']		= date("Y");
				$simpan								= $this->input->post('simpan');
				if ($simpan) {
					$insert['pst_npm']	 	 		= validasi_sql($data['pst_npm']);
					$insert['unit_id']	 			 = validasi_sql($data['unit_id']);
					$insert['pendaftaran_status']	 = validasi_sql($data['pendaftaran_status']);
					$insert['pendaftaran_tahun']	 = validasi_sql($data['pendaftaran_tahun']);
					$this->pst->insert_pendaftaran($insert);
					$this->session->set_flashdata('success','Pendaftaran telah berhasil dilakukan!');
					redirect("peserta/home");
				} else {
					$this->session->set_flashdata('error','Pendaftaran tidak berhasil!');
					redirect("peserta/home");	
				}
			}
			$this->load->vars($data);
			$this->load->view('peserta/home');
		} else {
			redirect("peserta");
		}
		
	}

	public function pengumuman ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in2') == TRUE){
			$where_peserta['pst_npm']		= $this->session->userdata('pst_npm');
			$data['peserta']				= $this->pst->get_peserta('',$where_peserta);
			$data['content']				= '/peserta/content/pengumuman';
		
			$this->load->vars($data);
			$this->load->view('peserta/home');
		} else {
			redirect("peserta");
		}
		
	}

}
	