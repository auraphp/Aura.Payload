<?php
namespace Aura\Payload;

class PayloadFactory
{
    /**
     *
     * Returns a new Payload object.
     *
     * @return Aura\Payload\Payload
     *
     */
    public function newInstance()
    {
        return new Payload();
    }
}
