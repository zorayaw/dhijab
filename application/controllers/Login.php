<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }
    function index()
    {
        if ($this->session->userdata('masuk') == true && $this->session->userdata('akses') == 1) {
            redirect("owner/Barang");
        } else if ($this->session->userdata('masuk') == true && $this->session->userdata('akses') == 2) {
            redirect("admin/Pemesanan");
        } else if ($this->session->userdata('masuk') == true && $this->session->userdata('akses') == 3) {
            redirect("stok/Stock");
        } else {
            $this->load->view('v_login');
        }
    }

    function authadmin()
    {
        $username = strip_tags(str_replace("'", "", $this->input->post('username')));
        $password = strip_tags(str_replace("'", "", $this->input->post('password')));
        $u = $username;
        $p = $password;
        $cadmin = $this->M_login->cekuser($u, $p);
        if ($cadmin->num_rows() > 0) {
            $this->session->set_userdata('masuk', true);
            $this->session->set_userdata('user', $u);
            $xcadmin = $cadmin->row_array();
            if ($xcadmin['user_level'] == '1') {
                $this->session->set_userdata('akses', '1');
                $id = $xcadmin['user_id'];
                $user_nama = $xcadmin['user_nama'];
                $user_hp = $xcadmin['user_hp'];
                $this->session->set_userdata('hp', $user_hp);
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('nama', $user_nama);
                redirect('owner/Barang');
            } else if ($xcadmin['user_level'] == '2') {
                $this->session->set_userdata('akses', '2');
                $id = $xcadmin['user_id'];
                $user_nama = $xcadmin['user_nama'];
                $user_hp = $xcadmin['user_hp'];
                $this->M_login->insertDataLogin($u, $id);
                $this->session->set_userdata('hp', $user_hp);
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('nama', $user_nama);      
                redirect('admin/Pemesanan');
            } else {
                $this->session->set_userdata('akses', '3');
                $id = $xcadmin['user_id'];
                $user_nama = $xcadmin['user_nama'];
                $user_hp = $xcadmin['user_hp'];
                $this->session->set_userdata('hp', $user_hp);
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('nama', $user_nama);
                redirect('stok/Stock');
            }
            //Front Office 
        } else {
            redirect('Login/gagallogin');
        }
    }


    function gagallogin()
    {
        $url = base_url('Login');
        echo $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Username Atau Password Salah</div>');
        redirect($url);
    }
    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('Login');
        redirect($url);
    }

    function viewDataLogin(){
        if($this->session->userdata('akses') == 1 ){
        $x['data_login'] = $this->M_login->getAllDataLogin();
        var_dump($x['data_login']);
        }
        else
        redirect('Login');

    }
}
