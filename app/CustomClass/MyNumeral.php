<?php
namespace App\CustomClass;

use Stillat\Numeral\Languages\LanguageManager;
use Stillat\Numeral\Numeral;

class MyNumeral
{
    public static function formatter()
    {
        // Create the language manager instance.
        $languageManager = new LanguageManager;
        // Create the Numeral instance.
        $formatter = new Numeral;
        // Now we need to tell our formatter about the language manager.
        $formatter->setLanguageManager($languageManager);

        return $formatter;
    }
}
?>