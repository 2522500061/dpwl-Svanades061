<?php
class Mobil_C extends Model
{
    public function index()
    {
        $info['nm_user'] = explode('@', $this->session->userdata('emailuser'))[0];
        $this->load->model('m_master/Mobil_M', 'mobil');
        $dt['dtmobil'] = $this->mobil->datamobil();
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/mobilview', $dt);
        $this->load->view('layout/footer');
    }

    public function create_mobil()
    {
        $info['nm_user'] = explode('@', $this->session->userdata('emailuser'))[0];
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $info);
        $this->load->view('v_master/create_mobilview');
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $this->load->model('m_master/Mobil_M', 'mobil');

        if ($this->mobil->cekplat($this->input->post('no_plat'))) {
            echo "<script>
                alert('Nomor plat sudah terdaftar!');
                window.history.back();
            </script>";
            exit;
        }

        $ft_depan = 'Depan_'. $this->input->post('no_plat');
        $ft_blkg = 'Belakang_'. $this->input->post('no_plat');
        $ft_interior = 'Interior_'. $this->input->post('no_plat');

        $data = [
            'no_plat' => $this->input->post('no_plat'),
            'nm_mobil' => $this->input->post('nm_mobil'),
            'nkursi' => $this->input->post('nkursi'),
            'nbagasi' => $this->input->post('nbagasi'),
            'jns_mobil' => $this->input->post('jns_mobil'),
            'transmisi' => $this->input->post('transmisi'),
            'thn_buat' => $this->input->post('thn_buat'),
            'ft_depan' => $ft_depan,
            'ft_blkg' => $ft_blkg,
            'ft_interior' => $ft_interior,
            'hrg_hari' => $this->input->post('hrg_hari'),
            'cttn_unit' => $this->input->post('cttn_unit'),
            'status_unit' => $this->input->post('status_unit')
        ];

        $simpan = $this->mobil->simpan($data);

        if ($simpan) {
            echo "<script>
                alert('Data mobil berhasil disimpan!');
                window.location.href = '". base_url('Mobil_C/index'). "';
            </script>";
        } else {
            echo "<script>
                alert('Data mobil gagal disimpan!');
                window.history.back();
            </script>";
        }
    }
}