<?php
namespace Echobool\Getui;

/**
 * Class GtAuthResult
 * @package getuisdk
 */
class GtAuthResult extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'PBInt';
        $this->values['1'] = '';
        $this->fields['2'] = 'PBString';
        $this->values['2'] = '';
        $this->fields['3'] = 'PBString';
        $this->values['3'] = '';
        $this->fields['4'] = 'PBString';
        $this->values['4'] = '';
    }

    /**
     * @return mixed
     */
    public function code()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setCode($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function redirectAddress()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setRedirectAddress($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function seqId()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSeqId($value)
    {
        return $this->setValue('3', $value);
    }

    /**
     * @return mixed
     */
    public function info()
    {
        return $this->getValue('4');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setInfo($value)
    {
        return $this->setValue('4', $value);
    }
}
