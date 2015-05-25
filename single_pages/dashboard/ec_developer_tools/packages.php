<?php
defined('C5_EXECUTE') or die('Access denied.');

/**
 * @var \Package[] $installed
 * @var \Package[] $pending
 * @var \Concrete\Core\Page\View\PageView $this
 */
?>

<h3>Installed Packages</h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th><?= t('Package') ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var PermissionKey $permission */
    foreach ($installed as $package) {
        ?>
        <tr>
            <td><?= t('%s (v%s)', $package->pkgName, $package->pkgVersion) ?></td>
            <td nowrap style="width: 1px">
                <a href="<?= $this->action('entities', $package->getPackageHandle()) ?>"><?= t('View Entities') ?></a>
                <a href="<?= $this->action('reinstall', $package->getPackageHandle()) ?>"><?= t('Reinstall') ?></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<h3>Pending Packages</h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th><?= t('Package') ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var PermissionKey $permission */
    foreach ($pending as $package) {
        ?>
        <tr>
            <td><?= h($package->getPackageName()) ?></td>
            <td nowrap style="width: 1px">
                <a href="<?= $this->action('entities', $package->getPackageHandle()) ?>"><?= t('View Entities') ?></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>