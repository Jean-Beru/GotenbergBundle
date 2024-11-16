<?php

namespace Sensiolabs\GotenbergBundle\Builder;

use Sensiolabs\GotenbergBundle\Webhook\WebhookConfigurationRegistry;
use Sensiolabs\GotenbergBundle\Webhook\WebhookConfigurationRegistryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

trait AsyncBuilderTrait
{
    use DefaultBuilderTrait;

    private string $webhookUrl;

    private string $errorWebhookUrl;

    /**
     * @var array<string, mixed>
     */
    private array $webhookExtraHeaders = [];

    /**
     * @var (\Closure(): string)
     */
    private \Closure $operationIdGenerator;

    private WebhookConfigurationRegistryInterface $webhookConfigurationRegistry;

    protected UrlGeneratorInterface|null $urlGenerator;

    public function generateAsync(): string
    {
        $operationId = ($this->operationIdGenerator ?? self::defaultOperationIdGenerator(...))();
        $this->logger?->debug('Generating a file asynchronously with operation id {sensiolabs_gotenberg.operation_id} using {sensiolabs_gotenberg.builder} builder.', [
            'sensiolabs_gotenberg.operation_id' => $operationId,
            'sensiolabs_gotenberg.builder' => $this::class,
        ]);

        $url = $this->webhookUrl ?? null;
        $errorUrl = $this->errorWebhookUrl ?? null;
        if (!$url || !$errorUrl) {
            if (!($this->urlGenerator ?? null)) {
                throw new \LogicException(\sprintf('A webhook URL or Router is required to use "%s" method. Set the URL or try to run "composer require symfony/routing".', __METHOD__));
            }

            $routerUrl = $this->urlGenerator?->generate('_webhook_controller', ['type' => 'gotenberg'], UrlGeneratorInterface::ABSOLUTE_URL);
            $url ??= $routerUrl;
            $errorUrl ??= $routerUrl;
        }

        $this->webhookExtraHeaders['X-Gotenberg-Operation-Id'] = $operationId;
        $headers = [
            'Gotenberg-Webhook-Url' => $url,
            'Gotenberg-Webhook-Error-Url' => $errorUrl,
            'Gotenberg-Webhook-Extra-Http-Headers' => json_encode($this->webhookExtraHeaders, \JSON_THROW_ON_ERROR),
        ];
        if (null !== $this->fileName) {
            // Gotenberg will add the extension to the file name (e.g. filename : "file.pdf" => generated file : "file.pdf.pdf").
            $headers['Gotenberg-Output-Filename'] = $this->fileName;
        }
        $this->client->call($this->getEndpoint(), $this->getMultipartFormData(), $headers);

        return $operationId;
    }

    public function setWebhookConfigurationRegistry(WebhookConfigurationRegistry $registry): static
    {
        $this->webhookConfigurationRegistry = $registry;

        return $this;
    }

    public function webhookConfiguration(string $webhook): static
    {
        $webhookConfiguration = $this->webhookConfigurationRegistry->get($webhook);

        $result = $this->webhookUrls($webhookConfiguration['success'], $webhookConfiguration['error']);

        if (\array_key_exists('extra_http_headers', $webhookConfiguration)) {
            $result = $result->webhookExtraHeaders($webhookConfiguration['extra_http_headers']);
        }

        return $result;
    }

    public function webhookUrls(string $successWebhook, string|null $errorWebhook = null): static
    {
        $this->webhookUrl = $successWebhook;
        $this->errorWebhookUrl = $errorWebhook ?? $successWebhook;

        return $this;
    }

    /**
     * @param array<string, mixed> $extraHeaders
     */
    public function webhookExtraHeaders(array $extraHeaders): static
    {
        $this->webhookExtraHeaders = array_merge($this->webhookExtraHeaders, $extraHeaders);

        return $this;
    }

    /**
     * @param (\Closure(): string) $operationIdGenerator
     */
    public function operationIdGenerator(\Closure $operationIdGenerator): static
    {
        $this->operationIdGenerator = $operationIdGenerator;

        return $this;
    }

    protected static function defaultOperationIdGenerator(): string
    {
        return 'gotenberg_' . bin2hex(random_bytes(16)) . microtime(true);
    }
}
