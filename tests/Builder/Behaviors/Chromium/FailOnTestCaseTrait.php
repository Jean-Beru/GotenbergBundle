<?php

namespace Sensiolabs\GotenbergBundle\Tests\Builder\Behaviors\Chromium;

use Sensiolabs\GotenbergBundle\Builder\BuilderInterface;
use Sensiolabs\GotenbergBundle\Enumeration\EmulatedMediaType;
use Sensiolabs\GotenbergBundle\Enumeration\UserAgent;
use Sensiolabs\GotenbergBundle\Tests\Builder\Behaviors\BehaviorTrait;

/**
 * @template T of BuilderInterface
 */
trait FailOnTestCaseTrait
{
    /** @use BehaviorTrait<T> */
    use BehaviorTrait;

    abstract protected function assertGotenbergFormData(string $field, string $expectedValue): void;

    public function testFailOnHttpStatusCodes(): void
    {
        $this->getDefaultBuilder()
            ->failOnHttpStatusCodes([401])
            ->generate()
        ;

        $this->assertGotenbergFormData('failOnHttpStatusCodes', '[401]');
    }

    public function testFailOnResourceHttpStatusCodes(): void
    {
        $this->getDefaultBuilder()
            ->failOnResourceHttpStatusCodes([401])
            ->generate()
        ;

        $this->assertGotenbergFormData('failOnResourceHttpStatusCodes', '[401]');
    }

    public function testFailOnResourceLoadingFailed(): void
    {
        $this->getDefaultBuilder()
            ->failOnResourceLoadingFailed()
            ->generate()
        ;

        $this->assertGotenbergFormData('failOnResourceLoadingFailed', 'true');
    }

    public function testFailOnConsoleExceptions(): void
    {
        $this->getDefaultBuilder()
            ->failOnConsoleExceptions()
            ->generate()
        ;

        $this->assertGotenbergFormData('failOnConsoleExceptions', 'true');
    }
}
