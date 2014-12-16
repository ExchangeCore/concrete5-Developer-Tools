<?php
namespace Concrete\Package\EcDevTools\Controller\SinglePage\Dashboard;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Support\ServiceProvider\MetadataGenerator;
use Concrete\Core\Support\Symbol\SymbolGenerator;
use Core;
use Google_Auth_Exception;
use Google_Client;
use Google_Service_Analytics;
use Exception;
use Package;

class EcDeveloperTools extends DashboardPageController
{
    public function view()
    {

    }

    public function symbols()
    {
        $pkg = Package::getByHandle('ec_dev_tools');
        $generator = new SymbolGenerator();
        $symbols = $generator->render();
        file_put_contents($pkg->getPackagePath() . '/__IDE_SYMBOLS__.php', $symbols);
        $this->set('message', t('A symbols file was generated.'));
    }

    public function metadata()
    {
        $pkg = Package::getByHandle('ec_dev_tools');
        $generator = new MetadataGenerator();
        $symbols = $generator->render();
        file_put_contents($pkg->getPackagePath() . '/.phpstorm.meta.php', $symbols);
        $this->set('message', t('A metadata file was generated.'));
    }
}