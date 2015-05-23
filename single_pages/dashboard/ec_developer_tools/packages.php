<?php
defined('C5_EXECUTE') or die('Access denied.');

/**
 * @var \Package[] $packages
 * @var \Concrete\Core\Page\View\PageView $this
 */
?>

<h3><?= t('Packages') ?></h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th><?= t('Package') ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($packages as $package) {
        ?>
        <tr>
            <td><?= t('%s (v%s)', $package->pkgName, $package->pkgVersion) ?></td>
            <td nowrap style="width: 1px">
                <a href="<?= $this->action('reinstall', $package->getPackageID()) ?>"><?= t('Reinstall') ?></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>