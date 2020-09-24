<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance\Accounts;

use Comely\DataTypes\Buffer\Base16;
use Comely\DataTypes\DataTypes;
use FurqanSiddiqui\Binance\Binance;
use FurqanSiddiqui\Binance\Exceptions\AccountsException;

/**
 * Class AccountsFactory
 * @package FurqanSiddiqui\Binance\Accounts
 */
class AccountsFactory
{
    /** @var Binance */
    private Binance $bnb;

    /**
     * AccountsFactory constructor.
     * @param Binance $bnb
     */
    public function __construct(Binance $bnb)
    {
        $this->bnb = $bnb;
    }

    /**
     * @param $entropy
     * @return Account
     * @throws AccountsException
     */
    public function fromEntropy($entropy): Account
    {
        if (!$entropy instanceof Base16) {
            if (!DataTypes::isBase16($entropy)) {
                throw new AccountsException(sprintf('Entropy arg must be Base16 or String, %s given', gettype($entropy)));
            }

            $entropy = new Base16($entropy);
        }

        return new Account($this->bnb, $entropy);
    }

    /**
     * @param $publicKey
     * @return Account
     * @throws AccountsException
     */
    public function fromCompressedPublicKey($publicKey): Account
    {
        if (!$publicKey instanceof Base16) {
            if (!DataTypes::isBase16($publicKey)) {
                throw new AccountsException(sprintf('Public key arg must be Base16 or String, %s given', gettype($publicKey)));
            }

            $publicKey = new Base16($publicKey);
        }

        return new Account($this->bnb, null, $publicKey);
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        switch ($this->bnb->network()) {
            case "mainnet":
                return "bnb";
            case "testnet":
                return "tbnb";
            default:
                throw new \OutOfBoundsException('Cannot determine accounts prefix');
        }
    }
}
