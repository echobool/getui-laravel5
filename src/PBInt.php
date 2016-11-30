<?php
namespace Echobool\Getui;

/**
 * Class PBInt
 * @package getuisdk
 */
class PBInt extends PBScalar
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
    }

    /**
     * Serializes type
     * @param mixed $rec
     * @return mixed
     */
    public function serializeToString($rec = -1)
    {
        // first byte is length byte
        $string = '';

        if ($rec > -1) {
            $string .= $this->base128->setValue($rec << 3 | $this->wired_type);
        }

        $value = $this->base128->setValue($this->value);
        $string .= $value;

        return $string;
    }
}
