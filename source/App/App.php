<?php

namespace Source\App;

use Source\Core\Connect;
use Source\Core\Controller;
use Source\Core\Session;
use Source\Core\View;
use Source\Models\Auth;
use Source\Models\CafeApp\AppCategory;
use Source\Models\CafeApp\AppInvoice;
use Source\Models\CafeApp\AppOrder;
use Source\Models\CafeApp\AppPlan;
use Source\Models\CafeApp\AppSubscription;
use Source\Models\CafeApp\AppWallet;
use Source\Models\Cep;
use Jarouche\ViaCEP\HelperViaCep;
use Source\Models\Courses;
use Source\Models\ListUsers;
use Source\Models\Local;
use Source\Models\Post;
use Source\Models\Report\Access;
use Source\Models\Report\Online;
use Source\Models\Server;
use Source\Models\User;
use Source\Support\Email;
use Source\Support\Thumb;
use Source\Support\Upload;

/**
 * Class App
 * @package Source\App
 */
class App extends Controller
{
    /** @var User */
    private $user;

    /**
     * App constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_APP . "/");

        if (!$this->user = Auth::user()) {
            $this->message->error("Efetue login para acessar o painel admin.")->flash();
            redirect("/");
        }

    }

    /**
     * APP HOME
     */
    public function home(?array $data): void
    {

        if (!empty($data["action"]) && $data["action"] === "update") {
            var_dump([[[[[]]]]]);
            return;
        }


        $head = $this->seo->render(
            "Olá {$this->user->name}. Locais - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        echo $this->view->render("dash", [

            "head" => $head,
            "local" => (new Local())
                ->find("id_local >= :id", "id=1")
                ->fetch(true)

        ]);
    }

    public function location(?array $data): void
    {

        //search
        $search = null;
        $cep = new Cep(["JSON", "XML"]);


        if (!empty($data["cepSearch"])) {

            if (empty($data["search"])) {
                $json["message"] = $this->message->info("Opss! Por favor! Preencha o campo CEP")->render();
                echo json_encode($json);
                return;
            }
            $search = filter_var($data["search"], FILTER_SANITIZE_STRIPPED);
            $search = $cep->cepFind("{$search}")["result"];


            if ($search) {
                $this->message->success("Cep localizado com sucesso")->render();
                echo json_encode($search);
                return;
            }
            echo json_encode($search);
        }

        //create
        if (!empty($data["create"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $userCreate = new Local();
            $userCreate->nome = $data["nome"];
            $userCreate->cep = $data["cep"];
            $userCreate->logradouro = $data["logradouro"];
            $userCreate->complemento = $data["complemento"];
            $userCreate->numero = $data["numero"];
            $userCreate->bairro = $data["bairro"];
            $userCreate->uf = $data["uf"];
            $userCreate->cidade = $data["cidade"];

            if (!$userCreate->save()) {
                $json["message"] = $userCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Usuário cadastrado com sucesso...")->render();
            $json["redirect"] = url("/app");

            echo json_encode($json);
            return;
        }


        //update
        if (!empty($data["update"])) {
            $userUpdate = (new Local())->find("id_local = :id", "id={$data["id_local"]}")
                ->fetch();

            $userUpdate->nome = $data["nome"];
            $userUpdate->cep = $data["cep"];
            $userUpdate->logradouro = $data["logradouro"];
            $userUpdate->complemento = $data["complemento"];
            $userUpdate->numero = $data["numero"];
            $userUpdate->bairro = $data["bairro"];
            $userUpdate->uf = $data["uf"];
            $userUpdate->cidade = $data["cidade"];

            if (!$userUpdate->save()) {
                $json["message"] = $user->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Pronto {$this->user->first_name}. Seus dados foram atualizados com sucesso!")->render();
            echo json_encode($json);
            return;

        }

        //delete
        if (!empty($data["delete"])) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userDelete = (new Local())->find("id_local = :id", "id={$data["id_local"]}")->fetch();

            if (!$userDelete) {
                $this->message->error("Você tentnou deletar um usuário que não existe")->flash();
                echo json_encode(["redirect" => url("/app")]);
                return;
            }

            $userDelete->delete("id_local = :id", "id={$data["id_local"]}");

            $this->message->success("O usuário foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/app")]);
            return;

        }

        $userEdit = null;
        if (!empty($data["id_local"])) {
            $userId = filter_var($data["id_local"], FILTER_VALIDATE_INT);
            $userEdit = (new Local())->find("id_local = :id_local", "id_local={$userId}")->fetch();
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($userEdit ? "Perfil de {$userEdit->nome}" : "Novo Usuário"),
            CONF_SITE_DESC,
            url("/admin"),
            url("/admin/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("location", [
            "head" => $head,
            "local" => $userEdit,
            "cep" => $search
        ]);

    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function profile(?array $data): void
    {

        if (!empty($data["update"])) {
            $user = (new User())->findById($this->user->id);
            $user->name = $data["name"];
            $user->mail = $data["mail"];
            $user->password = $data["password"];


            if (!empty($_FILES["photo"])) {
                $file = $_FILES["photo"];
                $upload = new Upload();


                if ($this->user->photo()) {
                    (new Thumb())->flush("storage/{$this->user->photo}");
                    $upload->remove("storage/{$this->user->photo}");
                }

                if (!$user->photo = $upload->image($file, "{$user->name} {$user->name} " . time(), 360)) {
                    $json["message"] = $upload->message()->before("Ooops {$this->user->name}! ")->after(".")->render();
                    echo json_encode($json);
                    return;
                }
            }

            if (!$user->save()) {
                $json["message"] = $user->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Pronto {$this->user->first_name}. Seus dados foram atualizados com sucesso!")->render();
            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Meu perfil - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        echo $this->view->render("profile", [
            "head" => $head,
            "user" => $this->user,
            "photo" => ($this->user->photo() ? image($this->user->photo, 360, 360) :
                theme("/assets/images/avatar.jpg", CONF_VIEW_APP))
        ]);
    }

    public function forget()
    {
        echo "<h1>Recupear</h1>";
    }

    /**
     * APP LOGOUT
     */
    public function logout(): void
    {
        $this->message->info("Saiu com sucesso " . Auth::user()->name . ". Volte logo :)")->flash();

        Auth::logout();
        redirect("/");
    }
}
