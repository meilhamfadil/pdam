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
        <form id="form" method="POST" action="<?= base_url("rules/save") ?>" role="form">
            <input type="hidden" name="cid" value="<?= $kode_device ?>">
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama_device" class="col-sm-2 col-form-label">Regex</label>
                    <div class="col">
                        <input type="text" class="form-control" id="regex" name="regex" value="<?= $nama_device ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_device" class="col-sm-2 col-form-label">Kasus</label>
                    <div class="col">
                        <input type="text" class="form-control" id="case" name="case" value="<?= $nama_device ?>">
                    </div>
                </div>
                <?= widget("table", "table|No,Kecocokan,Kelompok") ?>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
                <button type="button" id="closeForm" class="btn btn-light float-right m-r-10">Batal</button>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>

<div id="kelompok" class="d-none">
    <select name="kelompok[]" class="form-control">
        <option value="TIME">TIME</option>
        <option value="IPSERVER">IPSERVER</option>
        <option value="EVENT">EVENT</option>
        <option value="INFO">INFO</option>
        <option value="USER">USER</option>
        <option value="DETAIL">DETAIL</option>
        <option value="STATUS">STATUS</option>
        <option value="IPUSER">IPUSER</option>
        <option value="VIA">VIA</option>
    </select>
</div>