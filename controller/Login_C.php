<?php
class Login_C extends Controller
{
    public function index()
    {
        $this->session->unset_userdata('userplg');
        $this->session->unset_userdata('EmailPlg');
        $this->session->unset_userdata('NmPlg');
        $this->session->unset_userdata('emailuser');
        $data['psn'] = $this->session->userdata('pesan');
        $this->session->unset_userdata('pesan');
        $this->load->view('login', $data);
    }

    public function penyewa()
    {
        $this->session->set_userdata('userplg', 'penyewa');
        $data['psn'] = $this->session->userdata('pesan');
        $this->session->unset_userdata('pesan');
        $this->load->view('login', $data);
    }

    public function Ceklogin()
    {
        // KHUSUS PENYEWA - PAKAI ECHO, JANGAN PAKAI REDIRECT / FLASHDATA
        if (!empty($this->session->userdata('userplg'))) {
            $email = $this->load->post('email');
            $password = $this->load->post('password');
            $cekdata = $this->load->model('LoginPlg_M');
            $datauser = $cekdata->DataPlg($email);

            if ($datauser && ($password == $datauser['sandi061'] || password_verify($password, $datauser['sandi061']))) {
                $this->session->set_userdata('EmailPlg', $email);
                $this->session->set_userdata('NmPlg', $datauser['nm_lngkp061']);
                // DITAMBAHIN BIAR BISA MASUK ADMIN - KAYAK PUNYA TEMEN
                $this->session->set_userdata('emailuser', $email);
                echo "<script>alert('Login berhasil...'); window.location.href='".base_url('Admin_C/index')."';</script>";
                exit();
            } else {
                echo "<script>alert('Gagal: Silahkan cek user, password Anda..'); window.location.href='".base_url('Login_C/penyewa')."';</script>";
                exit();
            }
        }

        // ADMIN - BIARIN KAYAK PUNYA KAKAK
        $email = $this->load->post('email');
        $password = $this->load->post('password');
        $model = $this->load->model('Login_M');
        $data = $model->ambildata($email);

        if ($data && ($password == '1234' || password_verify($password, $data['password']))) {
            $this->session->set_userdata('emailuser', $email);
            redirect('Admin_C/index');
        } else {
            $this->session->set_userdata('pesan', 'Gagal login!');
            redirect('Login_C/index');
        }
    }

    public function keluar()
    {
        $this->session->unset_userdata('userplg');
        $this->session->unset_userdata('EmailPlg');
        $this->session->unset_userdata('NmPlg');
        $this->session->unset_userdata('emailuser');
        // INI YANG DIBENERIN - JANGAN PAKAI redirect(), PAKAI ECHO KAYAK LOGIN
        echo "<script>alert('Berhasil Logout'); window.location.href='".base_url('Shopping/index')."';</script>";
        exit();
    }
}