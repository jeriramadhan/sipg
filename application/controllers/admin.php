<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_internal', 'INT', TRUE);
    }

	public function index ()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->INT->get_admin('',$where_admin);
			$data['content']			= '/internal/content/home';
			$this->load->vars($data);
			$this->load->view('internal/home');
		} else {
			redirect("internal");
		}
		
	}
    
    //peserta================----------------=================---------------=================---------------==============---------==========
    public function peserta ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->INT->get_admin('',$where_admin);
			$data['content']			= '/internal/content/peserta';
			$data['action']				= (empty($filter1))?'view':$filter1;
                if ($data['action'] == 'view'){
                }  elseif ($data['action'] == 'tambah') {
                    $data['pst_npm']		= ($this->input->post('pst_npm'))?$this->input->post('pst_npm'):'';
                    $data['pst_nama']		= ($this->input->post('pst_nama'))?$this->input->post('pst_nama'):'';
                    $data['pst_password']		= ($this->input->post('pst_password'))?$this->input->post('pst_password'):'';
                    $data['kelas_id']		= ($this->input->post('kelas_id'))?$this->input->post('kelas_id'):'';
                    $data['prodi_id']		= ($this->input->post('prodi_id'))?$this->input->post('prodi_id'):'';
                    $data['pst_tahun_masuk']		= ($this->input->post('pst_tahun_masuk'))?$this->input->post('pst_tahun_masuk'):'';
                    $data['pst_foto']		= ($this->input->post('pst_foto'))?$this->input->post('pst_foto'):'';
				    $simpan						= $this->input->post('simpan');
                    if ($simpan){
                    $gambar = upload_image("pst_foto", "./assets/images/peserta/", "230x160", seo($data['pst_nama']));
					$data['pst_foto']	= $gambar;
                    $insert['pst_npm']	= validasi_sql($data['pst_npm']);
					$insert['pst_nama']	= validasi_sql($data['pst_nama']);
                    $insert['pst_password']	= validasi_sql(do_hash(($data['pst_password']), 'md5'));
                    $insert['kelas_id'] = validasi_sql($data['kelas_id']);
                    $insert['prodi_id'] = validasi_sql($data['prodi_id']);
                    //$insert['pst_tahun_masuk'] = validasi_sql($data['pst_tahun_masuk']);
                    $insert['pst_tahun_masuk']  = $data['pst_tahun_masuk'];
                    if ($data['pst_foto']) { $insert['pst_foto'] = validasi_sql($data['pst_foto']); }
                    $insert['pst_foto'] = validasi_sql($data['pst_foto']);
					$this->INT->insert_peserta($insert);
					$this->session->set_flashdata('success','peserta baru telah berhasil ditambahkan!,');
					redirect("admin/peserta");
                    }
                }  elseif ($data['action'] == 'edit') {
                    $data['onload']				= 'menu_nama';
				$where_peserta['pst_npm']	= $filter2; 
				$peserta 						= $this->INT->get_peserta('*', $where_peserta);
                 $data['pst_npm']			= ($this->input->post('pst_npm'))?$this->input->post('pst_npm'):$peserta->pst_npm;
                 $data['pst_nama']			= ($this->input->post('pst_nama'))?$this->input->post('pst_nama'):$peserta->pst_nama;
                 $data['pst_password']			= ($this->input->post('pst_password'))?$this->input->post('pst_password'):$peserta->pst_nama;
                 $data['kelas_id']			= ($this->input->post('kelas_id'))?$this->input->post('kelas_id'):$peserta->prodi_id;
                 $data['prodi_id']			= ($this->input->post('prodi_id'))?$this->input->post('prodi_id'):$peserta->prodi_id;
                 $data['pst_tahun_masuk']			= ($this->input->post('pst_tahun_masuk'))?$this->input->post('pst_tahun_masuk'):$peserta->pst_tahun_masuk;
                 $data['pst_foto']			= ($this->input->post('pst_foto'))?$this->input->post('pst_foto'):$peserta->pst_foto;
				    $simpan						= $this->input->post('simpan');
                if ($simpan) {
					$tags = "";
					if ($this->input->post('tag')) {
						$tags = implode(',', $this->input->post('tag'));
					}
					$gambar = upload_image("pst_foto", "./assets/images/peserta/", "230x160", seo($data['pst_nama']));
					$data['pst_foto']		= $gambar;
					$where_edit['pst_npm']	= validasi_sql($data['pst_npm']);
					$edit['pst_nama']	= validasi_sql($data['pst_nama']);
                    $edit['pst_password']	= validasi_sql(do_hash(($data['pst_password']), 'md5'));
                    $edit['kelas_id']	= validasi_sql($data['kelas_id']);
                    $edit['prodi_id']	= validasi_sql($data['prodi_id']);
                    $edit['pst_tahun_masuk']	= validasi_sql($data['pst_tahun_masuk']);
                    if ($data['pst_foto']) {
						$row = $this->INT->get_peserta('*', $where_edit);
						@unlink('./assets/images/peserta/'.$row->pst_foto);
						@unlink('./assets/images/peserta/kecil_'.$row->pst_foto);
						$edit['pst_foto']	= $data['pst_foto']; 
					}
					$this->INT->update_peserta($where_edit, $edit);
					$this->session->set_flashdata('success','peserta telah berhasil diedit!,');
					redirect("admin/peserta");
				}
                }  elseif ($data['action'] == 'hapus'){
                    
				$where_delete['pst_npm']		= validasi_sql($filter2);
				$this->INT->delete_peserta($where_delete);
				$this->session->set_flashdata('success','Data peserta telah berhasil dihapus!,');
					redirect("admin/peserta");
                }
			$this->load->vars($data);
			$this->load->view('internal/home');
		} else {
			redirect("internal");
		}
		
        
    }
    //prodiIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII=============================================--------------=============================
    public function prodi ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->INT->get_admin('',$where_admin);
			$data['content']			= '/internal/content/prodi';
			$data['action']				= (empty($filter1))?'view':$filter1;
                if ($data['action'] == 'view'){
                }  elseif ($data['action'] == 'tambah'){
                    $data['prodi_id']		= ($this->input->post('prodi_id'))?$this->input->post('prodi_id'):'';
                    $data['prodi_nama']		= ($this->input->post('prodi_nama'))?$this->input->post('prodi_nama'):'';
                    $data['prodi_desk']		= ($this->input->post('prodi_desk'))?$this->input->post('prodi_desk'):'';
				    $simpan						= $this->input->post('simpan');
                    if ($simpan){
					$insert['prodi_id']	= validasi_sql($data['prodi_id']);
					$insert['prodi_nama']	= validasi_sql($data['prodi_nama']);
                    $insert['prodi_desk'] = validasi_sql($data['prodi_desk']);
					$this->INT->insert_prodi($insert);
					$this->session->set_flashdata('success','prodi baru telah berhasil ditambahkan!,');
					redirect("admin/prodi");
				}
                }  elseif ($data['action'] == 'edit'){
                    $data['onload']				= 'menu_nama';
				$where_prodi['prodi_id']	= $filter2; 
				$prodi 						= $this->INT->get_prodi('*', $where_prodi);
                 $data['prodi_id']			= ($this->input->post('prodi_id'))?$this->input->post('prodi_id'):$prodi->prodi_id;
                 $data['prodi_nama']			= ($this->input->post('prodi_nama'))?$this->input->post('prodi_nama'):$prodi->prodi_nama;
                 $data['prodi_desk']			= ($this->input->post('prodi_desk'))?$this->input->post('prodi_desk'):$prodi->prodi_desk;
				    $simpan						= $this->input->post('simpan');
                if ($simpan){
					$where_edit['prodi_id']	= validasi_sql($data['prodi_id']);
					$edit['prodi_nama']	= validasi_sql($data['prodi_nama']);
                    $edit['prodi_desk']	= validasi_sql($data['prodi_desk']);
					$this->INT->update_prodi($where_edit, $edit);
					$this->session->set_flashdata('success','prodi telah berhasil diedit!,');
					redirect("admin/prodi");
				}
                }  elseif ($data['action'] == 'hapus'){
                    
				$where_delete['prodi_id']		= validasi_sql($filter2);
				$this->INT->delete_prodi($where_delete);
				$this->session->set_flashdata('success','Data prodi telah berhasil dihapus!,');
					redirect("admin/prodi");
                }
			$this->load->vars($data);
			$this->load->view('internal/home');
		} else {
			redirect("internal");
		}
		
	}
    
