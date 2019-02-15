<section id="contable" class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <i class="zmdi zmdi-apps zmdi-hc-lg"></i> Daftar Perangkat
                    </div>
                    <div class="col col-sm-5 text-right">
                        <button class="btn btn-sm btn-primary" id="openForm">
                            <i class="zmdi zmdi-plus"></i> Tambah Perangkat
                        </button>
                    </div>
                </div>
            </div>
            <?= widget("table", $table) ?>
        </div>
    </div>
</section>

<section id="conform" class="row" style="display:none"></section>