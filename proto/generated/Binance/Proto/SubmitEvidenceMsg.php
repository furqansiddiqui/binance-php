<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: dex.proto

namespace Binance\Proto;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Binance.Proto.SubmitEvidenceMsg</code>
 */
class SubmitEvidenceMsg extends \Google\Protobuf\Internal\Message
{
    /**
     * A38F1399
     *
     * Generated from protobuf field <code>bytes submitter = 1;</code>
     */
    protected $submitter = '';
    /**
     * Generated from protobuf field <code>repeated .Binance.Proto.BscHeader headers = 2;</code>
     */
    private $headers;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $submitter
     *           A38F1399
     *     @type \Binance\Proto\BscHeader[]|\Google\Protobuf\Internal\RepeatedField $headers
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     * A38F1399
     *
     * Generated from protobuf field <code>bytes submitter = 1;</code>
     * @return string
     */
    public function getSubmitter()
    {
        return $this->submitter;
    }

    /**
     * A38F1399
     *
     * Generated from protobuf field <code>bytes submitter = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSubmitter($var)
    {
        GPBUtil::checkString($var, False);
        $this->submitter = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .Binance.Proto.BscHeader headers = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Generated from protobuf field <code>repeated .Binance.Proto.BscHeader headers = 2;</code>
     * @param \Binance\Proto\BscHeader[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setHeaders($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Binance\Proto\BscHeader::class);
        $this->headers = $arr;

        return $this;
    }

}

