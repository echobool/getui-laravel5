<?php
namespace Echobool\Getui;

/**
 * Class PushResultEPushResult
 * @package getuisdk
 */
class PushResultEPushResult extends PBEnum
{
    const SUCCESSED_ONLINE = 0;
    const SUCCESSED_OFFLINE = 1;
    const SUCCESSED_IGNORE = 2;
    const FAILED = 3;
    const BUSY = 4;
    const SUCCESS_STARTBATCH = 5;
    const SUCCESS_ENDBATCH = 6;
}