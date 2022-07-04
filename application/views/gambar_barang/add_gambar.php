<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Gambar Barang : <?= $barang->nama_barang ?></h3>

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
            // notifikasi form kosong
            echo validation_errors('<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i>', '</h5></div>');

            // notifikasi gagal upload
            if (isset($error_upload)) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i>' . $error_upload . '</h5></div>';
            }
            echo form_open_multipart('gambarbarang/add/' . $barang->id_barang) ?>


            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Keterangan Barang</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Barang" value="<?= set_value('keterangan') ?>">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" id="preview_gambar" class="form-control" required>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/no-photo.jpg') ?>" id="gambar_load" width="200px">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Save</button>
                <a href="<?= base_url('gambarbarang') ?>" class="btn btn-success">Back</a>
            </div>

            <?php echo form_close() ?>
            <hr>

            <div class="row">
                <?php foreach ($gambar as $key => $value) { ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <img src="<?= base_url('assets/gambarbarang/' . $value->gambar) ?>" id="gambar_load" width="200px" height="150px">
                        </div>
                        <p class="text-center"><?= $value->keterangan ?></p>
                        <button class="btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#delete<?= $value->id_gambar ?>"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                <?php } ?>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<?php foreach ($gambar as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value->id_gambar ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $value->keterangan ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus?</p>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('gambarbarang/delete/' . $barang->id_barang . '/' . $value->id_gambar) ?>" class="btn btn-danger">Delete</a>
                </div>


            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.modal delete-->

<?php } ?>

<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#preview_gambar').change(function() {
        bacaGambar(this);
    });
</script>