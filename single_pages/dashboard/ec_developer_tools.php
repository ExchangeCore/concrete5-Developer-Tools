<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<h3>Support Files</h3>
<p>
    <?= t('Support files are used to provide auto-completion support for IDEs. Without these files your IDE may not
    recognize all classes. The support files also add class type detection for <code>Core::make()</code> usages.') ?>
</p>
<p><a href="<?= $view->action('supportFiles') ?>" class="btn btn-primary"><?= t('Generate Support Files') ?></a></p>