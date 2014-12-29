<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th><?= t('Name') ?></th>
        <th><?= t('Class') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($services as $name => $service) {
        ?>
        <tr>
            <td><?= $name ?></td>
            <?php
            if (substr($service['class'], 0, 9) == '\\Concrete') {
                ?>
                <td>
                    <a href="http://concrete5.org/api/class-<?= str_replace('\\', '.', ltrim($service['class'], '\\')) ?>.html"
                       target="_blank"><?= $service['class'] ?></a>
                </td>
                <?php
            } else {
                ?>
                <td><?= $service['class'] ?></td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>