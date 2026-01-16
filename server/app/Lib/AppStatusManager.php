<?php

namespace App\Lib;

use App\AppStatus;

/**
 * A utility used to store and retrieve key-value pairs
 * to and from the database
 */
class AppStatusManager
{
    /**
     * The current amount collected in the money box
     *
     * @var string
     */
    public const MONEYBOX_VALUE = 'moneybox.value';

    /**
     * Reads a value stored with the given key in the database
     */
    public static function readStatusValue(string $status_key, string $defaultValue): string
    {
        $status = AppStatus::find($status_key);

        if ($status === null) {
            return $defaultValue;
        }

        return $status->value;
    }

    /**
     * Saves the value to the database with the specified key
     */
    public static function saveStatusValue(string $status_key, string $value): void
    {
        AppStatus::updateOrCreate(
            ['id' => $status_key],
            ['value' => $value]
        );
    }
}
