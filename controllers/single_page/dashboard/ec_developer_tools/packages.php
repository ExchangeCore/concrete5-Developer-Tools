<?php
namespace Concrete\Package\EcDevTools\Controller\SinglePage\Dashboard\EcDeveloperTools;

use Concrete\Core\Package\PackageList;
use Concrete\Core\Page\Controller\DashboardPageController;
use \Package;

class Packages extends DashboardPageController
{
    public function view()
    {
        $packages = PackageList::get();
        $this->set('packages', Package::getInstalledList());
    }

    public function reinstall($packageId)
    {
        $package = Package::getByID($packageId);
        $package->uninstall();
        $package->install();
        $this->set('success', t('Package %s has been successfully reinstalled.', $package->getPackageName()));
        $this->view();
    }
}