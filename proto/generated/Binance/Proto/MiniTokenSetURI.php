<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dex.proto

namespace Binance\Proto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Binance.Proto.MiniTokenSetURI</code>
 */
class MiniTokenSetURI extends \Google\Protobuf\Internal\Message
{
    /**
     *    7B1D34E7 // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     */
    protected $from = '';
    /**
     * Generated from protobuf field <code>string symbol = 2;</code>
     */
    protected $symbol = '';
    /**
     * Generated from protobuf field <code>string token_uri = 3;</code>
     */
    protected $token_uri = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $from
     *              7B1D34E7 // hardcoded, object type prefix in 4 bytes
     *     @type string $symbol
     *     @type string $token_uri
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     *    7B1D34E7 // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes from = 1;</code>
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     *    7B1D34E7 // hardcoded, object type prefix in 4 bytes
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
     * Generated from protobuf field <code>string token_uri = 3;</code>
     * @return string
     */
    public function getTokenUri()
    {
        return $this->token_uri;
    }

    /**
     * Generated from protobuf field <code>string token_uri = 3;</code>
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

