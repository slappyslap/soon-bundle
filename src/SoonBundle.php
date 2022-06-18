<?php

namespace SoonBundle;

use SoonBundle\DependencyInjection\SoonBundleExtension;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SoonBundle extends Bundle
{

    public function getContainerExtension(): Extension
    {
        if (null === $this->extension) {
            $this->extension = new SoonBundleExtension();
        }

        return $this->extension;
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}