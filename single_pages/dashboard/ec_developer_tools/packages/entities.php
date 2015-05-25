<?php
defined('C5_EXECUTE') or die('Access denied.');
/** @var array $entities */
?>
<div class="entities">
    <?php
    if (empty($entities)) {
        echo t('No entities were found.');
    }
    foreach ($entities as $class => $entity) {
        ?>
        <div class="panel panel-<?= !$entity['valid'] ? 'danger' : 'default' ?>">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= t('Entity %s', h($class)) ?>
                </h3>
            </div>
            <div id="ENT=<?= h($class) ?>">
                <?php
                if ($entity['valid']) {
                    /** @var Doctrine\ORM\Mapping\ClassMetadata $metadata */
                    $metadata = $entity['metadata'];
                    ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="2"><?= t('General Info') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td nowrap width="1px"><?= t('Table Name') ?></td>
                            <td><?= h($metadata->getTableName()) ?></td>
                        </tr>
                        <tr>
                            <td nowrap width="1px"><?= t('Identifier Field') ?></td>
                            <td>
                                <?php
                                foreach ($metadata->identifier as $field) {
                                    ?>
                                    <a href="#ENT=<?= h($class) ?>&amp;FLD=<?= h($field) ?>">
                                        <?= h($field) ?>
                                    </a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="5"><?= t('Fields') ?></th>
                        </tr>
                        <tr>
                            <th><?= t('Field Name') ?></th>
                            <th><?= t('Column Name') ?></th>
                            <th><?= t('Type') ?></th>
                            <th><?= t('Unique') ?></th>
                            <th><?= t('Nullable') ?></th>
                            <th><?= t('Fixed') ?></th>
                            <th><?= t('Unsigned') ?></th>
                            <th><?= t('Default') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($metadata->fieldMappings as $field) {
                            ?>
                            <tr id="ENT=<?= h($class) ?>&amp;FLD=<?= h($field['fieldName']) ?>">
                                <td><?= h($field['fieldName']) ?></td>
                                <td><?= h($field['columnName']) ?></td>
                                <td><?= h($field['type'] . ($field['length'] !== null ? '(' . $field['length'] .
                                            ($field['precision'] !== null ? ',' . $field['precision'] : '') . ')' : '')) ?></td>
                                <td><i class="fa fa-<?= $field['unique'] ? 'check' : 'times' ?>"></i></td>
                                <td><i class="fa fa-<?= $field['nullable'] ? 'check' : 'times' ?>"></i></td>
                                <td><i class="fa fa-<?= isset($field['options']['fixed']) && $field['options']['fixed'] ? 'check' : 'times' ?>"></i></td>
                                <td><i class="fa fa-<?= isset($field['options']['unsigned']) && $field['options']['unsigned'] ? 'check' : 'times' ?>"></i></td>
                                <td>
                                    <?php
                                    if (isset($field['options']['default'])) {
                                        if ($field['options']['default'] === null) {
                                            echo '<em>NULL</em>';
                                        } else if ($field['options']['default'] === false) {
                                            echo '<em>FALSE</em>';
                                        } else if ($field['options']['default'] === true) {
                                            echo '<em>TRUE</em>';
                                        } else {
                                            echo h($field['options']['default']);
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                    <?php
                    if (!empty($metadata->associationMappings)) {
                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th colspan="6"><?= t('Association Mappings') ?></th>
                            </tr>
                            <tr>
                                <th><?= t('Field Name') ?></th>
                                <th><?= t('Target Entity') ?></th>
                                <th><?= t('Mapped By') ?></th>
                                <th><?= t('Type') ?></th>
                                <th><?= t('Cascade') ?></th>
                                <th><?= t('Fetch') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($metadata->associationMappings as $mapping) {
                                ?>
                                <tr id="ENT=<?= h($class) ?>&amp;FLD=<?= h($mapping['fieldName']) ?>">
                                    <td><?= h($mapping['fieldName']) ?></td>
                                    <td>
                                        <a href="#ENT=<?= h($mapping['targetEntity']) ?>">
                                            <?= h($mapping['targetEntity']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#ENT=<?= h($mapping['targetEntity']) ?>&amp;FLD=<?= h($mapping['mappedBy']) ?>">
                                            <?= h($mapping['mappedBy']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        switch ($mapping['type']) {
                                            case \Doctrine\ORM\Mapping\ClassMetadataInfo::ONE_TO_ONE:
                                                echo t('One to One');
                                                break;
                                            case \Doctrine\ORM\Mapping\ClassMetadataInfo::ONE_TO_MANY:
                                                echo t('One to Many');
                                                break;
                                            case \Doctrine\ORM\Mapping\ClassMetadataInfo::MANY_TO_ONE:
                                                echo t('Many to One');
                                                break;
                                            case \Doctrine\ORM\Mapping\ClassMetadataInfo::MANY_TO_MANY:
                                                echo t('Many to Many');
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td><?= h(implode(', ', $mapping['cascade'])) ?></td>
                                    <td>
                                        <?php
                                        switch ($mapping['fetch']) {
                                            case \Doctrine\ORM\Mapping\ClassMetadataInfo::FETCH_EAGER:
                                                echo t('Eager');
                                                break;
                                            case \Doctrine\ORM\Mapping\ClassMetadataInfo::FETCH_EXTRA_LAZY:
                                                echo t('Extra Lazy');
                                                break;
                                            case \Doctrine\ORM\Mapping\ClassMetadataInfo::FETCH_LAZY:
                                                echo t('Lazy');
                                                break;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    }

                    if (!empty($metadata->table['indexes'])) {
                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th colspan="2"><?= t('Indexes') ?></th>
                            </tr>
                            <tr>
                                <th><?= t('Index Name') ?></th>
                                <th><?= t('Columns') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($metadata->table['indexes'] as $name => $opts) {
                                ?>
                                <tr>
                                    <td><?= h($name) ?></td>
                                    <td>
                                        <?php
                                        foreach ($opts['columns'] as $column) {
                                            ?>
                                            <a href="#TBL=<?= h($class) ?>&amp;COL=<?= h($column) ?>">
                                                <?= h($column) ?>
                                            </a>
                                            <?php
                                            if (!end($opts['columns'])) {
                                                echo ', ';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    }
                } else {
                    ?>
                    <div class="panel-body">
                        <?= h($entity['reason']) ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
