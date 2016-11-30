<?php
namespace Echobool\Getui;

/**
 * Class PBSignedInt
 * @package getuisdk
 */
class PBSignedInt extends PBScalar
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
     * @throws \InvalidArgumentException
     */
    public function parseFromArray()
    {
        parent::parseFromArray();

        $saved = $this->value;
        $this->value = round($this->value / 2);
        if ($saved % 2 === 1) {
            $this->value = -($this->value);
        }
    }

    /**
     * Serializes type
     * @param mixed $rec
     * @return mixed
     */
    public function serializeToString($rec = -1)
    {
        // now convert signed int to int
        $save = $this->value;
        if ($this->value < 0) {
            $this->value = abs($this->value) * 2 - 1;
        } else {
            $this->value *= 2;
        }
        $string = parent::serializeToString($rec);
        // restore value
        $this->value = $save;

        return $string;
    }
}
