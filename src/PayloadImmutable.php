<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 */

namespace Aura\Payload;

use Aura\Payload_Interface\PayloadInterface;
use ReflectionClass;

/**
 *
 * A domain payload object.
 *
 * @package Aura.Payload
 *
 */
class PayloadImmutable implements PayloadInterface
{
    /**
     *
     * The payload status.
     *
     * @var mixed
     *
     */
    private $status;

    /**
     *
     * The domain input.
     *
     * @var mixed
     *
     */
    private $input;

    /**
     *
     * The domain output.
     *
     * @var mixed
     *
     */
    private $output;

    /**
     *
     * Messages reported by the domain.
     *
     * @var mixed
     *
     */
    private $messages;

    /**
     *
     * Arbitrary extra information from the domain.
     *
     * @var mixed
     *
     */
    private $extras;

    /**
     *
     * Sets the payload status.
     *
     * @param mixed $status The payload status.
     *
     * @return self
     *
     */
    public function setStatus($status)
    {
        $cloned = clone $this;
        $cloned->status = $status;

        return $cloned;
    }

    /**
     *
     * Gets the payload status.
     *
     * @return mixed
     *
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * Sets the domain input.
     *
     * @param mixed $input The domain input.
     *
     * @return self
     *
     */
    public function setInput($input)
    {
        $cloned = clone $this;
        $cloned->input = $input;

        return $cloned;
    }

    /**
     *
     * Gets the domain input.
     *
     * @return mixed
     *
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     *
     * Sets the domain output.
     *
     * @param mixed $output The domain output.
     *
     * @return self
     *
     */
    public function setOutput($output)
    {
        $cloned = clone $this;
        $cloned->output = $output;

        return $cloned;
    }

    /**
     *
     * Gets the domain output.
     *
     * @return mixed
     *
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     *
     * Sets the domain messages.
     *
     * @param mixed $messages The domain messages.
     *
     * @return self
     *
     */
    public function setMessages($messages)
    {
        $cloned = clone $this;
        $cloned->messages = $messages;

        return $cloned;
    }

    /**
     *
     * Gets the domain messages.
     *
     * @return mixed
     *
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     *
     * Sets arbitrary extra domain information.
     *
     * @param mixed $extras The domain extras.
     *
     * @return self
     *
     */
    public function setExtras($extras)
    {
        $cloned = clone $this;
        $cloned->extras = $extras;

        return $cloned;
    }

    /**
     *
     * Gets the arbitrary extra domain information.
     *
     * @return mixed
     *
     */
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * Deep clone all properties
     */
    protected function __clone()
    {
        $this->status = $this->deepClone($this->status);
        $this->input = $this->deepClone($this->input);
        $this->output = $this->deepClone($this->output);
        $this->messages = $this->deepClone($this->messages);
        $this->extras = $this->deepClone($this->extras);
    }

    /**
     * Return a cloned property
     *
     * @param $property
     *
     * @return mixed
     */
    protected function deepClone($property)
    {
        if (is_array($property)) {
            $cloned = [];
            foreach ($property as $key => $value) {
                $cloned[$key] = $this->deepClone($value);
            }

            return $cloned;
        }

        if (is_object($property) && (new ReflectionClass($property))->isCloneable()) {
            return clone $property;
        }

        return $property;
    }
}
