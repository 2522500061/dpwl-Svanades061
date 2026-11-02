<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Update Penyewa 061</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('?url=c_master/Penyewa_C061/index') ?>">Master Penyewa</a></li>
                        <li class="breadcrumb-item active">Update 061</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-edit"></i> Form Update - <?= $penyewa['nik061'] ?> / <?= $penyewa['nm_lngkp061'] ?></h3>
                </div>

                <form action="<?= base_url('?url=c_master/Penyewa_C061/UpdatePenyewa') ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="user_plg061" class="form-control" value="<?= $penyewa['user_plg061'] ?>" required>
                                    <input type="hidden" name="user_lama061" value="<?= $penyewa['user_plg061'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="sandi061" class="form-control" value="<?= $penyewa['sandi061'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik061" class="form-control" value="<?= $penyewa['nik061'] ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nm_lngkp061" class="form-control" value="<?= $penyewa['nm_lngkp061'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" name="no_hp061" class="form-control" value="<?= $penyewa['no_hp061'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Foto KTP</label><br>
                                    <?php if(!empty($penyewa['ft_ktp'])): ?>
                                    <img src="<?= base_url('assets/foto_penyewa/'.$penyewa['ft_ktp']) ?>" width="120" style="border-radius:5px; margin-bottom:5px;"><br>
                                    <?php endif; ?>
                                    <input type="file" name="ft_ktp" class="form-control" accept="image/*">
                                    <small>Kosongkan jika tidak ganti</small>
                                    <input type="hidden" name="ft_ktp_asli" value="<?= $penyewa['ft_ktp'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <textarea name="almt_lngkp061" class="form-control" rows="4" required><?= $penyewa['almt_lngkp061'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Foto SIM A</label><br>
                                    <?php if(!empty($penyewa['ft_sim_a'])): ?>
                                    <img src="<?= base_url('assets/foto_penyewa/'.$penyewa['ft_sim_a']) ?>" width="120" style="border-radius:5px; margin-bottom:5px;"><br>
                                    <?php endif; ?>
                                    <input type="file" name="ft_sim_a" class="form-control" accept="image/*">
                                    <small>Kosongkan jika tidak ganti</small>
                                    <input type="hidden" name="ft_sim_a_asli" value="<?= $penyewa['ft_sim_a'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                        <a href="<?= base_url('?url=c_master/Penyewa_C061/index') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>