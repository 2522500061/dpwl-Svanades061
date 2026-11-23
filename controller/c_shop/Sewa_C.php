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
            'n_hari'    => 1
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

    // INI BUAT NAMPILIN KERANJANG - UDAH DIGANTI JADI keranjang() - PUNYA DOSEN SLIDE 5
    public function keranjang()
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

        // TAMBAHAN DARI SLIDE 5 & 6 - PUNYA DOSEN
        $dt['datakeranjang'] = $dt['keranjang']; // biar $datakeranjang[0] bisa dipakai di view
        $dt['status_sewa'] = 'Keranjang';
        $dt['pesan'] = '';

        // BUAT ISI INFORMASI TRANSAKSI - PUNYA DOSEN
        $header = $kode ? $sewa->TampilSewa($kode) : null;
        $dt['tgl_mulai'] = $header['tgl_mulai'] ?? date('Y-m-d');
        $dt['tgl_selesai'] = $header['tgl_selesai'] ?? date('Y-m-d');
        $dt['wkt_ambil'] = $header['wkt_ambil'] ?? '';

        // BUAT HEADER SHOP - BIAR NAMA & BADGE KERANJANG MUNCUL
        $dt['EmPlg'] = $email;
        $dt['NmPlg'] = $this->session->userdata('NamaPlg');
        $dt['dtkeranjang'] = $dt['jml'];

        // PAKAI PUNYA DOSEN
        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('v_master_shop/keranjang_view', $dt);
        $this->load->view('layoutshop/footershop');
    }

    // BIAR KALAU ADA YANG PANGGIL index() JUGA TETEP JALAN
    public function index()
    {
        $this->keranjang();
    }

    // INI BUAT TOMBOL HAPUS DI KERANJANG - UDAH DIGANTI JADI PUNYA DOSEN
    public function hapus($parameter)
    {
        $data = explode(',', $parameter);
        $no_plat = $data[0];
        $kode_sewa = $data[1];
        $mobil = $this->load->model('m_shop/Sewa_M');
        $hapus = $mobil->HapusDtKeranjang($no_plat, $kode_sewa);
        if ($hapus) {
            echo "<script>alert('Data mobil dikeranjang berhasil dihapus'); window.location.href = '" . base_url('c_shop/Sewa_C/keranjang') . "';</script>";
        } else {
            echo "<script>alert('Data mobil dikeranjang gagal dihapus'); window.history.back();</script>";
        }
    }

    // INI BUAT TOMBOL ✅ UPDATE KERANJANG DI ATAS - UDAH DIGANTI JADI PUNYA DOSEN
    public function updatekeranjang()
    {
        $kode_sewa = $_POST['kode_sewa'];
        $tgl_mulai = $_POST['tgl_mulai'];
        $tgl_selesai = $_POST['tgl_selesai'];
        $wkt_ambil = $_POST['wkt_ambil'];

        $sewa = $this->load->model('m_shop/Sewa_M');
        $update = $sewa->UpdateKeranjang($kode_sewa, $tgl_mulai, $tgl_selesai, $wkt_ambil);

        if ($update) {
            echo "<script>alert('Keranjang berhasil diupdate'); window.location.href = '" . base_url('c_shop/Sewa_C/keranjang') . "';</script>";
        } else {
            echo "<script>alert('Keranjang gagal diupdate'); window.history.back();</script>";
        }
    }

    // INI YANG UDAH AKU BENERIN KAK - BIAR GAK ERROR LAGI KALAU KODE NYA KOSONG!
    public function checkout($kode_sewa = null)
    {
        // KALAU KODE NYA KOSONG, AMBIL DARI KERANJANG YANG LAGI AKTIF
        if (!$kode_sewa) {
            $email = $this->session->userdata('EmailPlg');
            $sewa_tmp = $this->load->model('m_shop/Sewa_M');
            $kode_sewa = $sewa_tmp->CekTransaksi($email);
        }

        // KALAU TETEP GAK ADA, BALIKIN KE KERANJANG
        if (!$kode_sewa) {
            echo "<script>
                alert('Keranjang masih kosong, pilih mobil dulu ya!');
                window.location.href = '" . base_url('c_shop/Sewa_C/keranjang') . "';
            </script>";
            return;
        }

        $sewa = $this->load->model('m_shop/Sewa_M');
        $dt['datacheckout'] = $sewa->DataCheckout($kode_sewa);

        // Ambil header sewa buat tanggalnya
        $header = $sewa->TampilSewa($kode_sewa);
        $dt['kode_sewa'] = $kode_sewa;
        $dt['tgl_mulai'] = $header['tgl_mulai'] ?? date('Y-m-d');
        $dt['tgl_selesai'] = $header['tgl_selesai'] ?? date('Y-m-d');
        $dt['wkt_ambil'] = $header['wkt_ambil'] ?? '';
        $dt['status_sewa'] = $header['status_sewa'] ?? 'Keranjang';

        // Hitung total
        $total = 0;
        foreach ($dt['datacheckout'] as $d) {
            $total += ($d['hrg_sewa'] ?? 0) * ($d['n_hari'] ?? 1);
        }
        $dt['total'] = $total;
        $dt['total_sewa'] = $total;

        $dt['EmPlg'] = $this->session->userdata('EmailPlg');
        $dt['NmPlg'] = $this->session->userdata('NamaPlg');
        $dt['dtkeranjang'] = $sewa->HitungKeranjang($kode_sewa);

        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('v_master_shop/checkout_view', $dt);
        $this->load->view('layoutshop/footershop');
    }

    // INI YANG UDAH AKU BENERIN KAK - BIAR GAK ERROR Shop_C LAGI!
    public function ajukantransaksi($kode_sewa)
    {
        $sewa = $this->load->model('m_shop/Sewa_M');
        $hasil = $sewa->ajukantransaksi($kode_sewa);
        if ($hasil) {
            echo "<script>
                alert('Transaksi berhasil diajukan, silahkan lanjutkan pembayaran ini dari total pembayaran...');
                window.location.href = '" . base_url('c_shop/Sewa_C/keranjang') . "';
            </script>";
        } else {
            echo "<script>
                alert('Transaksi gagal diajukan');
                window.location.href = '" . base_url('c_shop/Sewa_C/keranjang') . "';
            </script>";
        }
    }

    // INI BUAT UPDATE JUMLAH HARI DI KERANJANG - BUAT JAGA-JAGA AJA
    public function update_hari()
    {
        $kode = $_POST['kode_sewa'];
        $no_plat = $_POST['no_plat'];
        $hari = $_POST['n_hari'];
        $sewa = $this->load->model('m_shop/Sewa_M');
        $sewa->update_hari($kode, $no_plat, $hari);
        header('Location: ' . base_url('c_shop/Sewa_C/keranjang'));
        exit;
    }

    // INI BUAT VIEW DETAIL KAYAK PUNYA TEMEN KAKAK
    public function detail($no_plat)
    {
        $mobil_m = $this->load->model('m_master/Mobil_M');
        $dt['mobil'] = $mobil_m->detailmobil($no_plat);

        // BUAT HEADER SHOP
        $dt['EmPlg'] = $this->session->userdata('EmailPlg');
        $dt['NmPlg'] = $this->session->userdata('NamaPlg');

        // PAKAI PUNYA DOSEN JUGA
        $this->load->view('layoutshop/headershop', $dt);
        $this->load->view('v_master_shop/detail_mobil_view', $dt);
        $this->load->view('layoutshop/footershop');
    }
}