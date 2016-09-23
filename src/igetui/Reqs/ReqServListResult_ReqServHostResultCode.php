<?php
/**
 * Created by PhpStorm.
 * User: lacorey
 * Date: 16/9/23
 * Time: 下午2:03
 */

namespace Echobool\Getui\Igetui\Reqs;

use Echobool\Getui\Protobuf\Type\PBEnum;
class ReqServListResult_ReqServHostResultCode extends PBEnum
{
    const successed  = 0;
    const failed  = 1;
    const busy  = 2;
}