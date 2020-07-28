<?php

namespace Source\Models;

use Source\Core\Model;

class Local extends Model
{
    public function __construct()
    {
        parent::__construct("local", ["id_local"], ["nome"]);
    }
    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Nome");
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