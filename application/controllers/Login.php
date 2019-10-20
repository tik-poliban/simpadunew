<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_controller{
	function index(){
		$data['pesan']="";
	    $this->form_validation->set_rules('username', 'Username', 'required', array('required'=>'Username harus diisi'));
	    $this->form_validation->set_rules('password', 'Password', 'required', array('required'=>'Password tidak boleh kosong'));
		if ($this->form_validation->run() == FALSE) 
			$this->load->view("login",$data);
	    else
	    {
	    	if($data['dt']=$this->m_umum->cek_login())
			{
				$data_user = array(
			        'id_user'  => $data['dt']['id_user'],
			        'ref_user'     => $data['dt']['ref_user'],
			        'id_level'     => $data['dt']['id_level']
					);
				$this->session->set_userdata($data_user);
				if($data_user['id_level'] == 99 )
					redirect(base_url("sa"));
				else if($data_user['id_level'] == 62 )
					redirect(base_url("kep"));
				else if($data_user['id_level'] == 66 )
					redirect(base_url("keu"));
				else
					show_404();
			}        	
			else
	    	{
	    		$data['pesan']='username password salah';
				$this->load->view("login",$data);			
	    	}
	    }	
	}

	function logout(){
        unset(
            $_SESSION['username'],
            $_SESSION['id_pegawai'],
            $_SESSION['level']
        );  
		$data['pesan']='Logout Sukses';
		$this->load->view("login",$data);			
	}

}
?>
