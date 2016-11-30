<?php
namespace Echobool\Getui;

/**
 * Class PBString
 * @package getuisdk
 */
class PBString extends PBScalar
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    }

    /**
     * Parses the message for this type
     *
     * @param array
     */
    public function parseFromArray()
    {
        $this->value = '';
        // first byte is length
        $length = $this->reader->next();

        // just extract the string
        $pointer = $this->reader->getPointer();
        $this->reader->addPointer($length);
        $this->value = $this->reader->getMessageFrom($pointer);
    }

    /**
     * Serializes type
     * @param mixed $rec
     * @return mixed
     */
    public function serializeToString($rec = -1)
    {
        $string = '';

        if ($rec > -1) {
            $string .= $this->base128->setValue($rec << 3 | $this->wired_type);
        }

        $string .= $this->base128->setValue(strlen($this->value));
        $string .= $this->value;

        return $string;
    }
}
