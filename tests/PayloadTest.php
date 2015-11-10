<?php
namespace Aura\Payload;

use Aura\Payload_Interface\PayloadStatus;

class PayloadTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $payload = new Payload();

        $payload
            ->setStatus(PayloadStatus::SUCCESS)
            ->setInput('input')
            ->setOutput('output')
            ->setMessages('messages')
            ->setExtras('extras');

        $this->assertSame(PayloadStatus::SUCCESS, $payload->getStatus());
        $this->assertSame('input', $payload->getInput());
        $this->assertSame('output', $payload->getOutput());
        $this->assertSame('messages', $payload->getMessages());
        $this->assertSame('extras', $payload->getExtras());
    }
}
