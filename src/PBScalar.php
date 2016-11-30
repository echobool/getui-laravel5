<?php
namespace Echobool\Getui;

/**
 * Class PBScalar
 * @package getuisdk
 */
class PBScalar extends PBMessage
{
    /**
     * Set scalar value
     * @param mixed $value
     * @return mixed
     */
    public function setValue($value,$index=0)
    {
        $this->value = $value;
    }

    /**
     * Get the scalar value
     */
    public function getValue($index=0)
    {
        return $this->value;
    }
}
