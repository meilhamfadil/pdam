<?php
    $data = explode("|", $_ci_vars);
?>
<table id="<?= $data[0] ?>" class="table table-striped table-bordered">
    <thead>
        <?php foreach(explode(",", $data[1]) as $field): ?>
            <th><?= $field ?></th>
        <?php endforeach; ?>
    </thead>
    <tbody></tbody>
</table>