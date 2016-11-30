<?php
namespace Echobool\Getui;

/**
 * Abstract Message class
 * @author Nikolai Kordulla
 */
abstract class PBMessage
{
    const WIRED_VARINT = 0;
    const WIRED_64BIT = 1;
    const WIRED_LENGTH_DELIMITED = 2;
    const WIRED_START_GROUP = 3;
    const WIRED_END_GROUP = 4;
    const WIRED_32BIT = 5;
    /**
     * @var Base128Varint
     */
    public $base128;

    /**
     * @var array $fields  here are the field types
     */
    public $fields = array();

    /**
     * @var array $values the values for the fields
     */
    public $values = array();

    /**
     * @var int $wired_type type of the class
     */
    public $wired_type = 2;

    /**
     * @var PBMessage $value the value of a class
     */
    public $value;

    // modus byte or string parse (byte for productive string for better reading and debuging)
    // 1 = byte, 2 = String

    const MODUS = 1;

    /**
     * @var object $reader
     */
    protected $reader;

    /**
     * @var string $chunk
     */
    public $chunk = '';

    /**
     * @var string $dString variable for send method
     */
    public $dString = '';

    /**
     * Constructor - initialize base128 class
     * @param object $reader reader object
     */
    public function __construct($reader)
    {
        $this->reader = $reader;
        $this->value = $this;
        $this->base128 = new Base128Varint(PBMessage::MODUS);
    }

    /**
     * Get the wired_type and field_type
     * @param $number
     * @return array wired_type, field_type
     */
    public function getTypes($number)
    {
        $binstring = decbin((int) $number);
        $types = array();
        $mlen = strlen($binstring) - 3;
        $low = substr($binstring, $mlen, strlen($binstring));
        $high = substr($binstring, 0, $mlen) . '0000';
        $types['wired'] = bindec($low);
        $types['field'] = bindec($binstring) >> 3;
        return $types;
    }


    /**
     * Encodes a Message
     * @param mixed $rec
     * @return string the encoded message
     */
    public function serializeToString($rec = -1)
    {
        $string = '';
        // wired and type
        if ($rec > -1) {
            $string .= $this->base128->setValue($rec << 3 | $this->wired_type);
        }

        $stringinner = '';

        foreach ($this->fields as $index => $field) {
            if (is_array($this->values[$index]) && count($this->values[$index]) > 0) {
                // make serialization for every array
                foreach ($this->values[$index] as $array) {
                    $newstring = '';

                    if (method_exists($array, 'serializeToString')) {
                        $newstring .= $array->serializeToString($index);
                    }

                    $stringinner .= $newstring;
                }
            } elseif ($this->values[$index] !== null) {
                // wired and type
                $newstring = '';
                if (method_exists($this->values[$index], 'serializeToString')) {
                    $newstring .= $this->values[$index]->serializeToString($index);
                }

                $stringinner .= $newstring;
            }
        }

        $this->serializeChunk($stringinner);

        if ($this->wired_type === PBMessage::WIRED_LENGTH_DELIMITED && $rec > -1) {
            $stringinner = $this->base128->setValue(strlen($stringinner) / PBMessage::MODUS) . $stringinner;
        }

        return $string . $stringinner;
    }

    /**
     * Serializes the chunk
     * @param String $stringinner - String where to append the chunk
     */
    public function serializeChunk(&$stringinner)
    {
        $stringinner .= $this->chunk;
    }

    /**
     * Decodes a Message and Built its things
     *
     * @param  string $message as stream of hex example '1a 03 08 96 01'
     * @throws \InvalidArgumentException
     */
    public function parseFromString($message)
    {
        $this->reader = new PBInputStringReader($message);
        $this->parseFromArray();
    }

    /**
     * Internal function
     * @throws \InvalidArgumentException
     */
    public function parseFromArray()
    {
        $this->chunk = '';
        // read the length byte
        $length = $this->reader->next();
        // just take the splice from this array
        $this->childParseFromArray($length);
    }

