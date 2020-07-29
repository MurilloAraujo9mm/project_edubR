<?php

namespace Source\Models;

use Jarouche\ViaCEP\HelperViaCep;

/**
 * Class Cep
 * @package Source\Models
 */
class Cep extends HelperViaCep
{
    /**@var array|null */
    protected $data;

    public function __construct(?array $types)
    {
        $this->data = $types;
    }

    public function cepFind(string $number)
    {
        foreach ($this->data as $cep) {
           $find = HelperViaCep::getBuscaViaCEP($cep, $number);
        }

        return $find;
    }
}