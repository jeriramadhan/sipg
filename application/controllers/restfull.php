<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restfull extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_peserta', 'pst', TRUE);
        $this->load->model('M_internal', 'INT', TRUE);
        $this->load->model('M_prodi', 'PRD', TRUE);

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Method: PUT, GET, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
	}

	public function index(){
		$coeg = array(
			'name'		=> 'WEBSERVICE'
		);
		echo json_encode($coeg);
	}
    
    public function insert_prodi(){

		$data['prodi_id']		= ($this->input->post('prodi_id'))?$this->input->post('prodi_id'):'';
		$data['prodi_nama']		= ($this->input->post('prodi_nama'))?$this->input->post('prodi_nama'):'';
		$data['prodi_desk']			= ($this->input->post('prodi_desk'))?$this->input->post('prodi_desk'):'';
        
		$insert['prodi_id']	= ($data['prodi_id']);
		$insert['prodi_nama']	=  ($data['prodi_nama']);
		$insert['prodi_desk']		= ($data['prodi_desk']);
			$simpan = $this->PRD->insert_prodi($insert);
			if($simpan){
				$json['status'] = 1;
			}else{
				$json['status'] = 0;
			}
			echo json_encode($json);
	}

	
	public function prodi(){
		//$json = array();
		$prodi = $this->PRD->get_prodi();
		if(!empty($prodi)){
			foreach ($prodi as $row) {
				$json[] = array(
					'prodi_id' 				=> $row['prodi_id'],
                    'prodi_nama' 				=> $row['prodi_nama'],
                    'prodi_desk' 				=> $row['prodi_desk']
                );
			}
		}else{
			$json = array();
		}
		echo json_encode(array('prodi' => $json));  
	}
    //unit
	public function unit(){
		//$json = array();
		$unit = $this->pst->tampilkan_unit();
		if(!empty($unit)){
			foreach ($unit as $row) {
				$json[] = array(
					'unit_id' 				=> $row['unit_id'],
                    'unit_nama' 				=> $row['unit_nama'],
                    'unit_desk' 				=> $row['unit_desk']
                );
			}
		}else{
			$json = array();
		}
		echo json_encode(array('unit' => $json));  
	}

	}
