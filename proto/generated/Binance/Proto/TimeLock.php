<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dex.proto

namespace Binance\Proto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Binance.Proto.TimeLock</code>
 */
class TimeLock extends \Google\Protobuf\Internal\Message
{
    /**
     * 07921531
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     */
    protected $from = '';
    /**
     * Generated from protobuf field <code>string description = 2;</code>
     */
    protected $description = '';
    /**
     * Generated from protobuf field <code>repeated .Binance.Proto.TimeLock.Token amount = 3;</code>
     */
    private $amount;
    /**
     * Generated from protobuf field <code>int64 lock_time = 4;</code>
     */
    protected $lock_time = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $from
     *           07921531
     *     @type string $description
     *     @type \Binance\Proto\TimeLock\Token[]|\Google\Protobuf\Internal\RepeatedField $amount
     *     @type int|string $lock_time
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     * 07921531
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * 07921531
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
     * Generated from protobuf field <code>string description = 2;</code>
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Generated from protobuf field <code>string description = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->description = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .Binance.Proto.TimeLock.Token amount = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Generated from protobuf field <code>repeated .Binance.Proto.TimeLock.Token amount = 3;</code>
     * @param \Binance\Proto\TimeLock\Token[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAmount($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Binance\Proto\TimeLock\Token::class);
        $this->amount = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 lock_time = 4;</code>
     * @return int|string
     */
    public function getLockTime()
    {
        return $this->lock_time;
    }

    /**
     * Generated from protobuf field <code>int64 lock_time = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setLockTime($var)
    {
        GPBUtil::checkInt64($var);
        $this->lock_time = $var;

        return $this;
    }

}

