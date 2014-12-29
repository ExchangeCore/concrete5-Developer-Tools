<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<h3><?= t('Application Namespaces') ?></h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th><?= t('Namespace') ?></th>
        <th><?= t('Directory') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($applicationPrefixes as $prefix => $directory) {
        ?>
        <tr>
            <td><?= $prefix ?></td>
            <td><?= $directory ?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<hr/>
<h3><?= t('Package Namespaces') ?></h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th><?= t('Namespace') ?></th>
        <th><?= t('Directory') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($packagePrefixes as $prefix => $directory) {
        ?>
        <tr>
            <td><?= $prefix ?></td>
            <td><?= $directory ?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>