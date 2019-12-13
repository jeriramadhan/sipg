<?php
class M_peserta extends CI_Model {
	
	function __contsruct(){
		parent::Model();
	}
	
	function cek_login($where){
		$data = "";
		$this->db->select("*");
		$this->db->from("t_peserta");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0) {
			$data = $Q->row();
			$this->set_session($data);
			return true;
		}
		return false;
	}
	
	function set_session(&$data){
		$session = array(
					'pst_npm' 	   	=> $data->pst_npm,
					'pst_password' 	=> $data->pst_password,
					'pst_nama' 		=> $data->pst_nama,
					'logged_in2'		=> TRUE
					);
		$this->session->set_userdata($session);
	}
	
	function update_log($where){
		$where['pst_npm'] 		=	 $data->pst_npm;
		$where['peserta_nama'] = $data->peserta_nama;
		$data['peserta_ip']	 = $_SERVER['REMOTE_ADDR'];
		$data['peserta_online']= time();
		$this->db->update('t_peserta',$data,$where);
	}
	
	function remov_session() {
		$session = array(
					'pst_npm'  =>'',
					'pst_nama' =>'',
					'logged_in2'	  => FALSE
					);
		$this->session->unset_userdata($session);
	}
    
    //WEB SERVICE NYA
    
    public function insert_pendaftaran($data){
        $this->db->insert("t_pendaftaran",$data);
    }
    
    public function get_peserta($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("t_peserta");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
    }
    
    public function tampilkan_unit(){
        $sql = "SELECT * FROM t_unit ORDER BY unit_id";
        return $this->db->query($sql)->result_array();
    }
}
    