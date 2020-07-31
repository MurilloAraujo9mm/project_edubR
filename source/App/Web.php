<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\User;

/**
 * Web Controller
 * @package Source\App
 */
class Web extends Controller
{
    /**
     * Web constructor.
     */
    public function __construct()
    {
      parent::__construct(
            
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . "themes" .
            DIRECTORY_SEPARATOR . CONF_VIEW_THEME . DIRECTORY_SEPARATOR);
    }
    
 
    /**
     * SITE LOGIN
     * @param null|array $data
     */
    public function login(?array $data): void
    {
        if (Auth::user()) {
            redirect("/");
        }
        
        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }
            
            if (empty($data['mail']) || empty($data['password'])) {
                $json['message'] = $this->message->error("Informe seu email e senha para entrar")->render();
                echo json_encode($json);
                return;
            }

            $save = new Auth();
            
            $save = (!empty($data['save']) ? true : false);
            $auth = new Auth();
            $login = $auth->login($data['mail'], $data['password'], $save);
            
            if ($login) {
                $this->message->success("Seja bem-vindo(a) de volta " . Auth::user()->name . "!")->flash();
                $json['redirect'] = url("/app");
            } else {
                $json['message'] = $auth->message()->before("Ooops! ")->render();
            }
            
            echo json_encode($json);
            return;
        }
        
        $head = $this->seo->render(
            "Entrar - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );
        
        echo $this->view->render("login", [
            "head" => $head,
            "cookie" => filter_input(INPUT_COOKIE, "authEmail")
        ]);
    }
    
    /**
     * SITE PASSWORD FORGET
     * @param null|array $data
     */
    public function forget(?array $data)
    {
        
        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }
            
            if (empty($data["mail"])) {
                $json['message'] = $this->message->info("Informe seu e-mail para continuar")->render();
                echo json_encode($json);
                return;
            }
            
            if (!empty($data["mail"])){
                
                $user = (new User())->findByEmail("{$data['mail']}");
                if (!$user){
                    $json["message"] = $this->message->error("Email não cadastrado!")->render();
                    echo json_encode($json);
                    return;
                }
            }
            
            $auth = new Auth();
            if ($auth->forget($data["mail"])) {
                $json["message"] = $this->message->success("Acesse seu e-mail para recuperar a senha")->render();
                echo json_encode($json);
                return;
            } else {
                $json["message"] = $auth->message()->before("Ooops! ")->render();
            }
            
        }
        
        $head = $this->seo->render(
            "Recuperar Senha - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/forget"),
            theme("/assets/images/share.jpg")
        );
        
        echo $this->view->render("forget", [
            "head" => $head
        ]);
    }
    
    /**
     * SITE FORGET RESET
     * @param array $data
     */
    public function reset(array $data): void
    {
        if (Auth::user()) {
            redirect("/app");
        }
        
        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }
            
            if (empty($data["password"]) || empty($data["password_re"])) {
                $json["message"] = $this->message->info("Informe e repita a senha para continuar")->render();
                echo json_encode($json);
                return;
            }
            
            list($email, $code) = explode("|", $data["code"]);
            $auth = new Auth();
            
            if ($auth->reset($email, $code, $data["password"], $data["password_re"])) {
                $this->message->success("Senha alterada com sucesso. Vamos controlar?")->flash();
                $json["redirect"] = url("/entrar");
            } else {
                $json["message"] = $auth->message()->before("Ooops! ")->render();
            }
            
            echo json_encode($json);
            return;
        }
        
        $head = $this->seo->render(
            "Crie sua nova senha no " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/recuperar"),
            theme("/assets/images/share.jpg")
        );
        
        echo $this->view->render("auth-reset", [
            "head" => $head,
            "code" => $data["code"]
        ]);
    }
    
    /**
     * SITE REGISTER
     * @param null|array $data
     */
    public function register(?array $data): void
    {
        
        if (!empty($data['csrf'])) {
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }
            
            if (empty($data["mail"])){
                $json["message"] = $this->message->info("Ops! Informe seu email para se cadastrar")->render();
                echo json_encode($json);
                return;
            }
            
            if (empty($data["password"])){
                $json["message"] = $this->message->info("Ops! Informe uma senha para se cadastrar")->render();
                echo json_encode($json);
                return;
            }
            
            if (in_array("", $data)) {
                $json['message'] = $this->message->info("Informe seus dados para criar sua conta.")->render();
                echo json_encode($json);
                return;
            }
            
                $auth = new Auth();
                $user = new User();
                $user->bootstrap(
                    $data["name"],
                    $data["mail"],
                    $data["password"]
                );

                $result = $user->find("name = :n AND email = :e", "n={$data["name"]}&e={$data["mail"]}");

                if ($auth->register($user)) {
                    $json['message'] = $this->message->success("Cadastro com sucesso")->render();
                    echo json_encode($json);
                    return;
                }

                if ($result){
                    $json['message'] = $this->message->warning("Este usuário já cadastrado! Faça login")->render();
                    echo json_encode($json);
                    return;

                }
        }
        
        $head = $this->seo->render(
            "Cadastra-se no sistema" . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/"),
            theme("/assets/images/share.jpg")
        );
        
        echo $this->view->render("register-account", [
            "head" => $head
        ]);
    }


    
    /**
     * SITE NAV ERROR
     * @param array $data
     */
    public function error(array $data): void
    {
        $error = new \stdClass();
        
        switch ($data['errcode']) {
            case "problemas":
                $error->code = "OPS";
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nosso serviço não está diponível no momento. Já estamos vendo isso mas caso precise, envie um e-mail :)";
                $error->linkTitle = "ENVIAR E-MAIL";
                $error->link = "mailto:" . CONF_MAIL_SUPPORT;
                break;
            
            case "manutencao":
                $error->code = "OPS";
                $error->title = "Desculpe. Estamos em manutenção!";
                $error->message = "Voltamos logo! Por hora estamos trabalhando para melhorar nosso conteúdo :P";
                $error->linkTitle = null;
                $error->link = null;
                break;
            
            default:
                $error->code = $data['errcode'];
                $error->title = "Ooops. Conteúdo indispinível :/";
                $error->message = "Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido :/";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
        }
        
        $head = $this->seo->render(
            "{$error->code} | {$error->title}",
            $error->message,
            url("/ops/{$error->code}"),
            theme("/assets/images/share.jpg"),
            false
        );
        
        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}
