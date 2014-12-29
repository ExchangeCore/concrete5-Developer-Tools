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

                $reflectionClass = new \ReflectionClass($className);
                $comment = $reflectionClass->getDocComment();

                $docs = $this->parseDocBlock($comment);

                $services[$name] = array('class' => $className, 'docs' => $docs);
            }
        }

        ksort($services);

        $this->set('services', $services);
    }

    private function parseDocBlock($docBlock) {
        $docs = array();
        preg_match_all('/\/\*\*\r?\n((?:.*\r?\n)+)[ \t]*\*\//', $docBlock, $docBlocks);
        if (count($docBlocks) > 1) {
            for ($i = 1; $i < count($docBlocks); $i++) {
                $lines = explode("\n", $docBlocks[$i][0]);
                array_pop($lines);
                foreach ($lines as &$line) {
                    $line = ltrim($line, " \t*");
                }

                $lines = implode("\n", $lines);
                $lines = nl2br($lines);

                $docs[] = $lines;
            }
        }

        return $docs;
    }
}