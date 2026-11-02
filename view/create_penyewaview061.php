<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('?url=c_master/Penyewa_C061/index') ?>">Master Penyewa 061</a></li>
                        <li class="breadcrumb-item active">Entri Penyewa 061</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i> Form Entri Data Penyewa 061</h3>
                </div>
                <form action="<?= base_url('?url=c_master/Penyewa_C061/simpan') ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label>Username (user_pjg061)</label><input type="text" name="user_pjg061" class="form-control" required></div>
                                <div class="form-group"><label>Sandi (Sandi061)</label><input type="password" name="Sandi061" class="form-control" required></div>
                                <div class="form-group"><label>NIK (Nik061)</label><input type="text" name="Nik061" class="form-control" required></div>
                                <div class="form-group"><label>Nama Lengkap (NamaLengkap061)</label><input type="text" name="NamaLengkap061" class="form-control" required></div>
                                <div class="form-group"><label>No HP (no_hp061)</label><input type="text" name="no_hp061" class="form-control" required></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label>Alamat Lengkap (almt_lngkp061)</label><textarea name="almt_lngkp061" class="form-control" required rows="3"></textarea></div>
                                <div class="form-group"><label>Foto KTP (R_idp061)</label><input type="file" name="R_idp061" class="form-control" accept=".jpg,.jpeg,.png"></div>
                                <div class="form-group"><label>Foto SIM A (R_sim_a061)</label><input type="file" name="R_sim_a061" class="form-control" accept=".jpg,.jpeg,.png"></div>
                                <div class="callout callout-info mt-3">
                                    <small><b>Catatan UTS 061:</b> Semua name input wajib pakai 061 sesuai soal. Jika tidak, tidak ada nilai.</small>
                                </div>
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