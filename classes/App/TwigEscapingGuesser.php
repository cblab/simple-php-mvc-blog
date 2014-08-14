<?php
namespace App;

class TwigEscapingGuesser {
    function guess($filename)
    {
        // get the format
        $format = substr($filename, strrpos($filename, '.') + 1);

        switch ($format) {
            case 'js':
                return 'js';
            case 'css':
                return 'css';
            case 'html':
            default:
                return 'html';
        }
    }
}