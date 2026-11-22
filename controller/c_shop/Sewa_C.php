<?php
class Sewa_C extends Controller
{
    public function simpan($no_plat)
    {
        // Ambil email pelanggan dari session
        $email = $this->session->userdata('EmailPlg');
        if (!$email) {
            echo "<script>
                alert('Silakan login terlebih dahulu!');
                window.history.back();
            </script>";
            exit;
        }

        $sewa = $this->load->model('m_shop/Sewa_M');

        $kode = $sewa->CekTransaksi($email);
        if (!$kode) {
            $kode = $sewa->buat_kode_sewa();
            // HEADER: Tabel sewa
            $data_sewa = [
                'kode_sewa'   => $kode,
                'tgl_mulai'   => date('Y-m-d'),
                'tgl_selesai' => date('Y-m-d'),
                'status_sewa' => 'Keranjang',
                'user_plg'    => $email
            ];
            $sewa->simpan($data_sewa);
        }

        // Cek keberadaan data mobil - BIAR GAK DOBEL KAYAK PUNYA TEMEN
        $cekdata = $sewa->CekDataPilih($kode, $no_plat);
        if ($cekdata) {
            echo "<script>
                alert('Mobil Sudah dipilih..!');
                window.history.back();
            </script>";
            exit;
        }

        // Data detail
        $hrgmobil = $this->load->model('m_master/Mobil_M');
        $ambilhrg = $hrgmobil->detailmobil($no_plat);
        $data_pilih = [
            'kode_sewa' => $kode,
            'no_plat'   => $no_plat,
            'hrg_sewa'  => $ambilhrg['hrg_hari'],
            'n_hari'    => 0
        ];
        $dtpilih = $sewa->simpandetail($data_pilih);

        if ($dtpilih !== false) {
            echo "<script>
            alert('Mobil berhasil dimasukkan ke keranjang!');
            window.history.back();
        </script>";
            exit;
        }
    }

    // INI YANG BARU KAK - BUAT NAMPILIN KERANJANG
    public function index()
    {
        $email = $this->session->userdata('EmailPlg');
        if (!$email) {
            echo "<script>
                alert('Silakan login terlebih dahulu!');
                window.location.href = '" . base_url('c_shop/Login') . "';
            </script>";
            exit;
        }

        $sewa = $this->load->model('m_shop/Sewa_M');
        $kode = $sewa->CekTransaksi($email);

        $dt['kode_sewa'] = $kode;
        $dt['keranjang'] = $kode ? $sewa->TampilKeranjang($kode) : [];
        $dt['jml'] = $kode ? $sewa->HitungKeranjang($kode) : 0;

        $this->load->view('layout/header_shop');
        $this->load->view('v_shop/keranjang061', $dt);
        $this->load->view('layout/footer_shop');
    }

    // INI BUAT VIEW DETAIL KAYAK PUNYA TEMEN KAKAK
    public function detail($no_plat)
    {
        $mobil_m = $this->load->model('m_master/Mobil_M');
        $dt['mobil'] = $mobil_m->detailmobil($no_plat);
        $this->load->view('layout/header_shop');
        $this->load->view('v_shop/detail_mobil061', $dt);
        $this->load->view('layout/footer_shop');
    }
}