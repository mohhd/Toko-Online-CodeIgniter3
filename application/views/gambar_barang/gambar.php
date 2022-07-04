<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Gambar Barang</h3>

            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php

            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
                echo $this->session->flashdata('pesan');
                echo '</h5></div>';
            }

            ?>
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Cover</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($gambarbarang as $key => $value) { ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value->nama_barang ?></td>
                            <td class="text-center"><img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" alt="<?= $value->gambar ?>" width="100px"></td>
                            <td class="text-center">
                                <h4><span class="badge badge-primary"><?= $value->total_gambar ?></span></h4>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('gambarbarang/add/' . $value->id_barang) ?>" class="btn btn-success"><i class="fas fa-plus"></i> Add Gambar</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>