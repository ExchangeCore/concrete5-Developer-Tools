<h3>Support Files</h3>
<p><a href="<?= $view->action('symbols') ?>" class="btn btn-primary"><?= t('Generate Symbols File') ?></a> <?= t('A symbols file will help your IDE auto-complete classes that are aliased.') ?></p>
<?php
if (class_exists('\Concrete\Core\Support\ServiceProvider\MetadataGenerator')) {
    ?>
    <p><a href="<?= $view->action('metadata') ?>"
          class="btn btn-primary"><?= t('Generate PhpStorm/IntellJ IDEA Metadata File') ?></a> <?= t('A metadata file helps PhpStorm and IntelliJ auto-complete instances created using Core::make().') ?>
    </p>
<?php
}
?>
<hr />
<h3>Application Namespaces</h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Namespace</th>
        <th>Directory</th>
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
<hr />
<h3>Package Namespaces</h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Namespace</th>
        <th>Directory</th>
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