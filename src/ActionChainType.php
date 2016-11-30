<?php
namespace Echobool\Getui;

/**
 * Class ActionChainType
 * @package getuisdk
 */
class ActionChainType extends PBEnum
{
    const REFER = 0;
    const NOTIFICATION = 1;
    const POPUP = 2;
    const STARTAPP = 3;
    const STARTWEB = 4;
    const SMSINBOX = 5;
    const CHECKAPP = 6;
    const EOA = 7;
    const APPDOWNLOAD = 8;
    const STARTSMS = 9;
    const HTTPPROXY = 10;
    const SMSINBOX2 = 11;
    const MMSINBOX2 = 12;
    const POPUPWEB = 13;
    const DIAL = 14;
    const REPORTBINDAPP = 15;
    const REPORTADDPHONEINFO = 16;
    const REPORTAPPLIST = 17;
    const TERMINATETASK = 18;
    const REPORTAPP = 19;
    const ENABLELOG = 20;
    const DISABLELOG = 21;
    const UPLOADLOG = 22;
}
