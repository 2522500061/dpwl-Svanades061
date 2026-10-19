<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Mobil</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('Mobil_C/index') ?>">Master Data</a></li>
            <li class="breadcrumb-item active">Data Mobil</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <a href="<?= base_url('Mobil_C/create_mobil') ?>" class="btn btn-primary mb-3">
                <i class="fas fa-car"></i> Tambah Data Mobil
              </a>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No. Plat</th>
                    <th>Nama Mobil</th>
                    <th>Kursi</th>
                    <th>Bagasi</th>
                    <th>Jenis/Transmisi</th>
                    <th>Tahun</th>
                    <th>Foto</th>
                    <th>Biaya Perhari</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dtmobil as $m) : ?>
                  <tr>
                    <td><?= $m['no_plat'] ?></td>
                    <td><?= $m['nm_mobil'] ?></td>
                    <td><?= $m['nkursi'] ?></td>
                    <td><?= $m['nbagasi'] ?></td>
                    <td><?= $m['jns_mobil'] ?> - <?= $m['transmisi'] ?></td>
                    <td><?= $m['thn_buat'] ?></td>
                    <td><?= $m['ft_depan'] ?><br><?= $m['ft_blkg'] ?><br><?= $m['ft_interior'] ?></td>
                    <td><?= number_format($m['hrg_hari'], 2, '.', ',') ?></td>
                    <td><?= $m['cttn_unit'] ?></td>
                    <td><?= $m['status_unit'] ?></td>
                    <td>
                      <a href="#" class="btn btn-warning btn-sm">Edit</a>
                      <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>