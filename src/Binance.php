<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance;

use FurqanSiddiqui\Binance\Accounts\AccountsFactory;
use FurqanSiddiqui\Binance\RPC\RPCClient;
use FurqanSiddiqui\ECDSA\Curves\Secp256k1;

/**
 * Class Binance
 * @package FurqanSiddiqui\Binance
 */
class Binance
{
    /** @var int */
    public const PRECISION = 8;

    /** @var string */
    private string $network;
    /** @var AccountsFactory */
    private AccountsFactory $accounts;
    /** @var RPCClient */
    private RPCClient $rpcClient;

    /**
     * Binance constructor.
     * @param string $network
     */
    public function __construct(string $network = "mainnet")
    {
        if (!in_array($network, ["mainnet", "testnet"])) {
            throw new \InvalidArgumentException('Invalid value for binance network argument');
        }

        $this->network = $network;
        $this->accounts = new AccountsFactory($this);
        $this->rpcClient = new RPCClient($this);
    }

    /**
     * @return string
     */
    public function network(): string
    {
        return $this->network;
    }

    /**
     * @return string
     */
    public function chainId(): string
    {
        switch ($this->network) {
            case "mainnet":
                return "Binance-Chain-Tigris";
            case "testnet":
                return "Binance-Chain-Ganges";
            default:
                throw new \OutOfBoundsException('Binance network arg not properly configured');
        }
    }

    /**
     * @return AccountsFactory
     */
    public function accounts(): AccountsFactory
    {
        return $this->accounts;
    }

    /**
     * @return RPCClient
     */
    public function rpcClient(): RPCClient
    {
        return $this->rpcClient;
    }

    /**
     * @return Secp256k1
     */
    public function Secp256k1(): Secp256k1
    {
        return Secp256k1::getInstance();
    }
}
