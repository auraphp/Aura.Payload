<?php
namespace Aura\Payload;

class PayloadTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $payload = new Payload();

        $payload->setStatus($payload::SUCCESS)
            ->setInput('input')
            ->setOutput('output')
            ->setCode('code')
            ->setMessage('message')
            ->setExtras('extras');

        $this->assertSame($payload::SUCCESS, $payload->getStatus());
        $this->assertSame('input', $payload->getInput());
        $this->assertSame('output', $payload->getOutput());
        $this->assertSame('code', $payload->getCode());
        $this->assertSame('message', $payload->getMessage());
        $this->assertSame('extras', $payload->getExtras());
    }
}
