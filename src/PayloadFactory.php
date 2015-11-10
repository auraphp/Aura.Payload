<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 */
namespace Aura\Payload;

/**
 *
 * A factory to create and return payload objects.
 *
 * @package Aura.Payload
 *
 */
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
