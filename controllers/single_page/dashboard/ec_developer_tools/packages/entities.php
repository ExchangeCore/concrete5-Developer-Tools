<?php
namespace Concrete\Package\EcDevTools\Controller\SinglePage\Dashboard\EcDeveloperTools\Packages;

use Cache;
use Concrete\Core\Page\Controller\DashboardPageController;
use Doctrine\Common\Annotations\AnnotationException;
use \Package;

class Entities extends DashboardPageController
{
    public function view($packageHandle)
    {
        Cache::disableAll();
        $package = Package::getClass($packageHandle);
        $em = $package->getEntityManager();
        $cmf = $em->getMetadataFactory();
        $driver = $em->getConfiguration()->newDefaultAnnotationDriver($package->getPackageEntitiesPath());
        $classes = $driver->getAllClassNames();

        $tests = array();
        foreach ($classes as $class) {
            try {
                $tests[$class]['metadata'] = $cmf->getMetadataFor($class);
                $tests[$class]['valid'] = true;
            } catch (AnnotationException $e) {
                $tests[$class]['valid'] = false;
                $tests[$class]['reason'] = $e->getMessage();
            }
        }

        $this->set('entities', $tests);
        Cache::enableAll();
    }

}