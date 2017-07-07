<?php

namespace Aura\Payload;

use Aura\Payload_Interface\PayloadStatus;

class PayloadImmutableTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $payload = new PayloadImmutable();

        /** @var PayloadImmutable $payload */
        $payload = $payload
            ->setStatus(PayloadStatus::SUCCESS)
            ->setInput('input')
            ->setOutput(['this', 'is', 'an', 'output'])
            ->setMessages('messages')
            ->setExtras('extras');

        $this->assertSame(PayloadStatus::SUCCESS, $payload->getStatus());
        $this->assertSame('input', $payload->getInput());
        $this->assertSame(['this', 'is', 'an', 'output'], $payload->getOutput());
        $this->assertSame('messages', $payload->getMessages());
        $this->assertSame('extras', $payload->getExtras());
    }

    public function testObjectImmutability()
    {
        $object = new \DateTime();
        $payload = new PayloadImmutable();

        $payload = $payload->setStatus($object);
        $this->assertSame($object, $payload->getStatus());

        $payload = $payload->setInput('input');
        $this->assertNotSame($object, $payload->getStatus());
    }

    public function testArrayImmutability()
    {
        $array = [new \DateTime(), 12, 'string'];
        $payload = new PayloadImmutable();

        $payload = $payload->setStatus($array);
        $this->assertSame($array, $payload->getStatus());

        $payload = $payload->setInput('input');
        $this->assertNotSame($array, $payload->getStatus());
    }
}
