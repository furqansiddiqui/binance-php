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
 * Generated from protobuf message <code>Binance.Proto.NewOrder</code>
 */
class NewOrder extends \Google\Protobuf\Internal\Message
{
    /**
     *    0xCE6DC043 // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes sender = 1;</code>
     */
    protected $sender = '';
    /**
     * order id, optional
     *
     * Generated from protobuf field <code>string id = 2;</code>
     */
    protected $id = '';
    /**
     * symbol for trading pair in full name of the tokens
     *
     * Generated from protobuf field <code>string symbol = 3;</code>
     */
    protected $symbol = '';
    /**
     * only accept 2 for now, meaning limit order
     *
     * Generated from protobuf field <code>int64 ordertype = 4;</code>
     */
    protected $ordertype = 0;
    /**
     * 1 for buy and 2 fory sell
     *
     * Generated from protobuf field <code>int64 side = 5;</code>
     */
    protected $side = 0;
    /**
     * price of the order, which is the real price multiplied by 1e8 (10^8) and rounded to integer
     *
     * Generated from protobuf field <code>int64 price = 6;</code>
     */
    protected $price = 0;
    /**
     * quantity of the order, which is the real price multiplied by 1e8 (10^8) and rounded to integer
     *
     * Generated from protobuf field <code>int64 quantity = 7;</code>
     */
    protected $quantity = 0;
    /**
     * 1 for Good Till Expire(GTE) order and 3 for Immediate Or Cancel (IOC)
     *
     * Generated from protobuf field <code>int64 timeinforce = 8;</code>
     */
    protected $timeinforce = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sender
     *              0xCE6DC043 // hardcoded, object type prefix in 4 bytes
     *     @type string $id
     *           order id, optional
     *     @type string $symbol
     *           symbol for trading pair in full name of the tokens
     *     @type int|string $ordertype
     *           only accept 2 for now, meaning limit order
     *     @type int|string $side
     *           1 for buy and 2 fory sell
     *     @type int|string $price
     *           price of the order, which is the real price multiplied by 1e8 (10^8) and rounded to integer
     *     @type int|string $quantity
     *           quantity of the order, which is the real price multiplied by 1e8 (10^8) and rounded to integer
     *     @type int|string $timeinforce
     *           1 for Good Till Expire(GTE) order and 3 for Immediate Or Cancel (IOC)
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Dex::initOnce();
        parent::__construct($data);
    }

    /**
     *    0xCE6DC043 // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes sender = 1;</code>
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     *    0xCE6DC043 // hardcoded, object type prefix in 4 bytes
     *
     * Generated from protobuf field <code>bytes sender = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSender($var)
    {
        GPBUtil::checkString($var, False);
        $this->sender = $var;

        return $this;
    }

    /**
     * order id, optional
     *
     * Generated from protobuf field <code>string id = 2;</code>
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * order id, optional
     *
     * Generated from protobuf field <code>string id = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->id = $var;

        return $this;
    }

    /**
     * symbol for trading pair in full name of the tokens
     *
     * Generated from protobuf field <code>string symbol = 3;</code>
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * symbol for trading pair in full name of the tokens
     *
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
     * only accept 2 for now, meaning limit order
     *
     * Generated from protobuf field <code>int64 ordertype = 4;</code>
     * @return int|string
     */
    public function getOrdertype()
    {
        return $this->ordertype;
    }

    /**
     * only accept 2 for now, meaning limit order
     *
     * Generated from protobuf field <code>int64 ordertype = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setOrdertype($var)
    {
        GPBUtil::checkInt64($var);
        $this->ordertype = $var;

        return $this;
    }

    /**
     * 1 for buy and 2 fory sell
     *
     * Generated from protobuf field <code>int64 side = 5;</code>
     * @return int|string
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * 1 for buy and 2 fory sell
     *
     * Generated from protobuf field <code>int64 side = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setSide($var)
    {
        GPBUtil::checkInt64($var);
        $this->side = $var;

        return $this;
    }

    /**
     * price of the order, which is the real price multiplied by 1e8 (10^8) and rounded to integer
     *
     * Generated from protobuf field <code>int64 price = 6;</code>
     * @return int|string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * price of the order, which is the real price multiplied by 1e8 (10^8) and rounded to integer
     *
     * Generated from protobuf field <code>int64 price = 6;</code>
     * @param int|string $var
     * @return $this
     */
    public function setPrice($var)
    {
        GPBUtil::checkInt64($var);
        $this->price = $var;

        return $this;
    }

    /**
     * quantity of the order, which is the real price multiplied by 1e8 (10^8) and rounded to integer
     *
     * Generated from protobuf field <code>int64 quantity = 7;</code>
     * @return int|string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * quantity of the order, which is the real price multiplied by 1e8 (10^8) and rounded to integer
     *
     * Generated from protobuf field <code>int64 quantity = 7;</code>
     * @param int|string $var
     * @return $this
     */
    public function setQuantity($var)
    {
        GPBUtil::checkInt64($var);
        $this->quantity = $var;

        return $this;
    }

    /**
     * 1 for Good Till Expire(GTE) order and 3 for Immediate Or Cancel (IOC)
     *
     * Generated from protobuf field <code>int64 timeinforce = 8;</code>
     * @return int|string
     */
    public function getTimeinforce()
    {
        return $this->timeinforce;
    }

    /**
     * 1 for Good Till Expire(GTE) order and 3 for Immediate Or Cancel (IOC)
     *
     * Generated from protobuf field <code>int64 timeinforce = 8;</code>
     * @param int|string $var
     * @return $this
     */
    public function setTimeinforce($var)
    {
        GPBUtil::checkInt64($var);
        $this->timeinforce = $var;

        return $this;
    }

}
