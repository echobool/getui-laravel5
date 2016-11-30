<?php
namespace Echobool\Getui;

/**
 * Class DictionaryAlertMsg
 * @package getuisdk
 */
class DictionaryAlertMsg implements ApnMsg
{
    /**
     * @var string $title
     */
    public $title;
    /**
     * @var string $body
     */
    public $body;
    /**
     * @var string $titleLocKey
     */
    public $titleLocKey;
    /**
     * @var array $titleLocArgs
     */
    public $titleLocArgs = array();
    /**
     * @var string $actionLocKey
     */
    public $actionLocKey;
    /**
     * @var string $locKey
     */
    public $locKey;
    /**
     * @var array $locArgs
     */
    public $locArgs = array();
    /**
     * @var string $launchImage
     */
    public $launchImage;

    /**
     * @return array|null
     */
    public function getAlertMsg()
    {

        $alertMap = array();

        if ($this->title !== null && $this->title !== '') {
            $alertMap['title'] = $this->title;
        }
        if ($this->body !== null && $this->body !== '') {
            $alertMap['body'] = $this->body;
        }
        if ($this->titleLocKey !== null && $this->titleLocKey !== '') {
            $alertMap['title-loc-key'] = $this->titleLocKey;
        }
        if (count($this->titleLocArgs) > 0) {
            $alertMap['title-loc-args'] = $this->titleLocArgs;
        }
        if ($this->actionLocKey !== null && $this->actionLocKey) {
            $alertMap['action-loc-key'] = $this->actionLocKey;
        }
        if ($this->locKey !== null && $this->locKey !== '') {
            $alertMap['loc-key'] = $this->locKey;
        }
        if (count($this->locArgs) > 0) {
            $alertMap['loc-args'] = $this->locArgs;
        }
        if ($this->launchImage !== null && $this->launchImage !== '') {
            $alertMap['launch-image'] = $this->launchImage;
        }

        if (count($alertMap) === 0) {
            return null;
        }

        return $alertMap;
    }
}
