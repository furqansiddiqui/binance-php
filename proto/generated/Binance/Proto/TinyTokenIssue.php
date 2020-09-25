<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dex.proto

namespace Binance\Proto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *mini token issue
 *
 * Generated from protobuf message <code>Binance.Proto.TinyTokenIssue</code>
 */
class TinyTokenIssue extends \Google\Protobuf\Internal\Message
{
    /**
     *    ED2832D4 // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     */
    protected $from = '';
    /**
     * Generated from protobuf field <code>string name = 2;</code>
     */
    protected $name = '';
    /**
     * Generated from protobuf field <code>string symbol = 3;</code>
     */
    protected $symbol = '';
    /**
     * Generated from protobuf field <code>int64 total_supply = 4;</code>
     */
    protected $total_supply = 0;
    /**
     * Generated from protobuf field <code>bool mintable = 5;</code>
     */
    protected $mintable = false;
    /**
     * Generated from protobuf field <code>string token_uri = 6;</code>
     */
    protected $token_uri = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $from
     *              ED2832D4 // hardcoded, object type prefix in 4 bytes
     *     @type string $name
     *     @type string $symbol
     *     @type int|string $total_supply
     *     @type bool $mintable
     *     @type string $token_uri
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     *    ED2832D4 // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     *    ED2832D4 // hardcoded, object type prefix in 4 bytes
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
     * Generated from protobuf field <code>string name = 2;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string symbol = 3;</code>
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Generated from protobuf field <code>string symbol = 3;</code>
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
     * Generated from protobuf field <code>int64 total_supply = 4;</code>
     * @return int|string
     */
    public function getTotalSupply()
    {
        return $this->total_supply;
    }

    /**
     * Generated from protobuf field <code>int64 total_supply = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setTotalSupply($var)
    {
        GPBUtil::checkInt64($var);
        $this->total_supply = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool mintable = 5;</code>
     * @return bool
     */
    public function getMintable()
    {
        return $this->mintable;
    }

    /**
     * Generated from protobuf field <code>bool mintable = 5;</code>
     * @param bool $var
     * @return $this
     */
    public function setMintable($var)
    {
        GPBUtil::checkBool($var);
        $this->mintable = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string token_uri = 6;</code>
     * @return string
     */
    public function getTokenUri()
    {
        return $this->token_uri;
    }

    /**
     * Generated from protobuf field <code>string token_uri = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setTokenUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->token_uri = $var;

        return $this;
    }

}

