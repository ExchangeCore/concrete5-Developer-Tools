<?php
namespace Concrete\Package\EcDevTools\Controller\SinglePage\Dashboard\EcDeveloperTools;

use Concrete\Core\Page\Controller\DashboardPageController;
use Core;

class Namespaces extends DashboardPageController
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
}