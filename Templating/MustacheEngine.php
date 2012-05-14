<?php

namespace BeSimple\Bundle\MustacheBundle\Templating;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\TemplateNameParserInterface;
use Symfony\Component\Templating\Loader\LoaderInterface;

class MustacheEngine implements EngineInterface
{
    protected $mustache;

    protected $parser;

    protected $loader;

    public function __construct(\Mustache $mustache, TemplateNameParserInterface $parser, LoaderInterface $loader)
    {
        $this->mustache = $mustache;

        $this->parser   = $parser;
        $this->loader   = $loader;
    }

    public function render($name, array $parameters = array())
    {
        $template = $this->load($name);

        return $this->mustache->render($template->getContent(), $parameters);
    }

    // Renders a view and returns a Response.
    public function renderResponse($view, array $parameters = array(), Response $response = null)
    {
        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($this->render($view, $parameters));

        return $response;
    }

    public function exists($name)
    {
        try {
            $this->load($name);
        } catch (\InvalidArgumentException $e) {
            return false;
        }

        return true;
    }

    public function supports($name)
    {
        $template = $this->parser->parse($name);

        return 'mustache' === $template->get('engine');
    }

    protected function load($name)
    {
        $templateReference = $this->parser->parse($name);

        if (false === $template = $this->loader->load($templateReference)) {
            throw new \InvalidArgumentException(sprintf('Unable to find template "%s"', (string) $templateReference));
        }

        return $template;
    }
}
