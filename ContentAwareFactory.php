<?php

namespace Symfony\Cmf\Bundle\MenuBundle;

use Knp\Menu\Silex\RouterAwareFactory;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Cmf\Bundle\ChainRoutingBundle\Routing\DoctrineRouter;

class ContentAwareFactory extends RouterAwareFactory
{
    protected $content_router = null;

    public function __construct(UrlGeneratorInterface $generator, DoctrineRouter $content_router)
    {
        parent::__construct($generator);
        $this->content_router = $content_router;
    }

    public function createItem($name, array $options = array())
    {
        if (!empty($options['content'])) {
            $options['uri'] = $this->content_router->generate(null, $options);
            unset($options['route']);
        }

        return parent::createItem($name, $options);
    }
}
