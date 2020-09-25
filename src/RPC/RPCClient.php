<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance\RPC;

use Binance\Proto\AppAccount;
use Comely\Http\Exception\HttpException;
use Comely\Http\Request;
use FurqanSiddiqui\Binance\Accounts\Account;
use FurqanSiddiqui\Binance\Binance;
use FurqanSiddiqui\Binance\Exceptions\AccountNotExistException;
use FurqanSiddiqui\Binance\Exceptions\AccountsException;
use FurqanSiddiqui\Binance\Exceptions\RPCException;
use FurqanSiddiqui\Binance\Validator;

/**
 * Class RPCClient
 * @package FurqanSiddiqui\Binance\RPC
 */
class RPCClient
{
    /** @var Binance */
    private Binance $bnb;
    /** @var string|null */
    private ?string $host = null;
    /** @var int|null */
    private ?int $port = null;
    /** @var bool */
    private bool $ignoreSSL = false;
    /** @var bool */
    private bool $debug = false;

    /**
     * RPCClient constructor.
     * @param Binance $bnb
     */
    public function __construct(Binance $bnb)
    {
        $this->bnb = $bnb;
    }

    /**
     * @param string $host
     * @param int|null $port
     * @return $this
     */
    public function setHost(string $host, ?int $port = null): self
    {
        $this->host = $host;
        $this->port = $port && $port > 0x4f && $port < 0xffff ? $port : null;
        return $this;
    }

    /**
     * @return $this
     */
    public function ignoreSSL(): self
    {
        $this->ignoreSSL = true;
        return $this;
    }

    /**
     * @return void
     */
    public function debug(): void
    {
        $this->debug = true;
    }

    /**
     * @param string $addr
     * @return Account
     * @throws AccountNotExistException
     * @throws AccountsException
     * @throws RPCException
     * @throws \FurqanSiddiqui\Binance\Exceptions\Bech32Exception
     */
    public function getAccount(string $addr): Account
    {
        return new Account($this->bnb, null, null, $this->getAppAccountObject($addr));
    }

    /**
     * @param string $addr
     * @return AppAccount
     * @throws AccountNotExistException
     * @throws AccountsException
     * @throws RPCException
     */
    public function getAppAccountObject(string $addr): AppAccount
    {
        if (!Validator::isValidAddress($addr)) {
            throw new AccountsException('Invalid Binance account address');
        }

        $abciQuery = $this->call('/abci_query?path="/account/' . $addr . '"', null, "GET");
        $b64Encoded = $abciQuery["result"]["response"]["value"] ?? null;
        if (is_string($b64Encoded) && $b64Encoded === "") {
            throw new AccountNotExistException(sprintf('Account "%s" is inactive', $addr));
        }

        if (!$b64Encoded) {
            throw new AccountsException('Could not retrieve account');
        }

        $appAccount = new AppAccount();
        $appAccount->mergeFromString(substr(base64_decode($b64Encoded), 4));
        return $appAccount;
    }

    /**
     * @return array|null
     * @throws RPCException
     */
    public function nodeStatus(): array
    {
        $nodeStatus = $this->call("/status", null, "GET");
        $result = $nodeStatus["result"];
        if (!is_array($result) || !$result) {
            throw new RPCException('Could not retrieve node status; Bad response');
        }

        return $result;
    }

    /**
     * @param string $endpoint
     * @param array|null $payload
     * @param string $httpMethod
     * @return array
     * @throws RPCException
     */
    public function call(string $endpoint, array $payload = null, string $httpMethod = "POST"): array
    {
        if (!$this->host) {
            throw new RPCException('RPC host is not configured');
        }

        try {
            $url = strpos($this->host, "://") ? $this->host : "http://" . $this->host;
            if ($this->port) {
                $url .= ":" . $this->port;
            }

            $url = $url . "/" . ltrim($endpoint, "/");
            $req = new Request($httpMethod, $url);
            if ($payload) {
                $req->payload()->use($payload);
            }

            $curl = $req->curl();
            if ($this->ignoreSSL) {
                $curl->ssl()->verify(false);
            }

            $curl->expectJSON(true);
            $curl->contentTypeJSON();
            $res = $curl->send();
            return $res->payload()->array();
        } catch (HttpException $e) {
            if ($this->debug) {
                trigger_error(sprintf('[%s][%s] %s', get_class($e), $e->getCode(), $e->getMessage()), E_USER_WARNING);
            }

            throw new RPCException('RPC request to server failed');
        }
    }
}
