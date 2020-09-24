<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance\Accounts;

use Comely\DataTypes\Buffer\Base16;
use FurqanSiddiqui\Binance\Bech32\Bech32;
use FurqanSiddiqui\Binance\Binance;
use FurqanSiddiqui\Binance\Exceptions\AccountsException;

/**
 * Class Account
 * @package FurqanSiddiqui\Binance\Accounts
 */
class Account
{
    /** @var Binance */
    private Binance $bnb;
    /** @var Base16|null */
    private ?Base16 $privateKey = null;
    /** @var string */
    private string $address;

    /**
     * Account constructor.
     * @param Binance $bnb
     * @param Base16|null $privateKey
     * @param Base16|null $publicKey
     * @throws AccountsException
     */
    public function __construct(Binance $bnb, ?Base16 $privateKey = null, ?Base16 $publicKey = null)
    {
        $this->bnb = $bnb;
        if ($privateKey) {
            if ($privateKey->sizeInBytes !== 64) {
                throw new AccountsException('Private key must be precisely 32 bytes long');
            }

            $this->privateKey = $privateKey;
            $publicKey = $this->bnb->Secp256k1()->getPublicKey($privateKey)->getCompressed();
        }

        if (!$publicKey || $publicKey->sizeInBytes !== 66) {
            throw new AccountsException('Public key must be (compressed) precisely 33 bytes long');
        }

        $prefix = $publicKey->value(0, 2);
        if (!in_array($prefix, ["02", "03"])) {
            throw new AccountsException('Public key is invalid');
        }

        $hash = $publicKey->binary()->hash()->sha256()
            ->hash()->ripeMd160();

        $hashBytes = str_split($hash->base16()->hexits(false), 2);
        for ($i = 0; $i < 20; $i++) {
            $hashBytes[$i] = hexdec($hashBytes[$i]);
        }

        $this->address = Bech32::encode($this->bnb->accounts()->getPrefix(), Bech32::convertBits($hashBytes, 20, 8, 5));
    }

    /**
     * @return bool
     */
    public function hasPrivateKey(): bool
    {
        return isset($this->privateKey);
    }

    /**
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }
}
