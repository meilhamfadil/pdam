<?php
    extract($_SESSION);
?>
<section id="contable" class="row m-b-20">
    <?php if(1==0): ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="zmdi zmdi-account zmdi-hc-lg"></i> Profil
            </div>
            <form action="">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">
                            Nama User
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control max-width n-b bg-white" value="<?= $username ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">
                            Hak Akses
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control max-width n-b bg-white" value="<?= $username ?>" disabled>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif ;?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="zmdi zmdi-account zmdi-hc-lg"></i> Ganti Kata Kunci
            </div>
            <form id="form" method="POST" role="form" action="<?= base_url("profile/update") ?>">
                <div class="card-body">
                    <input type="hidden" name="password[]" value="<?= $password ?>">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">
                            Sandi Lama
                        </label>
                        <div class="col-sm-6">
                            <input type="password" name="password[]" class="form-control max-width">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">
                            Sandi Baru
                        </label>
                        <div class="col-sm-6">
                            <input type="password" name="password[]" class="form-control max-width">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label text-right">
                            Ulangi Sandi Baru
                        </label>
                        <div class="col-sm-6">
                            <input type="password" name="password[]" class="form-control max-width">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>