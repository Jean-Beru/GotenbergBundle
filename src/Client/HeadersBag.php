<?php

namespace Sensiolabs\GotenbergBundle\Client;

use Sensiolabs\GotenbergBundle\Exception\InvalidBuilderConfiguration;
use Symfony\Component\Mime\Header\Headers;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeadersBag
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(
        private readonly OptionsResolver $resolver,
        private array $data = [],
    ) {
    }

    public function get(string $name, mixed $default = null): mixed
    {
        return $this->data[$name] ?? $default;
    }

    public function set(string $name, mixed $value): static
    {
        $this->data[$name] = $value;

        return $this;
    }

    public function unset(string $name): static
    {
        unset($this->data[$name]);

        return $this;
    }

    /**
     * Compiles the values into an array to send to the HTTP client.
     */
    public function resolve(): Headers
    {
        try {
            $data = $this->resolver->resolve($this->data);
        } catch (ExceptionInterface $e) {
            throw new InvalidBuilderConfiguration($e->getMessage(), 0, $e);
        }

        $headers = new Headers();
        foreach ($data as $name => $value) {
            if (null === $value) {
                continue;
            }
            $headers->addHeader($name, $value);
        }

        return $headers;
    }
}