<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dex.proto

namespace Binance\Proto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * please note the field name is the JSON name.
 * msg
 *
 * Generated from protobuf message <code>Binance.Proto.TokenUnfreeze</code>
 */
class TokenUnfreeze extends \Google\Protobuf\Internal\Message
{
    /**
     *    0x6515FF0D   // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     */
    protected $from = '';
    /**
     * token symbol, in full name with "-" suffix
     *
     * Generated from protobuf field <code>string symbol = 2;</code>
     */
    protected $symbol = '';
    /**
     * amount of token to freeze
     *
     * Generated from protobuf field <code>int64 amount = 3;</code>
     */
    protected $amount = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $from
     *              0x6515FF0D   // hardcoded, object type prefix in 4 bytes
     *     @type string $symbol
     *           token symbol, in full name with "-" suffix
     *     @type int|string $amount
     *           amount of token to freeze
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     *    0x6515FF0D   // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     *    0x6515FF0D   // hardcoded, object type prefix in 4 bytes
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
     * token symbol, in full name with "-" suffix
     *
     * Generated from protobuf field <code>string symbol = 2;</code>
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * token symbol, in full name with "-" suffix
     *
     * Generated from protobuf field <code>string symbol = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setSymbol($var)
    {
        GPBUtil::checkString($var, True);
        $this->symbol = $var;

        return $this;
    }

    /**
     * amount of token to freeze
     *
     * Generated from protobuf field <code>int64 amount = 3;</code>
     * @return int|string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * amount of token to freeze
     *
     * Generated from protobuf field <code>int64 amount = 3;</code>
     * @param int|string $var
     * @return $this
     */
    public function setAmount($var)
    {
        GPBUtil::checkInt64($var);
        $this->amount = $var;

        return $this;
    }

}
