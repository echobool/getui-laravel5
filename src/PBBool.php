<?php
namespace Echobool\Getui;

/**
 * Class PBBool
 * @package getuisdk
 */
class PBBool extends PBInt
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_VARINT;

    }

    /**
     * Parses the message for this type
     *
     * @param array
     */
    public function parseFromArray()
    {
        $this->value = $this->reader->next();
        $this->value = ($this->value !== 0) ? 1 : 0;
    }
}
