<?php
class Penyewa_M061 extends Model
{
    function datapenyewa061()
    {
        $dt = $this->db->prepare("SELECT user_plg061, sandi061, nik061, nm_lngkp061, no_hp061, almt_lngkp061, ft_ktp, ft_sim_a FROM penyewa");
        if (!$dt) {
            die("Query gagal, cek tabel penyewa: " . $this->db->error);
        }
        $dt->execute();
        return $dt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    function cekuser061($user_plg061)
    {
        $sql = $this->db->prepare("SELECT user_plg061 FROM penyewa WHERE user_plg061 = ?");
        $sql->bind_param("s", $user_plg061);
        $sql->execute();
        return $sql->get_result()->num_rows > 0;
    }

    function simpan061($data)
    {
        foreach($data as $k => $v){ if($v===null) $data[$k]=''; }
        $sql = $this->db->prepare("INSERT INTO penyewa (user_plg061, sandi061, nik061, nm_lngkp061, no_hp061, almt_lngkp061, ft_ktp, ft_sim_a) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$sql) die("Simpan gagal: " . $this->db->error);
        $sql->bind_param("ssssssss",
            $data['user_plg061'],
            $data['sandi061'],
            $data['nik061'],
            $data['nm_lngkp061'],
            $data['no_hp061'],
            $data['almt_lngkp061'],
            $data['ft_ktp'],
            $data['ft_sim_a']
        );
        return $sql->execute();
    }

    function detail061($user_plg061)
    {
        $sql = $this->db->prepare("SELECT * FROM penyewa WHERE user_plg061 = ?");
        $sql->bind_param("s", $user_plg061);
        $sql->execute();
        return $sql->get_result()->fetch_assoc();
    }

    function ubah061($data)
    {
        foreach($data as $k => $v){ if($v===null) $data[$k]=''; }
        $stmt = $this->db->prepare("UPDATE penyewa SET user_plg061=?, sandi061=?, nik061=?, nm_lngkp061=?, no_hp061=?, almt_lngkp061=?, ft_ktp=?, ft_sim_a=? WHERE user_plg061=?");
        if (!$stmt) die("Update gagal: " . $this->db->error);
        $stmt->bind_param("sssssssss",
            $data['user_plg061'],
            $data['sandi061'],
            $data['nik061'],
            $data['nm_lngkp061'],
            $data['no_hp061'],
            $data['almt_lngkp061'],
            $data['ft_ktp'],
            $data['ft_sim_a'],
            $data['user_lama061']
        );
        return $stmt->execute();
    }

    function hapus061($user_plg061)
    {
        $sql = $this->db->prepare("DELETE FROM penyewa WHERE user_plg061 = ?");
        $sql->bind_param("s", $user_plg061);
        return $sql->execute();
    }
}