<?php
namespace Echobool\Getui;

/**
 * Class PushInfo
 * @package getuisdk
 */
class PushInfo extends PBMessage
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
        $this->fields['2'] = 'PBString';
        $this->values['2'] = '';
        $this->fields['3'] = 'PBString';
        $this->values['3'] = '';
        $this->fields['4'] = 'PBString';
        $this->values['4'] = '';
        $this->fields['5'] = 'PBString';
        $this->values['5'] = '';
        $this->fields['6'] = 'PBString';
        $this->values['6'] = '';
        $this->fields['7'] = 'PBString';
        $this->values['7'] = '';
        $this->fields['8'] = 'PBString';
        $this->values['8'] = '';
        $this->fields['9'] = 'PBString';
        $this->values['9'] = '';
        $this->fields['10'] = 'PBInt';
        $this->values['10'] = '';
        $this->fields["11"] = "PBBool";
        $this->values["11"] = "";
        $this->fields["12"] = "PBString";
        $this->values["12"] = "";
        $this->fields["13"] = "PBBool";
        $this->values["13"] = "";
        $this->fields["14"] = "PBString";
        $this->values["14"] = "";
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMessage($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function actionKey()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setActionKey($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function sound()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSound($value)
    {
        return $this->setValue('3', $value);
    }

    /**
     * @return mixed
     */
    public function badge()
    {
        return $this->getValue('4');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setBadge($value)
    {
        return $this->setValue('4', $value);
    }

    /**
     * @return mixed
     */
    public function payload()
    {
        return $this->getValue('5');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPayload($value)
    {
        return $this->setValue('5', $value);
    }

    /**
     * @return mixed
     */
    public function locKey()
    {
        return $this->getValue('6');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setLocKey($value)
    {
        return $this->setValue('6', $value);
    }

    /**
     * @return mixed
     */
    public function locArgs()
    {
        return $this->getValue('7');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setLocArgs($value)
    {
        return $this->setValue('7', $value);
    }

    /**
     * @return mixed
     */
    public function actionLocKey()
    {
        return $this->getValue('8');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setActionLocKey($value)
    {
        return $this->setValue('8', $value);
    }

    /**
     * @return mixed
     */
    public function launchImage()
    {
        return $this->getValue('9');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setLaunchImage($value)
    {
        return $this->setValue('9', $value);
    }

    /**
     * @return mixed
     */
    public function contentAvailable()
    {
        return $this->getValue('10');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setContentAvailable($value)
    {
        return $this->setValue('10', $value);
    }

    public function invalidAPN()
    {
        return $this->getValue("11");
    }
    public function setInvalidAPN($value)
    {
        return $this->setValue("11", $value);
    }
    public function apnJson()
    {
        return $this->getValue("12");
    }
    public function setApnJson($value)
    {
        return $this->setValue("12", $value);
    }
    public function invalidMPN()
    {
        return $this->getValue("13");
    }
    public function setInvalidMPN($value)
    {
        return $this->setValue("13", $value);
    }
    public function mpnXml()
    {
        return $this->getValue("14");
    }
    public function setMpnXml($value)
    {
        return $this->setvalue("14", $value);
    }
}
