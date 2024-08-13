<?php

namespace App\Helpers;

class FlashMessage{
    

    private const FLASH = 'flash_message';

    const FLASH_ERROR = 'danger';
    const FLASH_WARNING = 'warning';
    const FLASH_INFO = 'primary';
    const FLASH_SUCCESS = 'success';

    /**
     * Create a flash message
     *
     * @param string $name
     * @param string $message
     * @param string $type
     * 
     * @return void
     */
    public static function flash(string $name, string $message, string $type): void
    {
        // remove existing message with the name
        if (isset($_SESSION[self::FLASH][$name])) {
            unset($_SESSION[self::FLASH][$name]);
        }
        // add the message to the session
        $_SESSION[self::FLASH][$name] = ['message' => $message, 'type' => $type];
    }
}