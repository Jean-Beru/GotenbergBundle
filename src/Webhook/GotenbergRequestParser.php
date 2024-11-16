<?php

namespace Sensiolabs\GotenbergBundle\Webhook;

use Sensiolabs\GotenbergBundle\RemoteEvent\ErrorGotenbergEvent;
use Sensiolabs\GotenbergBundle\RemoteEvent\SuccessGotenbergEvent;
use Sensiolabs\GotenbergBundle\Utils\HeaderUtils;
use Symfony\Component\HttpFoundation\ChainRequestMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher\MethodRequestMatcher;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\RemoteEvent\RemoteEvent;
use Symfony\Component\Webhook\Client\AbstractRequestParser;
use Symfony\Component\Webhook\Exception\RejectWebhookException;

/**
 * @see https://gotenberg.dev/docs/webhook
 */
class GotenbergRequestParser extends AbstractRequestParser
{
    public function __construct(
        private readonly string $idHeaderName = 'Gotenberg-Trace',
    ) {
    }

    protected function getRequestMatcher(): RequestMatcherInterface
    {
        return new ChainRequestMatcher([
            new MethodRequestMatcher('POST'),
        ]);
    }

    protected function doParse(Request $request, #[\SensitiveParameter] string $secret): RemoteEvent|null
    {
        if (!$request->headers->has($this->idHeaderName)) {
            throw new RejectWebhookException(406, \sprintf('Missing "%s" HTTP request header.', $this->idHeaderName));
        }

        if ('Gotenberg' !== ($type = $request->headers->get('User-Agent', ''))) {
            throw new RejectWebhookException(406, \sprintf('Invalid user agent "%s".', $type));
        }

        if ('json' === $request->getContentTypeFormat()) {
            /** @var array{status: string, message: string} $payload */
            $payload = $request->toArray();

            return new ErrorGotenbergEvent(
                $request->headers->get($this->idHeaderName) ?? '',
                $payload,
                $payload['status'],
                $payload['message'],
            );
        }

        return new SuccessGotenbergEvent(
            $request->headers->get($this->idHeaderName) ?? '',
            $request->getContent(true),
            HeaderUtils::extractFilename($request->headers) ?? '',
            $request->headers->get('Content-Type', ''),
            HeaderUtils::extractContentLength($request->headers) ?? 0,
        );
    }
}