    /**
     * Internal function
     * @throws \InvalidArgumentException
     */
    private function childParseFromArray($length = 99999999)
    {
        $_begin = $this->reader->getPointer();
        while ($this->reader->getPointer() - $_begin < $length) {
            $next = $this->reader->next();
            if ($next === false) {
                break;
            }

            // now get the message type
            $messtypes = $this->getTypes($next);

            // now make method test
            if (!array_key_exists($messtypes['field'], $this->fields)) {
                // field is unknown so just ignore it
                // throw new \Exception('Field ' . $messtypes['field'] . ' not present ');
                if ((int) $messtypes['wired'] === PBMessage::WIRED_LENGTH_DELIMITED) {
                    $consume = new PBString($this->reader);
                } elseif ((int) $messtypes['wired'] === PBMessage::WIRED_VARINT) {
                    $consume = new PBInt($this->reader);
                } else {
                    throw new \InvalidArgumentException('I dont understand this wired code:' . $messtypes['wired']);
                }

                // perhaps send a warning out
                // @TODO SEND CHUNK WARNING
                $_oldpointer = $this->reader->getPointer();
                $consume->parseFromArray();
                // now add array from _oldpointer to pointer to the chunk array
                $this->chunk .= $this->reader->getMessageFrom($_oldpointer);
                continue;
            }

            // now array or not
            if (is_array($this->values[$messtypes['field']])) {
                $this->values[$messtypes['field']][] = new $this->fields[$messtypes['field']]($this->reader);
                $index = count($this->values[$messtypes['field']]) - 1;
                if ($messtypes['wired'] !== $this->values[$messtypes['field']][$index]->wired_type) {
                    throw new \InvalidArgumentException('Expected type:' . $messtypes['wired']
                        . ' but had ' . $this->fields[$messtypes['field']]->wired_type);
                }
                if (method_exists($this->values[$messtypes['field']][$index], 'parseFromArray')) {
                    $this->values[$messtypes['field']][$index]->parseFromArray();
                }
            } else {
                $this->values[$messtypes['field']] = new $this->fields[$messtypes['field']]($this->reader);
                if ($messtypes['wired'] !== $this->values[$messtypes['field']]->wired_type) {
                    throw new \InvalidArgumentException('Expected type:' . $messtypes['wired']
                        . ' but had ' . $this->fields[$messtypes['field']]->wired_type);
                }
                if (method_exists($this->values[$messtypes['field']], 'parseFromArray')) {
                    $this->values[$messtypes['field']]->parseFromArray();
                }
            }
        }
    }

    /**
     * Add an array value
     * @param int - index of the field
     */
    protected function addArrValue($index)
    {
        $class_name = $this->fields[$index];
        $real_class_name = __NAMESPACE__ . "\\" . $class_name;
        return $this->values[$index][] = new $real_class_name();
    }

    /**
     * Set an array value - @TODO failure check
     * @param int - index of the field
     * @param int - index of the array
     * @param object - the value
     */
    protected function setArrValue($index, $index_arr, $value)
    {
        $this->values[$index][$index_arr] = $value;
    }

    /**
     * Remove the last array value
     * @param int - index of the field
     */
    protected function removeLastArrValue($index)
    {
        array_pop($this->values[$index]);
    }

    /**
     * Set an value
     * @param int - index of the field
     * @param Mixed $value
     * @return mixed
     */
    protected function setValue($index, $value)
    {
        if (gettype($value) === 'object') {
            $this->values[$index] = $value;
        } else {
            $class_name = $this->fields[$index];
            $real_class_name = __NAMESPACE__ . "\\" . $class_name;
            $this->values[$index] = new $real_class_name();
            $this->values[$index]->value = $value;
        }
        return $this;
    }


    /**
     * Get a value
     * @param string $index id of the field
     * @return mixed
     */
    protected function getValue($index)
    {
        if ($this->values[$index] === null) {
            return null;
        }
        return $this->values[$index]->value;
    }

    /**
     * Get array value
     * @param string $index id of the field
     * @param string $value
     */
    protected function getArrValue($index, $value)
    {
        return $this->values[$index][$value];
    }

    /**
     * Get array size
     * @param string $index id of the field
     * @return mixed
     */
    protected function getArrSize($index)
    {
        return count($this->values[$index]);
    }

    /**
     * Helper method for send string
     */
    protected function saveString($ch, $string)
    {
        $this->dString .= $string;
        $content_length = strlen($this->dString);
        return strlen($string);
    }

    /**
     * sends the message via post request ['message'] to the url
     * @param string $url the url
     * @param the PBMessage class where the request should be encoded
     *
     * @return String - the return string from the request to the url
     */
    public function send($url, &$class = null)
    {
        $ch = curl_init();
        $this->dString = '';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, array($this, 'saveString'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'message=' . urlencode($this->serializeToString()));
        $result = curl_exec($ch);

        if ($class !== null && method_exists($class, 'parseFromString')) {
            $class->parseFromString($this->dString);
        }
        return $this->dString;
    }

    /**
     * Fix Memory Leaks with Objects in PHP 5
     * http://paul-m-jones.com/?p=262
     *
     * thanks to cheton
     * http://code.google.com/p/pb4php/issues/detail?id=3&can=1
     */
    public function __destruct()
    {
        if (null !== $this->reader) {
            unset($this->reader);
        }
        if (null !== $this->value) {
            unset($this->value);
        }
        // base128
        if (null !== $this->base128) {
            unset($this->base128);
        }
        // fields
        if (null !== $this->fields) {
            foreach ($this->fields as $name => $value) {
                unset($this->$name);
            }
            unset($this->fields);
        }
        // values
        if (null !== $this->values) {
            foreach ($this->values as $name => $value) {
                if (is_array($value)) {
                    foreach ($value as $name2 => $value2) {
                        unset($name2, $value2);
                    }
                } else {
                    unset($value);
                }
                unset($this->values->$name);
            }
            unset($this->values);
        }
    }
}
