<?php
namespace Concrete\Package\EcDevTools\Controller\SinglePage\Dashboard;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Support\Symbol\MetadataGenerator;
use Concrete\Core\Support\Symbol\SymbolGenerator;
use Core;
use Package;

class EcDeveloperTools extends DashboardPageController
{
    public function view()
    {

    }

    public function supportFiles()
    {
        $fh = Core::make('helper/file');
        $pkg = Package::getByHandle('ec_dev_tools');
        $generator = new SymbolGenerator();
        $symbols = $generator->render();

        $fh->clear($pkg->getPackagePath() . '/__IDE_SYMBOLS__.php');
        $fh->append($pkg->getPackagePath() . '/__IDE_SYMBOLS__.php', $symbols);

        if (class_exists('\Concrete\Core\Support\Symbol\MetadataGenerator')) {
            $generator = new MetadataGenerator();
            $metadata = $generator->render();
            $fh->clear($pkg->getPackagePath() . '/.phpstorm.meta.php');
            $fh->append($pkg->getPackagePath() . '/.phpstorm.meta.php', $metadata);
        }

        $this->set('message', t('The support files were generated.'));
        $this->view();
    }
}