//==KELASS===============================================================================================================
    public function kelas ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->INT->get_admin('',$where_admin);
			$data['content']			= '/internal/content/kelas';
			$data['action']				= (empty($filter1))?'view':$filter1;
                if ($data['action'] == 'view'){
                }  elseif ($data['action'] == 'tambah'){
                    $data['kelas_id']		= ($this->input->post('kelas_id'))?$this->input->post('kelas_id'):'';
                    $data['kelas_nama']		= ($this->input->post('kelas_nama'))?$this->input->post('kelas_nama'):'';
				    $simpan						= $this->input->post('simpan');
                    if ($simpan){
					$insert['kelas_id']	= validasi_sql($data['kelas_id']);
					$insert['kelas_nama']	= validasi_sql($data['kelas_nama']);
					$this->INT->insert_kelas($insert);
					$this->session->set_flashdata('success','Kelas baru telah berhasil ditambahkan!,');
					redirect("admin/kelas");
				}
                }  elseif ($data['action'] == 'edit'){
                    $data['onload']				= 'menu_nama';
				$where_kelas['kelas_id']	= $filter2; 
				$kelas 						= $this->INT->get_kelas('*', $where_kelas);
                 $data['kelas_id']			= ($this->input->post('kelas_id'))?$this->input->post('kelas_id'):$kelas->kelas_id;
                 $data['kelas_nama']			= ($this->input->post('kelas_nama'))?$this->input->post('kelas_nama'):$kelas->kelas_nama;
				    $simpan						= $this->input->post('simpan');
                if ($simpan){
					$where_edit['kelas_id']	= validasi_sql($data['kelas_id']);
					$edit['kelas_nama']	= validasi_sql($data['kelas_nama']);
					$this->INT->update_kelas($where_edit, $edit);
					$this->session->set_flashdata('success','Kelas telah berhasil diedit!,');
					redirect("admin/kelas");
				}
                }  elseif ($data['action'] == 'hapus'){
                    
				$where_delete['kelas_id']		= validasi_sql($filter2);
				$this->INT->delete_kelas($where_delete);
				$this->session->set_flashdata('success','Data kelas telah berhasil dihapus!,');
					redirect("admin/kelas");
                }
			$this->load->vars($data);
			$this->load->view('internal/home');
		} else {
			redirect("internal");
		}
		
	}
     //unitIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII=============================================--------------=============================
    public function unit ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->INT->get_admin('',$where_admin);
			$data['content']			= '/internal/content/unit';
			$data['action']				= (empty($filter1))?'view':$filter1;
                if ($data['action'] == 'view'){
                }  elseif ($data['action'] == 'tambah'){
                    $data['unit_id']		= ($this->input->post('unit_id'))?$this->input->post('unit_id'):'';
                    $data['unit_nama']		= ($this->input->post('unit_nama'))?$this->input->post('unit_nama'):'';
                    $data['unit_desk']		= ($this->input->post('unit_desk'))?$this->input->post('unit_desk'):'';
                    $data['unit_logo']		= ($this->input->post('unit_logo'))?$this->input->post('unit_logo'):'';
				    $simpan						= $this->input->post('simpan');
                    if ($simpan){
                    $gambar = upload_image("unit_logo", "./assets/images/unit/", "230x160", seo($data['unit_nama']));
                    $data['unit_logo']	= $gambar;
					$insert['unit_id']	= validasi_sql($data['unit_id']);
					$insert['unit_nama']	= validasi_sql($data['unit_nama']);
                    $insert['unit_desk'] = validasi_sql($data['unit_desk']);
                    if ($data['unit_logo']) { $insert['unit_logo'] = validasi_sql($data['unit_logo']); }
                    $insert['unit_logo'] = validasi_sql($data['unit_logo']);
					$this->INT->insert_unit($insert);
					$this->session->set_flashdata('success','unit baru telah berhasil ditambahkan!,');
					redirect("admin/unit");
				}
                }  elseif ($data['action'] == 'edit'){
                    $data['onload']				= 'menu_nama';
				$where_unit['unit_id']	= $filter2; 
				$unit 						= $this->INT->get_unit('*', $where_unit);
                 $data['unit_id']			= ($this->input->post('unit_id'))?$this->input->post('unit_id'):$unit->unit_id;
                 $data['unit_nama']			= ($this->input->post('unit_nama'))?$this->input->post('unit_nama'):$unit->unit_nama;
                 $data['unit_desk']			= ($this->input->post('unit_desk'))?$this->input->post('unit_desk'):$unit->unit_desk;
                 $data['unit_logo']			= ($this->input->post('unit_logo'))?$this->input->post('unit_logo'):$unit->unit_logo;
				    $simpan						= $this->input->post('simpan');
                if ($simpan){
						$tags = "";
						if ($this->input->post('tag')) {
							$tags = implode(',', $this->input->post('tag'));
						}
						$gambar = upload_image("unit_logo", "./assets/images/peserta/", "230x160", seo($data['unit_nama']));
						$data['unit_logo']		= $gambar;
					$where_edit['unit_id']	= validasi_sql($data['unit_id']);
					$edit['unit_nama']	= validasi_sql($data['unit_nama']);
                    $edit['unit_desk']	= validasi_sql($data['unit_desk']);
                    $edit['unit_logo']	= validasi_sql($data['unit_logo']);
					$this->INT->update_unit($where_edit, $edit);
					$this->session->set_flashdata('success','unit telah berhasil diedit!,');
					redirect("admin/unit");
				}
                }  elseif ($data['action'] == 'hapus'){
                    
				$where_delete['unit_id']		= validasi_sql($filter2);
				$this->INT->delete_unit($where_delete);
				$this->session->set_flashdata('success','Data unit telah berhasil dihapus!,');
					redirect("admin/unit");
                }
			$this->load->vars($data);
			$this->load->view('internal/home');
		} else {
			redirect("internal");
		}
		
	}
    
  //pengelolaIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII=============================================--------------=============================
    public function pengelola ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->INT->get_admin('',$where_admin);
			$data['content']			= '/internal/content/pengelola';
			$data['action']				= (empty($filter1))?'view':$filter1;
                if ($data['action'] == 'view'){
                }  elseif ($data['action'] == 'tambah'){
                    $data['pengelola_id']		= ($this->input->post('pengelola_id'))?$this->input->post('pengelola_id'):'';
                    $data['pengelola_username']		= ($this->input->post('pengelola_username'))?$this->input->post('pengelola_username'):'';
                    $data['pengelola_password']		= ($this->input->post('pengelola_password'))?$this->input->post('pengelola_password'):'';
                    $data['unit_id']		= ($this->input->post('unit_id'))?$this->input->post('unit_id'):'';
				    $simpan						= $this->input->post('simpan');
                    if ($simpan){
					$insert['pengelola_id']	= validasi_sql($data['pengelola_id']);
					$insert['pengelola_username']	= validasi_sql($data['pengelola_username']);
                    $insert['pengelola_password'] = validasi_sql(do_hash(($data['pengelola_password']), 'md5'));
                    $insert['unit_id'] = validasi_sql($data['unit_id']);
					$this->INT->insert_pengelola($insert);
					$this->session->set_flashdata('success','pengelola baru telah berhasil ditambahkan!,');
					redirect("admin/pengelola");
				}
                }  elseif ($data['action'] == 'edit'){
                    $data['onload']				= 'menu_nama';
				$where_pengelola['pengelola_id']	= $filter2; 
				$pengelola 						= $this->INT->get_pengelola('*', $where_pengelola);
                 $data['pengelola_id']			= ($this->input->post('pengelola_id'))?$this->input->post('pengelola_id'):$pengelola->pengelola_id;
                 $data['pengelola_username']			= ($this->input->post('pengelola_username'))?$this->input->post('pengelola_username'):$pengelola->pengelola_username;
                 $data['pengelola_password']			= ($this->input->post('pengelola_password'))?$this->input->post('pengelola_password'):$pengelola->pengelola_password;
                 $data['unit_id']			= ($this->input->post('unit_id'))?$this->input->post('unit_id'):$pengelola->unit_id;
				    $simpan						= $this->input->post('simpan');
                if ($simpan){
					$where_edit['pengelola_id']	= validasi_sql($data['pengelola_id']);
					$edit['pengelola_username']	= validasi_sql($data['pengelola_username']);
                    $edit['pengelola_password']	= validasi_sql(do_hash(($data['pengelola_password']), 'md5'));
                    $edit['unit_id']	= validasi_sql($data['unit_id']);
					$this->INT->update_pengelola($where_edit, $edit);
					$this->session->set_flashdata('success','pengelola telah berhasil diedit!,');
					redirect("admin/pengelola");
				}
                }  elseif ($data['action'] == 'hapus'){
                    
				$where_delete['pengelola_id']		= validasi_sql($filter2);
				$this->INT->delete_pengelola($where_delete);
				$this->session->set_flashdata('success','Data pengelola telah berhasil dihapus!,');
					redirect("admin/pengelola");
                }
			$this->load->vars($data);
			$this->load->view('internal/home');
		} else {
			redirect("internal");
		}
		
	}
//pendaftaranIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII=============================================--------------=============================
    public function pendaftaran ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->INT->get_admin('',$where_admin);
			$data['content']			= '/internal/content/pendaftaran';
			$data['action']				= (empty($filter1))?'view':$filter1;
			$this->load->vars($data);
			$this->load->view('internal/home');
		} else {
			redirect("internal");
		}
		
	}
//deadline----------------==============----------------=============================================--------------=============================
    public function deadline ($filter1='', $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_admin['admin_id']	= $this->session->userdata('admin_id');
			$data['admin']					= $this->INT->get_admin('',$where_admin);
			$data['content']			= '/internal/content/deadline';
			$data['action']				= (empty($filter1))?'view':$filter1;
                if ($data['action'] == 'view'){
                }  elseif ($data['action'] == 'tambah'){
                    $data['deadline_id']		= ($this->input->post('deadline_id'))?$this->input->post('deadlinea_id'):'';
                    $data['deadline_tgl']		= ($this->input->post('deadline_tgl'))?$this->input->post('deadline_tgl'):'';
                    $data['unit_id']		= ($this->input->post('unit_id'))?$this->input->post('unit_id'):'';
				    $simpan						= $this->input->post('simpan');
                    if ($simpan){
					$insert['deadline_id']	= validasi_sql($data['deadline_id']);
					$insert['deadline_tgl']	= validasi_sql($data['deadline_tgl']);
                    $insert['unit_id'] = validasi_sql($data['unit_id']);
					$this->INT->insert_deadline($insert);
					$this->session->set_flashdata('success','deadline baru telah berhasil ditambahkan!,');
					redirect("admin/deadline");
				}
                }  elseif ($data['action'] == 'edit'){
                    $data['onload']				= 'menu_nama';
				$where_deadline['deadline_id']	= $filter2; 
				$deadline 						= $this->INT->get_deadline('*', $where_deadline);
                 $data['deadline_id']			= ($this->input->post('deadline_id'))?$this->input->post('deadline_id'):$deadline->deadline_id;
                 $data['deadline_tgl']			= ($this->input->post('deadline_tgl'))?$this->input->post('deadline_tgl'):$deadline->deadline_tgl;
				    $simpan						= $this->input->post('simpan');
                if ($simpan){
					$where_edit['deadline_id']	= validasi_sql($data['deadline_id']);
					$edit['deadline_tgl']	= validasi_sql($data['deadline_tgl']);
					$this->INT->update_deadline($where_edit, $edit);
					$this->session->set_flashdata('success','deadline telah berhasil diedit!,');
					redirect("admin/deadline");
				}
                }  elseif ($data['action'] == 'hapus'){
                    
				$where_delete['deadline_id']		= validasi_sql($filter2);
				$this->INT->delete_deadline($where_delete);
				$this->session->set_flashdata('success','Data deadline telah berhasil dihapus!,');
					redirect("admin/deadline");
                }
			$this->load->vars($data);
			$this->load->view('internal/home');
		} else {
			redirect("internal");
		}
		
	}
}