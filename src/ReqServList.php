<?php
namespace Echobool\Getui;

/**
 * Class ReqServList
 * @package getuisdk
 */
class ReqServList extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'PBString';
        $this->values['1'] = '';
        $this->fields['3'] = 'PBInt';
        $this->values['3'] = '';
    }

    /**
     * @return mixed
     */
    public function seqId()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSeqId($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function timestamp()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTimestamp($value)
    {
        return $this->setValue('3', $value);
    }
}
