<ul class="sidebar navbar-nav">
    <?php 
        $this->load->helper("menu");
        foreach(getParentMenu($_SESSION['role']) as $m):
        extract((Array) $m);
        $tautan = ($tautan == "#") ? "#" : base_url($tautan);
        $child = getChildMenu($_SESSION['role'], $kode);
        $active = (($toggle == $mtoggle) ? "active" : " ");
        $hasChild = (count($child) > 0) ? "role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"" : "";
        $hasChildClass = (count($child) > 0) ? "dropdown " : " ";
        $hasChildClassLink = (count($child) > 0) ? "dropdown-toggle " : " ";
    ?>
        <li class="nav-item <?= $hasChildClass . $active ?>">
            <a class="nav-link <?= $hasChildClassLink ?>" id="menu<?= $kode ?>" href="<?= $tautan ?>" <?= $hasChild ?>>
                <i class="zmdi zmdi-<?= $ikon ?>"></i>
                <span><?= ucwords($nama) ?></span>
            </a>
            <?php if(count($child)): ?>
                <div class="dropdown-menu" aria-labelledby="menu<?= $kode ?>">
                    <?php foreach($child as $c): ?>
                        <a class="dropdown-item" href="<?= base_url($c->tautan) ?>"><?= ucwords($c->nama) ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif?>
        </li>
    <?php endforeach; ?>
</ul>