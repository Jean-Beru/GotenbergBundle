<?php

namespace Sensiolabs\GotenbergBundle\Builder\Screenshot;

use Sensiolabs\GotenbergBundle\Builder\AbstractBuilder;
use Sensiolabs\GotenbergBundle\Builder\Attributes\NormalizeGotenbergPayload;
use Sensiolabs\GotenbergBundle\Builder\Attributes\SemanticNode;
use Sensiolabs\GotenbergBundle\Builder\Behaviors\ChromiumScreenshotTrait;
use Sensiolabs\GotenbergBundle\Builder\Util\NormalizerFactory;
use Sensiolabs\GotenbergBundle\Builder\Util\ValidatorFactory;
use Sensiolabs\GotenbergBundle\Enumeration\Part;
use Sensiolabs\GotenbergBundle\Exception\MissingRequiredFieldException;

/**
 * @see https://gotenberg.dev/docs/routes#screenshots-route
 */
#[SemanticNode('markdown')]
final class MarkdownScreenshotBuilder extends AbstractBuilder
{
    use ChromiumScreenshotTrait {
        content as wrapper;
        contentFile as wrapperFile;
    }

    /**
     * Add Markdown into a PDF.
     *
     * @see https://gotenberg.dev/docs/routes#markdown-files-into-pdf-route
     */
    public function files(string ...$paths): self
    {
        foreach ($paths as $path) {
            $info = new \SplFileInfo($this->getAssetBaseDirFormatter()->resolve($path));
            ValidatorFactory::filesExtension([$info], ['md']);

            $files[$path] = $info;
        }

        $this->getBodyBag()->set('files', $files ?? null);

        return $this;
    }

    public function content(): void
    {
        throw new \BadMethodCallException('Use wrapper() instead of content().');
    }

    public function contentFile(): void
    {
        throw new \BadMethodCallException('Use wrapperFile() instead of contentFile().');
    }

    protected function getEndpoint(): string
    {
        return '/forms/chromium/screenshot/markdown';
    }

    protected function validatePayloadBody(): void
    {
        if ($this->getBodyBag()->get(Part::Body->value) === null) {
            throw new MissingRequiredFieldException('HTML template is required');
        }

        if ($this->getBodyBag()->get('files') === null && $this->getBodyBag()->get('downloadFrom') === null) {
            throw new MissingRequiredFieldException('At least one markdown file is required.');
        }
    }

    #[NormalizeGotenbergPayload]
    private function normalizeFiles(): \Generator
    {
        yield 'files' => NormalizerFactory::asset();
    }
}
