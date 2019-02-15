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
        <form id="form" method="POST" action="<?= base_url("watermeter/save") ?>" role="form">
            <input type="hidden" name="cid" value="<?= $kode_watermeter ?>">
            <div class="card-body">				
                <div class="form-group row">
                    <label for="nama_device" class="col-sm-2 col-form-label text-right">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Nama" name="name" value="<?= $name ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_file" class="col-sm-2 col-form-label text-right">Nama Pendek</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nickname" placeholder="Nama Pendek" name="nickname" value="<?= $nickname ?>">
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