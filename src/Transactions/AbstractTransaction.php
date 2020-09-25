<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance\Transactions;

use Binance\Proto\StdSignature;
use Binance\Proto\StdTx;
use Comely\DataTypes\Buffer\Base16;
use Comely\DataTypes\Buffer\Binary;
use FurqanSiddiqui\Binance\Accounts\Account;
use FurqanSiddiqui\Binance\Binance;
use FurqanSiddiqui\Binance\Exceptions\TransactionException;
use FurqanSiddiqui\ECDSA\Signature\Signature;
use Google\Protobuf\Internal\CodedOutputStream;

/**
 * Class AbstractTransaction
 * @package FurqanSiddiqui\Binance\Transactions
 */
abstract class AbstractTransaction
{
    public const STD_TX_PREFIX = "F0625DEE";

    /** @var Binance */
    protected Binance $bnb;
    /** @var Account */
    protected Account $from;
    /** @var string|null */
    protected ?string $memo = null;
    /** @var array */
    protected array $signatures;
    /** @var int */
    protected int $source;

    /**
     * AbstractTransaction constructor.
     * @param Binance $bnb
     * @param Account $from
     * @param bool $resetFromAccObj
     * @throws \FurqanSiddiqui\Binance\Exceptions\AccountNotExistException
     * @throws \FurqanSiddiqui\Binance\Exceptions\AccountsException
     * @throws \FurqanSiddiqui\Binance\Exceptions\Bech32Exception
     * @throws \FurqanSiddiqui\Binance\Exceptions\RPCException
     */
    public function __construct(Binance $bnb, Account $from, bool $resetFromAccObj = true)
    {
        $this->bnb = $bnb;
        $this->from = $from;
        $this->source = 0;
        $this->signatures = [];

        if ($resetFromAccObj) {
            $from->fetchLive();
        }
    }

    /**
     * @param string $memo
     * @return $this
     */
    public function setMemo(string $memo): self
    {
        $this->memo = $memo;
        return $this;
    }

    /**
     * @return array
     */
    abstract protected function getMsgs(): array;

    /**
     * @return Base16
     */
    abstract public function serialize(): Base16;

    /**
     * @param array $obj
     * @return array
     */
    private function sortSignMsgObj(array &$obj): array
    {
        ksort($obj);
        foreach ($obj as $key => $value) {
            if (is_array($value)) {
                $obj[$key] = $this->sortSignMsgObj($value);
            }
        }

        return $obj;
    }

    /**
     * @param Account $account
     * @param Signature $signed
     * @return $this
     * @throws \FurqanSiddiqui\Binance\Exceptions\AccountsException
     */
    public function appendSignature(Account $account, Signature $signed): self
    {
        $pubKey = $account->publicKey()->hexits(false);
        $pubKey = "eb5ae987" . dechex(strlen(hex2bin($pubKey))) . $pubKey;

        $stdSignature = new StdSignature();
        $stdSignature->setPubKey(hex2bin($pubKey));
        $stdSignature->setSignature(hex2bin($signed->r()->value() . $signed->s()->value()));
        $stdSignature->setAccountNumber($account->getAccountNumber());
        $stdSignature->setSequence($account->getSequence());

        $this->signatures[] = $stdSignature->serializeToString();
        return $this;
    }

    /**
     * @return Binary
     * @throws \FurqanSiddiqui\Binance\Exceptions\AccountsException
     */
    public function serializeRaw(): Binary
    {
        $signMsg = [
            "account_number" => $this->from->getAccountNumber(),
            "chain_id" => $this->bnb->chainId(),
            "data" => null,
            "memo" => $this->memo,
            "msgs" => $this->getMsgs(),
            "sequence" => $this->from->getSequence(),
            "source" => (string)$this->source,
        ];

        $jsonFilter = json_decode(json_encode($signMsg), true);
        $signMsg = $this->sortSignMsgObj($jsonFilter);
        return (new Binary(json_encode($signMsg)))->hash()->sha256();
    }

    /**
     * @param string $msgPrefixed
     * @return Base16
     * @throws TransactionException
     */
    protected function serializeStdTx(string $msgPrefixed): Base16
    {
        if (!$this->signatures) {
            throw new TransactionException('Transaction has no signatures');
        }

        $stdTx = new StdTx();
        $stdTx->setMsgs([$msgPrefixed]);
        $stdTx->setSignatures($this->signatures);
        $stdTx->setSource($this->source);
        $stdTx->setMemo($this->memo);
        $stdTx->setData("");

        $stdTxBytes = new Binary(hex2bin(self::STD_TX_PREFIX) . $stdTx->serializeToString());
        $codedStream = new CodedOutputStream(2);
        $codedStream->writeVarint64($stdTxBytes->sizeInBytes);
        return (new Base16(bin2hex($codedStream->getData()) . $stdTxBytes->base16()->hexits()))->readOnly(true);
    }
}
