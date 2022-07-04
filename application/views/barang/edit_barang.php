<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Edit Barang</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <?php
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
            echo form_open_multipart('barang/edit/' . $barang->id_barang) ?>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" value="<?= $barang->nama_barang ?>">
            </div>

            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control">
                            <option value="<?= $barang->id_kategori ?>"><?= $barang->nama_kategori ?></option>
                            <?php foreach ($kategori as $key => $value) { ?>
                                <option value="<?= $value->id_kategori ?>"><?= $value->nama_kategori ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control" placeholder="Harga" value="<?= $barang->harga ?>">
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" cols="30" rows="5" placeholder="Deskripsi Barang"><?= $barang->deskripsi ?></textarea>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" id="preview_gambar" class="form-control">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>" id="gambar_load" width="400px">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2">Save</button>
                <a href="<?= base_url('barang') ?>" class="btn btn-success">Back</a>
            </div>

            <?php echo form_close() ?>

        </div>
    </div>
</div>

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