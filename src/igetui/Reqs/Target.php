<?php
/**
 * Created by PhpStorm.
 * User: lacorey
 * Date: 16/9/23
 * Time: 下午2:12
 */

namespace Echobool\Getui\Igetui\Reqs;
use Echobool\Getui\Protobuf\PBMessage;

class Target extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = "PBString";
        $this->values["1"] = "";
        $this->fields["2"] = "PBString";
        $this->values["2"] = "";
    }
    function appId()
    {
        return $this->_get_value("1");
    }
    function set_appId($value)
    {
        return $this->_set_value("1", $value);
    }
    function clientId()
    {
        return $this->_get_value("2");
    }
    function set_clientId($value)
    {
        return $this->_set_value("2", $value);
    }
}