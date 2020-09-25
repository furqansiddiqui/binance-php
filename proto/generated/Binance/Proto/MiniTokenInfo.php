<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dex.proto

namespace Binance\Proto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Binance.Proto.MiniTokenInfo</code>
 */
class MiniTokenInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string name = 1;</code>
     */
    protected $name = '';
    /**
     * Generated from protobuf field <code>string symbol = 2;</code>
     */
    protected $symbol = '';
    /**
     * Generated from protobuf field <code>string original_symbol = 3;</code>
     */
    protected $original_symbol = '';
    /**
     * Generated from protobuf field <code>int64 total_supply = 4;</code>
     */
    protected $total_supply = 0;
    /**
     * Generated from protobuf field <code>bytes owner = 5;</code>
     */
    protected $owner = '';
    /**
     * Generated from protobuf field <code>bool mintable = 6;</code>
     */
    protected $mintable = false;
    /**
     * Generated from protobuf field <code>int32 token_type = 7;</code>
     */
    protected $token_type = 0;
    /**
     * Generated from protobuf field <code>string token_uri = 8;</code>
     */
    protected $token_uri = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *     @type string $symbol
     *     @type string $original_symbol
     *     @type int|string $total_supply
     *     @type string $owner
     *     @type bool $mintable
     *     @type int $token_type
     *     @type string $token_uri
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 1;</code>
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
     * Generated from protobuf field <code>string symbol = 2;</code>
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
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
     * Generated from protobuf field <code>string original_symbol = 3;</code>
     * @return string
     */
    public function getOriginalSymbol()
    {
        return $this->original_symbol;
    }

    /**
     * Generated from protobuf field <code>string original_symbol = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setOriginalSymbol($var)
    {
        GPBUtil::checkString($var, True);
        $this->original_symbol = $var;

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
     * Generated from protobuf field <code>bytes owner = 5;</code>
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Generated from protobuf field <code>bytes owner = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setOwner($var)
    {
        GPBUtil::checkString($var, False);
        $this->owner = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool mintable = 6;</code>
     * @return bool
     */
    public function getMintable()
    {
        return $this->mintable;
    }

    /**
     * Generated from protobuf field <code>bool mintable = 6;</code>
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
     * Generated from protobuf field <code>int32 token_type = 7;</code>
     * @return int
     */
    public function getTokenType()
    {
        return $this->token_type;
    }

    /**
     * Generated from protobuf field <code>int32 token_type = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setTokenType($var)
    {
        GPBUtil::checkInt32($var);
        $this->token_type = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string token_uri = 8;</code>
     * @return string
     */
    public function getTokenUri()
    {
        return $this->token_uri;
    }

    /**
     * Generated from protobuf field <code>string token_uri = 8;</code>
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

