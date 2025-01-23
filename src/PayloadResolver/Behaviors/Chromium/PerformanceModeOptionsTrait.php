<?php

namespace Sensiolabs\GotenbergBundle\PayloadResolver\Behaviors\Chromium;

use Sensiolabs\GotenbergBundle\PayloadResolver\Util\NormalizerFactory;
use Symfony\Component\OptionsResolver\OptionsResolver;

trait PerformanceModeOptionsTrait
{
    abstract protected function getBodyOptionsResolver(): OptionsResolver;

    protected function configureOptions(): void
    {
        $this->getBodyOptionsResolver()
            ->define('skipNetworkIdleEvent')
            ->info('Do not wait for Chromium network to be idle.')
            ->allowedTypes('bool')
            ->normalize(NormalizerFactory::bool())
        ;
    }
}
