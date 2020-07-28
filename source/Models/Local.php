<?php

namespace Source\Models;

use Source\Core\Model;

class Local extends Model
{
    public function __construct()
    {
        parent::__construct("local",

            /** Required fields */

            [
                "id_local"
            ],

            [
                "nome",
                "bairro",
                "cep",
                "logradouro",
                "complemento",
                "numero",
                "bairro",
                "uf",
                "cidade"
            ]

        );
    }
    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Desculpe! Todos os campos são obrigatórios");
            return false;
        }

        /** User Update */
        if (!empty($this->id_local)) {
            $idLocal = $this->id_local;

            $this->update($this->safe(), "id_local = :id_local", "id_local={$idLocal}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Local Create */
        if (empty($this->id_local) || $this->id_local == null) {

            if (strlen($this->uf) > 2){
                $this->message->error("O Campo UF deve ser no formato: (MG), (SP), (RJ) e o cep não deve conter pontos: . ou traço - ");
                return false;
            }

            if (strlen($this->uf) > 2){
                $this->message->error("O Campo UF deve ser no formato: (MG), (SP), (RJ)");
                return false;
            }

            $idLocal = $this->create($this->safe());

            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->find("id_local = :i", "i={$idLocal}"))->data();

        return true;

    }
}