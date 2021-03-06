<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dex.proto

namespace Binance\Proto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Binance.Proto.DepositHashTimerLockMsg</code>
 */
class DepositHashTimerLockMsg extends \Google\Protobuf\Internal\Message
{
    /**
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     */
    protected $from = '';
    /**
     * Generated from protobuf field <code>repeated .Binance.Proto.Token amount = 2;</code>
     */
    private $amount;
    /**
     * Generated from protobuf field <code>bytes swap_id = 3;</code>
     */
    protected $swap_id = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $from
     *     @type \Binance\Proto\Token[]|\Google\Protobuf\Internal\RepeatedField $amount
     *     @type string $swap_id
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
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
     * Generated from protobuf field <code>repeated .Binance.Proto.Token amount = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Generated from protobuf field <code>repeated .Binance.Proto.Token amount = 2;</code>
     * @param \Binance\Proto\Token[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAmount($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Binance\Proto\Token::class);
        $this->amount = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes swap_id = 3;</code>
     * @return string
     */
    public function getSwapId()
    {
        return $this->swap_id;
    }

    /**
     * Generated from protobuf field <code>bytes swap_id = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setSwapId($var)
    {
        GPBUtil::checkString($var, False);
        $this->swap_id = $var;

        return $this;
    }

}

