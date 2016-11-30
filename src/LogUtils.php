<?php
namespace Echobool\Getui;

/**
 * Class LogUtils
 * @package getuisdk
 */
class LogUtils
{
    /**
     * @var bool
     */
    public static $debug = true;

    /**
     * @param $log
     */
    public static function debug($log)
    {
        if (LogUtils::$debug) {
            echo date('y-m-d h:i:s', time()) . ($log) . PHP_EOL;
        }
    }
}
