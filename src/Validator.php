<?php
declare(strict_types=1);

namespace FurqanSiddiqui\Binance;

use FurqanSiddiqui\Binance\Bech32\Bech32;
use FurqanSiddiqui\Binance\Exceptions\Bech32Exception;

/**
 * Class Validator
 * @package FurqanSiddiqui\Binance
 */
class Validator
{
    /**
     * @param $addr
     * @return bool
     */
    public static function isValidAddress($addr): bool
    {
        if (!is_string($addr) || !$addr) {
            return false;
        }

        try {
            Bech32::decode($addr);
            return true;
        } catch (Bech32Exception $e) {
        }

        return false;
    }
}
