<?php
namespace Echobool\Getui;

/**
 * Class PBInputReader
 * @package getuisdk
 */
abstract class PBInputReader
{
    /**
     * @var Base128Varint
     */
    protected $base128;
    protected $pointer = 0;
    protected $string = '';


    public function __construct()
    {
        $this->base128 = new Base128Varint(1);
    }

    /**
     * Gets the acutal position of the point
     * @return int the pointer
     */
    public function getPointer()
    {
        return $this->pointer;
    }

    /**
     * Add add to the pointer
     * @param int $add - int to add to the pointer
     */
    public function addPointer($add)
    {
        $this->pointer += $add;
    }

    /**
     * Get the message from from to actual pointer
     * @param from
     * @return mixed
     */
    public function getMessageFrom($from)
    {
        return substr($this->string, $from, $this->pointer - $from);
    }

    /**
     * Getting the next varint as decimal number
     * @return mixed
     */
    abstract public function next();
}
