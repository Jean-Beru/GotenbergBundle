<?php

namespace Sensiolabs\GotenbergBundle\Builder\Behaviors;

use Sensiolabs\GotenbergBundle\Builder\Attributes\NormalizeGotenbergPayload;
use Sensiolabs\GotenbergBundle\Builder\Attributes\WithSemanticNode;
use Sensiolabs\GotenbergBundle\Builder\BodyBag;
use Sensiolabs\GotenbergBundle\Builder\Util\NormalizerFactory;
use Sensiolabs\GotenbergBundle\NodeBuilder\BooleanNodeBuilder;

/**
 * @see https://gotenberg.dev/docs/routes#flatten-libreoffice
 */
trait FlattenTrait
{
    abstract protected function getBodyBag(): BodyBag;

    /**
     * Flattening a PDF combines all its contents into a single layer. (default false).
     */
    #[WithSemanticNode(new BooleanNodeBuilder('flatten'))]
    public function flatten(bool $bool = true): self
    {
        $this->getBodyBag()->set('flatten', $bool);

        return $this;
    }

    #[NormalizeGotenbergPayload]
    private function normalizeFlatten(): \Generator
    {
        yield 'flatten' => NormalizerFactory::bool();
    }
}
