<?php
namespace Echobool\Getui;

/**
 * Class PBEnum
 * @package getuisdk
 */
class PBEnum extends PBScalar
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
        $string = '';

        if ($rec > -1) {
            $string .= $this->base128->setValue($rec << 3 | $this->wired_type);
        }

        $value = $this->base128->setValue($this->value);
        $string .= $value;

        return $string;
    }
}
