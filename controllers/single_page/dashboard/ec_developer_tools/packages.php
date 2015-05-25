<?php
namespace Concrete\Package\EcDevTools\Controller\SinglePage\Dashboard\EcDeveloperTools;

use Concrete\Core\Page\Controller\DashboardPageController;
use \Package;

class Packages extends DashboardPageController
{
    public function view()
    {
        $installed = Package::getInstalledList();
        $installedHandles = Package::getInstalledHandles();
        $all = Package::getAvailablePackages(false);
        $pending = array();

        foreach ($all as $package) {
            if (!in_array($package->getPackageHandle(), $installedHandles)) {
                $pending[] = $package;
            }
        }

        $this->set('installed', $installed);
        $this->set('pending', $pending);
    }

    public function reinstall($packageHandle)
    {
        $package = Package::getByHandle($packageHandle);
        $package->uninstall();
        $package->install();
        $this->set('success', t('Package %s has been successfully reinstalled.', $package->getPackageName()));
        $this->view();
    }
}