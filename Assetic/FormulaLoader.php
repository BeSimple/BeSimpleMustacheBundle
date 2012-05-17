<?php

namespace BeSimple\Bundle\MustacheBundle\Assetic;

use Assetic\Factory\Loader\FormulaLoaderInterface;
use Assetic\Factory\Resource\ResourceInterface;

use BeSimple\Bundle\MustacheBundle\Templating\MustacheEngine;

class FormulaLoader implements FormulaLoaderInterface
{
    private $engine;
    private $debug;

    public function __construct(MustacheEngine $engine, $debug)
    {
        $this->setEngine($engine);
        $this->setDebug($debug);
    }

    public function setEngine(MustacheEngine $engine)
    {
        $this->engine = $engine;
    }

    public function getEngine()
    {
        return $this->engine;
    }

    public function setDebug($debug)
    {
        $this->debug = (bool) $debug;
    }

    public function isDebugging()
    {
        return $this->debug;
    }

    public function load(ResourceInterface $resource)
    {
        return array();
    }
}
