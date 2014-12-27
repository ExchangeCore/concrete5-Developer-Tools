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
        $applicationPrefixes = array();
        $packagePrefixes = array();

        $loaders = spl_autoload_functions();
        foreach ($loaders as $loader) {
            if (is_array($loader) && $loader[0] instanceof \Concrete\Core\Foundation\ModifiedPsr4ClassLoader) {
                $reflection = new \ReflectionClass($loader[0]);
                $property = $reflection->getProperty('prefixes');
                $property->setAccessible(true);
                $prefixes = $property->getValue($loader[0]);
                $property->setAccessible(false);

                foreach ($prefixes as $prefix) {
                    if (substr($prefix[0], 0, 12) == 'Application\\') {
                        $applicationPrefixes[$prefix[0]] = $prefix[1];
                    } elseif (preg_match('/^(Concrete\\\\Package\\\\)([A-Za-z_-]+)(\\\\.*)/', $prefix[0], $matches)) {
                        $dir = Core::make('helper/text')->uncamelcase($matches[2]);
                        $path = str_replace($dir, '<em>' . t('package_handle') . '</em>', $prefix[1]);
                        $packagePrefixes[$matches[1] . '<em>' . t('package_handle') . '</em>' . $matches[3]] = $path;
                    }
                }
            }
        }

        $this->set('applicationPrefixes', $applicationPrefixes);
        $this->set('packagePrefixes', $packagePrefixes);
    }

    public function supportFiles()
    {
        $pkg = Package::getByHandle('ec_dev_tools');
        $generator = new SymbolGenerator();
        $symbols = $generator->render();
        file_put_contents($pkg->getPackagePath() . '/__IDE_SYMBOLS__.php', $symbols);

        $generator = new MetadataGenerator();
        $symbols = $generator->render();
        file_put_contents($pkg->getPackagePath() . '/.phpstorm.meta.php', $symbols);

        $this->set('message', t('The support files were generated.'));
        $this->view();
    }
}