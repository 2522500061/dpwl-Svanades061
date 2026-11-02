<?php
class Penyewa_C061 extends Controller
{
    public function index()
    {
        $model = $this->load->model('m_master/Penyewa_M061');
        $dt['dtpenyewa'] = $model->datapenyewa061();
        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : 'Admin 061';
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/penyewaview061', $dt);
        $this->load->view('layout/footer');
    }

    // INI YANG HILANG DI FOTO KAKAK - WAJIB ADA!
    public function create_penyewa()
    {
        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : 'Admin 061';
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/create_penyewaview061');
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $model = $this->load->model('m_master/Penyewa_M061');
        
        // Handle upload foto
        $ft_ktp = $this->uploadFoto('ft_ktp');
        $ft_sim = $this->uploadFoto('ft_sim_a');

        $data = [
            'user_plg061' => $this->load->post('user_plg061'),
            'sandi061' => $this->load->post('sandi061'),
            'nik061' => $this->load->post('nik061'),
            'nm_lngkp061' => $this->load->post('nm_lngkp061'),
            'no_hp061' => $this->load->post('no_hp061'),
            'almt_lngkp061' => $this->load->post('almt_lngkp061'),
            'ft_ktp' => $ft_ktp,
            'ft_sim_a' => $ft_sim
        ];
        
        if($model->simpan061($data)){
            header('Location: '.base_url('?url=c_master/Penyewa_C061/index'));
            exit;
        } else {
            echo "Gagal simpan";
        }
    }

    public function edit($id)
    {
        $model = $this->load->model('m_master/Penyewa_M061');
        $dt['penyewa'] = $model->detail061($id);
        $email = $this->session->userdata('emailuser');
        $info['nm_user'] = $email ? explode('@', $email)[0] : 'Admin 061';
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/update_penyewaview061', $dt);
        $this->load->view('layout/footer');
    }

    public function UpdatePenyewa()
    {
        $model = $this->load->model('m_master/Penyewa_M061');
        $ft_ktp = $this->uploadFoto('ft_ktp');
        $ft_sim = $this->uploadFoto('ft_sim_a');

        $data = [
            'user_plg061' => $this->load->post('user_plg061'),
            'user_lama061' => $this->load->post('user_lama061'),
            'sandi061' => $this->load->post('sandi061'),
            'nik061' => $this->load->post('nik061'),
            'nm_lngkp061' => $this->load->post('nm_lngkp061'),
            'no_hp061' => $this->load->post('no_hp061'),
            'almt_lngkp061' => $this->load->post('almt_lngkp061'),
            'ft_ktp' => $ft_ktp,
            'ft_sim_a' => $ft_sim
        ];
        $model->ubah061($data);
        header('Location: '.base_url('?url=c_master/Penyewa_C061/index'));
        exit;
    }

    public function hapus($id)
    {
        $model = $this->load->model('m_master/Penyewa_M061');
        $model->hapus061($id);
        header('Location: '.base_url('?url=c_master/Penyewa_C061/index'));
        exit;
    }

    private function uploadFoto($field)
    {
        if(isset($_FILES[$field]) && $_FILES[$field]['error'] == 0){
            $target = './assets/foto_penyewa/';
            if(!is_dir($target)) mkdir($target, 0777, true);
            $nama = time().'_'.$_FILES[$field]['name'];
            move_uploaded_file($_FILES[$field]['tmp_name'], $target.$nama);
            return $nama;
        }
        return null;
    }
}