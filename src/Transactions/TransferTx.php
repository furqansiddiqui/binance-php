<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance\Transactions;

use Binance\Proto\Send;
use Binance\Proto\Send\Input;
use Binance\Proto\Send\Output;
use Binance\Proto\Send\Token;
use Comely\DataTypes\BcMath\BcMath;
use Comely\DataTypes\Buffer\Base16;
use FurqanSiddiqui\Binance\Accounts\Account;
use FurqanSiddiqui\Binance\Bech32\Bech32;
use FurqanSiddiqui\Binance\Binance;
use FurqanSiddiqui\Binance\Exceptions\TransactionException;
use FurqanSiddiqui\Binance\Validator;

/**
 * Class TransferTx
 * @package FurqanSiddiqui\Binance\Transactions
 */
class TransferTx extends AbstractTransaction
{
    /** @var string */
    public const PREFIX = "2A2C87FA";

    /** @var string */
    private string $to;
    /** @var string */
    private string $amount;
    /** @var string */
    private string $denom;

    /**
     * TransferTx constructor.
     * @param Binance $bnb
     * @param Account $from
     * @param string $to
     * @param string $amount
     * @param string $denom
     * @param bool $resetSeq
     * @throws TransactionException
     * @throws \FurqanSiddiqui\Binance\Exceptions\AccountNotExistException
     * @throws \FurqanSiddiqui\Binance\Exceptions\AccountsException
     * @throws \FurqanSiddiqui\Binance\Exceptions\Bech32Exception
     * @throws \FurqanSiddiqui\Binance\Exceptions\RPCException
     */
    public function __construct(Binance $bnb, Account $from, string $to, string $amount, string $denom = "BNB", bool $resetSeq = true)
    {
        parent::__construct($bnb, $from, $resetSeq);

        // Address
        if (!Validator::isValidAddress($to)) {
            throw new TransactionException('Invalid payee address');
        }

        $this->to = $to;

        // Amount
        $amount = BcMath::isNumeric($amount);
        if (!$amount) {
            throw new TransactionException('Invalid amount');
        }

        $amount->scale(Binance::PRECISION)->mul(1);
        if ($amount->isNegative()) {
            throw new TransactionException('Amount must be a positive value');
        }

        $this->amount = $amount->value();

        // Denom
        $this->denom = $denom;
    }

    /**
     * @return \array[][][]
     */
    protected function getMsgs(): array
    {
        return [
            [
                "inputs" => [
                    [
                        "address" => $this->from->address(),
                        "coins" => [
                            [
                                "amount" => (int)bcmul($this->amount, (string)pow(10, 8), 0),
                                "denom" => $this->denom,
                            ]
                        ]
                    ]
                ],
                "outputs" => [
                    [
                        "address" => $this->to,
                        "coins" => [
                            [
                                "amount" => (int)bcmul($this->amount, (string)pow(10, 8), 0),
                                "denom" => $this->denom
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @return Base16
     * @throws TransactionException
     * @throws \FurqanSiddiqui\Binance\Exceptions\Bech32Exception
     */
    public function serialize(): Base16
    {
        if (!$this->signatures) {
            throw new TransactionException('Transaction has no signatures');
        }

        $spent = new Token();
        $spent->setDenom($this->denom);
        $spent->setAmount(bcmul($this->amount, (string)pow(10, 8), 0));

        $input = new Input();
        $input->setAddress(hex2bin($this->from->hash160()));
        $input->setCoins([$spent]);

        $output = new Output();
        $output->setAddress(Bech32::AddressDecode($this->to)->value());
        $output->setCoins([$spent]);

        $send = new Send();
        $send->setInputs([$input]);
        $send->setOutputs([$output]);

        return $this->serializeStdTx(hex2bin(self::PREFIX) . $send->serializeToString());
    }
}
