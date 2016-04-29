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

/**
 *
 * A domain payload object.
 *
 * @package Aura.Payload
 *
 */
class Payload implements PayloadInterface
{
    /**
     *
     * The payload status.
     *
     * @var mixed
     *
     */
    protected $status;

    /**
     *
     * The domain input.
     *
     * @var mixed
     *
     */
    protected $input;

    /**
     *
     * The domain output.
     *
     * @var mixed
     *
     */
    protected $output;

    /**
     *
     * Messages reported by the domain.
     *
     * @var mixed
     *
     */
    protected $messages;

    /**
     *
     * Arbitrary extra information from the domain.
     *
     * @var mixed
     *
     */
    protected $extras;

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
        $this->status = $status;
        return $this;
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
        $this->input = $input;
        return $this;
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
        $this->output = $output;
        return $this;
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
        $this->messages = $messages;
        return $this;
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
        $this->extras = $extras;
        return $this;
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
}
