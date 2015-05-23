<?php

namespace Concrete\Package\EcDevTools;

use Package;
use SinglePage;

class Controller extends Package
{
    protected $pkgHandle = 'ec_dev_tools';
    protected $appVersionRequired = '5.7.0.4';
    protected $pkgVersion = '1.0.0';

    public function getPackageName()
    {
        return t('ExchangeCore Dev Tools');
    }

    public function getPackageDescription()
    {
        return t('Provides some tools useful for developers.');
    }

    public function install()
    {
        $pkg = parent::install();
        $page = SinglePage::add('/dashboard/ec_developer_tools', $pkg);
        $page->updateCollectionName(t('Developer Tools'));
        SinglePage::add('/dashboard/ec_developer_tools/namespaces', $pkg);
        SinglePage::add('/dashboard/ec_developer_tools/services', $pkg);
        SinglePage::add('/dashboard/ec_developer_tools/packages', $pkg);
        return $pkg;
    }
}
