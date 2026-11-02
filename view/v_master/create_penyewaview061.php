<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Entri Penyewa 061</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('?url=c_master/Penyewa_C061/index') ?>">Master Penyewa</a></li>
                        <li class="breadcrumb-item active">Entri 061</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-plus"></i> Form Entri Penyewa 061</h3>
                </div>
                <form action="<?= base_url('?url=c_master/Penyewa_C061/simpan') ?>" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label>Username (user_plg061)</label><input type="text" name="user_plg061" class="form-control" required></div>
                                <div class="form-group"><label>Password (sandi061)</label><input type="password" name="sandi061" class="form-control" required></div>
                                <div class="form-group"><label>NIK (nik061)</label><input type="text" name="nik061" class="form-control" maxlength="16" required></div>
                                <div class="form-group"><label>Nama Lengkap (nm_lngkp061)</label><input type="text" name="nm_lngkp061" class="form-control" required></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label>No HP (no_hp061)</label><input type="text" name="no_hp061" class="form-control" required></div>
                                <div class="form-group"><label>Alamat Lengkap (almt_lngkp061)</label><textarea name="almt_lngkp061" class="form-control" rows="3" required></textarea></div>
                                <div class="form-group"><label>Foto KTP (ft_ktp)</label><input type="file" name="ft_ktp" class="form-control" accept=".jpg,.jpeg,.png"></div>
                                <div class="form-group"><label>Foto SIM A (ft_sim_a)</label><input type="file" name="ft_sim_a" class="form-control" accept=".jpg,.jpeg,.png"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('?url=c_master/Penyewa_C061/index') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>