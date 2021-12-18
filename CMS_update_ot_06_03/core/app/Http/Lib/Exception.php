<?php

namespace App\Http\Lib;

class Exception {
    public $var;

    const THROW_NONE    = 0;
    const THROW_CUSTOM  = 1;
    const THROW_DEFAULT = 2;

    function __construct($avalue = self::THROW_NONE) {

        switch ($avalue) {
            case self::THROW_CUSTOM:
                // Выбрасываем собственное исключение
                throw new MyException('1 - неправильный параметр', 5);
                break;

            case self::THROW_DEFAULT:
                // Выбрасываем встроеное исключение
                throw new Exception('2 - недопустимый параметр', 6);
                break;

            default: 
                // Никаких исключений, объект будет создан.
                $this->var = $avalue;
                break;
        }
    }
}

?>