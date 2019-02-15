<section id="contable" class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <i class="zmdi zmdi-apps zmdi-hc-lg"></i> Data Monitor
                    </div>
                    <div class="col col-sm-3" id="device-list">
                        <label style="line-height: 32px">Device&nbsp;&nbsp;&nbsp;</label>
                        <select class="form-control auto-width" id="devices">
                            <?php foreach($files as $f): ?>
                                <option value="<?= $f->kode_device ?>"><?= $f->nama_device ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <?= widget("table", $table) ?>
        </div>
    </div>
</section>

<section id="conform" class="row" style="display:none">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam quaerat suscipit ipsa impedit asperiores, voluptatum excepturi nam distinctio esse exercitationem eum minus adipisci porro sunt totam magnam qui nesciunt cum.
</section>