<?php
namespace Echobool\Getui;

/**
 * Class GtAuthResultGtAuthResultCode
 * @package getuisdk
 */
class GtAuthResultGtAuthResultCode extends PBEnum
{
    const SUCCESSED = 0;
    const FAILED_NOSIGN = 1;
    const FAILED_NOAPPKEY = 2;
    const FAILED_NOTIMESTAMP = 3;
    const FAILED_AUTHILLEGAL = 4;
    const REDIRECT = 5;
}
