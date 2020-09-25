<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance\DEX;

use Comely\DataTypes\Buffer\Base16;
use Comely\DataTypes\DataTypes;
use Comely\Http\Exception\HttpException;
use Comely\Http\Request;
use FurqanSiddiqui\Binance\Exceptions\DEXException;

/**
 * Class DEX_BNB
 * @package FurqanSiddiqui\Binance\DEX
 */
class DEX_BNB
{
    /** @var string */
    public const HOSTNAME = "https://dex.binance.org";

    /**
     * @param Base16 $signedTx
     * @return string
     * @throws DEXException
     */
    public static function Broadcast(Base16 $signedTx): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::HOSTNAME . "/api/v1/broadcast");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $signedTx->hexits(false));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-type: text/plain"
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $body = curl_exec($ch);
        if ($body === false) {
            throw new DEXException(sprintf('cURL error [%d]: %s', curl_error($ch), curl_error($ch)));
        }

        try {
            $body = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            trigger_error(sprintf('[%s][%s] %s', get_class($e), $e->getCode(), $e->getMessage()));
            throw new DEXException('Failed to JSON decode body response');
        }

        $isOK = $body[0]["ok"] ?? null;
        $txHash = $body[0]["hash"] ?? null;
        if (is_bool($isOK) && $isOK && DataTypes::isBase16($txHash)) {
            return $txHash;
        }

        throw new DEXException($body["message"] ?? 'Broadcast failed, No error message received');
    }

    /**
     * @param string $txHash
     * @return array
     * @throws DEXException
     */
    public static function Transaction(string $txHash): array
    {
        try {
            $req = new Request("GET", self::HOSTNAME . "/api/v1/tx/" . $txHash . "?format=json");
            $curl = $req->curl();
            $curl->ssl()->verify(false);
            $curl->expectJSON();
            $res = $curl->send();
        } catch (HttpException $e) {
            trigger_error(sprintf('[%s][%s] %s', get_class($e), $e->getCode(), $e->getMessage()));
            throw new DEXException('Failed to retrieve transaction info');
        }

        return $res->payload()->array();
    }
}
