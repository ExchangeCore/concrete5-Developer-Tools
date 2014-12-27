<h3>Support Files</h3>
<p>
    <?= t('Support files are used to provide auto-completion support for IDEs. Without these files your IDE may not
    recognize all classes. The support files also add class type detection for <code>Core::make()</code> usages.') ?>
</p>
<p><a href="<?= $view->action('symbols') ?>" class="btn btn-primary"><?= t('Generate Support Files') ?></a></p>
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