<?php

    if(isset($data)){
        extract((Array) $data);
    } else {
        $flist = array();
        foreach($fields as $f){
            $flist[$f] = "";
        }
        extract($flist);
    }

?>

<div class="col">
    <div class="card">
        <div class="card-header">
            <i class="zmdi zmdi-apps zmdi-hc-lg"></i> Form
        </div>
        <form id="form" method="POST" action="<?= base_url("pelanggan/save") ?>" role="form">
            <input type="hidden" name="cid" value="<?= $kode_pelanggan ?>">
            <div class="card-body">
				<div class="form-group row">
                    <label for="nama_device" class="col-sm-2 col-form-label text-right">KTP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ktp" placeholder="KTP" name="ktp" value="<?= $ktp ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_device" class="col-sm-2 col-form-label text-right">Nama Depan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_depan" placeholder="Nama Depan" name="nama_depan" value="<?= $nama_depan ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_file" class="col-sm-2 col-form-label text-right">Nama Belakang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_belakang" placeholder="Nama Belakang" name="nama_belakang" value="<?= $nama_belakang ?>">
                    </div>
                </div>
				<div class="form-group row">
                    <label for="nama_file" class="col-sm-2 col-form-label text-right">Alamat</label>
                    <div class="col-sm-10">
						<textarea class="form-control" name="alamat" placeholder="alamat" id="alamat"><?= $alamat ?></textarea>
                    </div>
                </div>
				<div class="form-group row">
                    <label for="nama_file" class="col-sm-2 col-form-label text-right">No Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="telepon" placeholder="telepon" name="telepon" value="<?= $telepon ?>">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
                <button type="button" id="closeForm" class="btn btn-light float-right m-r-10">Batal</button>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>