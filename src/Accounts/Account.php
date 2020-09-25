<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance\Accounts;

use Binance\Proto\AppAccount;
use Binance\Proto\Send\Token;
use Comely\DataTypes\Buffer\Base16;
use FurqanSiddiqui\Binance\Bech32\Bech32;
use FurqanSiddiqui\Binance\Binance;
use FurqanSiddiqui\Binance\Exceptions\AccountNotExistException;
use FurqanSiddiqui\Binance\Exceptions\AccountsException;
use FurqanSiddiqui\Binance\Exceptions\Bech32Exception;
use FurqanSiddiqui\Binance\Exceptions\RPCException;
use FurqanSiddiqui\Binance\Transactions\AbstractTransaction;
use FurqanSiddiqui\Binance\Transactions\TransferTx;

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
    /** @var Base16 */
    private Base16 $publicKey;
    /** @var string */
    private string $hash160;
    /** @var string */
    private string $address;

    /** @var AppAccount|null */
    private ?AppAccount $_appAccObj = null;

    /**
     * Account constructor.
     * @param Binance $bnb
     * @param Base16|null $privateKey
     * @param Base16|null $publicKey
     * @param AppAccount|null $appAccount
     * @throws AccountsException
     * @throws \FurqanSiddiqui\Binance\Exceptions\Bech32Exception
     */
    public function __construct(Binance $bnb, ?Base16 $privateKey = null, ?Base16 $publicKey = null, ?AppAccount $appAccount = null)
    {
        $this->bnb = $bnb;
        if ($privateKey) {
            if ($privateKey->sizeInBytes !== 64) {
                throw new AccountsException('Private key must be precisely 32 bytes long');
            }

            $this->privateKey = $privateKey->readOnly(true);
            $publicKey = $this->bnb->Secp256k1()->getPublicKey($privateKey)->getCompressed();
        }

        if (!$publicKey && $appAccount) {
            $baseAccount = $appAccount->getBase();
            if ($baseAccount) {
                $publicKey = new Base16(bin2hex(substr($baseAccount->getPublicKey(), -33)));
            }
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

        $this->hash160 = $hash->base16()->hexits(false);
        $this->address = $this->addrFromMD160($this->hash160);
        $this->publicKey = $publicKey->readOnly();

        if (isset($baseAccount)) {
            $this->useAppAccountObject($appAccount);
        }
    }

    /**
     * @param AppAccount $appAccount
     * @throws AccountsException
     * @throws \FurqanSiddiqui\Binance\Exceptions\Bech32Exception
     */
    public function useAppAccountObject(AppAccount $appAccount): void
    {
        $baseAccount = $appAccount->getBase();
        if (!$baseAccount) {
            throw new AccountsException('Could not retrieve baseAccount object from AppAccount');
        }

        $addrHash160 = $baseAccount->getAddress();
        if ($this->addrFromMD160(bin2hex($addrHash160)) !== $this->address) {
            throw new AccountsException('Address does not match with AppAccount object');
        }

        $this->_appAccObj = $appAccount;
    }

    /**
     * @param string $hex
     * @return string
     * @throws \FurqanSiddiqui\Binance\Exceptions\Bech32Exception
     */
    private function addrFromMD160(string $hex): string
    {
        $hashBytes = str_split($hex, 2);
        for ($i = 0; $i < 20; $i++) {
            $hashBytes[$i] = hexdec($hashBytes[$i]);
        }

        return Bech32::encode($this->bnb->accounts()->getPrefix(), Bech32::convertBits($hashBytes, 20, 8, 5));
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

    /**
     * @return string
     */
    public function hash160(): string
    {
        return $this->hash160;
    }

    /**
     * @return Base16
     */
    public function publicKey(): Base16
    {
        return $this->publicKey;
    }

    /**
     * @return bool
     */
    public function isLoaded(): bool
    {
        return isset($this->_appAccObj);
    }

    /**
     * @return $this
     * @throws AccountsException
     * @throws \FurqanSiddiqui\Binance\Exceptions\AccountNotExistException
     * @throws \FurqanSiddiqui\Binance\Exceptions\Bech32Exception
     * @throws \FurqanSiddiqui\Binance\Exceptions\RPCException
     */
    public function fetchLive(): self
    {
        $appAccount = $this->bnb->rpcClient()->getAppAccountObject($this->address);
        $this->useAppAccountObject($appAccount);
        return $this;
    }

    /**
     * @return array
     * @throws AccountsException
     */
    public function getBalances(): array
    {
        $balances = [];
        $coins = $this->getBaseAccountObj()->getCoins();
        /** @var Token $coin */
        foreach ($coins as $coin) {
            $balances[$coin->getDenom()] = $coin->getAmount();
        }

        return $balances;
    }

    /**
     * @return AppAccount\baseAccount
     * @throws AccountsException
     */
    private function getBaseAccountObj(): AppAccount\baseAccount
    {
        if (!$this->_appAccObj) {
            try {
                $this->fetchLive();
            } catch (AccountNotExistException|RPCException|Bech32Exception $e) {
                trigger_error(sprintf('[%s][%s] %s', get_class($e), $e->getCode(), $e->getMessage()), E_USER_WARNING);
            }

            return $this->getBaseAccountObj();
        }

        $baseAcc = $this->_appAccObj->getBase();
        if (!$baseAcc) {
            unset($this->_appAccObj);
            throw new AccountsException('Could not retrieve baseAccount object');
        }

        return $baseAcc;
    }

    /**
     * @return string
     * @throws AccountsException
     */
    public function getSequence(): string
    {
        return (string)$this->getBaseAccountObj()->getSequence();
    }

    /**
     * @return string
     * @throws AccountsException
     */
    public function getAccountNumber(): string
    {
        return (string)$this->getBaseAccountObj()->getAccountNumber();
    }

    /**
     * @param string $to
     * @param string $amount
     * @param string $denom
     * @param bool $resetSeq
     * @return TransferTx
     * @throws AccountNotExistException
     * @throws AccountsException
     * @throws Bech32Exception
     * @throws RPCException
     * @throws \FurqanSiddiqui\Binance\Exceptions\TransactionException
     */
    public function transfer(string $to, string $amount, string $denom, bool $resetSeq = true): TransferTx
    {
        return new TransferTx($this->bnb, $this, $to, $amount, $denom, $resetSeq);
    }

    /**
     * @param AbstractTransaction $transaction
     * @return AbstractTransaction
     * @throws AccountsException
     */
    public function sign(AbstractTransaction $transaction): AbstractTransaction
    {
        if (!$this->privateKey) {
            throw new AccountsException('Private key not set for account; Cannot sign');
        }

        $serialized = $transaction->serializeRaw();
        $signature = $this->bnb->Secp256k1()->sign($this->privateKey, $serialized->base16());
        return $transaction->appendSignature($this, $signature);
    }
}
