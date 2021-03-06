<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dex.proto

namespace Binance\Proto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Binance.Proto.TimeUnlock</code>
 */
class TimeUnlock extends \Google\Protobuf\Internal\Message
{
    /**
     * C4050C6C
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     */
    protected $from = '';
    /**
     * Generated from protobuf field <code>int64 time_lock_id = 2;</code>
     */
    protected $time_lock_id = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $from
     *           C4050C6C
     *     @type int|string $time_lock_id
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     * C4050C6C
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * C4050C6C
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFrom($var)
    {
        GPBUtil::checkString($var, False);
        $this->from = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 time_lock_id = 2;</code>
     * @return int|string
     */
    public function getTimeLockId()
    {
        return $this->time_lock_id;
    }

    /**
     * Generated from protobuf field <code>int64 time_lock_id = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setTimeLockId($var)
    {
        GPBUtil::checkInt64($var);
        $this->time_lock_id = $var;

        return $this;
    }

}

