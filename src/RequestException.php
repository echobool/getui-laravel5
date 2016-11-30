<?php
namespace Echobool\Getui;

/**
 * Class RequestException
 * @package getuisdk
 */
class RequestException extends \Exception
{
    /**
     * @var string
     */
    public $requestId;

    /**
     * @param string $requestId
     * @param int $message
     * @param \Exception $e
     */
    public function __construct($requestId, $message, $e)
    {
        parent::__construct($message, $e);
        $this->requestId = $requestId;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }
}
