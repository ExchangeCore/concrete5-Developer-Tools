<?php
namespace Concrete\Package\EcDevTools\Controller\SinglePage\Dashboard\EcDeveloperTools;

use Concrete\Core\Page\Controller\DashboardPageController;
use Core;

class Services extends DashboardPageController
{
    public function view()
    {
        $services = array();

        $bindings = Core::getBindings();
        foreach ($bindings as $name => $binding) {
            /** @var \Closure $binding */
            $reflection = new \ReflectionFunction($binding['concrete']);
            $static = $reflection->getStaticVariables();
            $className = null;
            if (!isset($static['concrete'])) {
                try {
                    $class = Core::make($name);
                    $className = get_class($class);
                } catch (\Exception $e) {}
            } else {
                $className = $static['concrete'];
            }

            if ($className !== null && $className !== get_class($this)) {
                if ($className[0] !== '\\') {
                    $className = '\\' . $className;
                }

                $services[$name] = array('class' => $className);
            }
        }

        ksort($services);

        $this->set('services', $services);
    }
}
