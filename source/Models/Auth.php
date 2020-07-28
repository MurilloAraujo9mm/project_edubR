<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Core\Session;
use Source\Core\View;
use Source\Support\Email;

/**
 * Class Auth
 * @package Source\Models
 */
class Auth extends Model
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct("user", ["id"], ["mail", "password"]);
        
    }

    /**
     * @return null|User
     */
    public static function user(): ?User
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }
        
        return (new User())->findById($session->authUser);
        
    }

    /**
     * log-out
     */
    public static function logout(): void
    {
        $session = new Session();
        $session->unset("authUser");
    }
    
    /**
     * @param string $email
     * @param string $password
     * @param bool $save
     * @return bool
     */
    public function login(string $email, string $password, bool $save = false): bool
    {
        if (!is_email($email)) {
            $this->message->warning("O e-mail informado não é válido");
            return false;
        }

        if ($save) {
            setcookie("authEmail", $email, time() + 604800, "/");
        } else {
            setcookie("authEmail", null, time() - 3600, "/");
        }

        if (!is_passwd($password)) {
            $this->message->warning("A senha informada não é válida");
            return false;
        }

        $user = (new User())->findByEmail($email);
        if (!$user) {
            $this->message->error("O e-mail informado não está cadastrado");
            return false;
        }

        if (!passwd_verify($password, $user->password)) {
            $this->message->error("A senha informada não confere");
            return false;
        }
        
        if (passwd_rehash($user->password)) {
            $user->password = $password;
            $user->save();
        }

        //LOGIN
        (new Session())->set("authUser", $user->id);
        return true;
    }
    
    public function forget(string $email): bool
    {
        $user = (new User())->findByEmail($email);
        
        if (!$user) {
            $this->message->warning("O e-mail informado não está cadastrado.");
            return false;
        }
        
        $user->name = "Murillo";
        $user->password = $email;
        $user->save();
        
        $view = new View(__DIR__ . "/../../shared/views/email");
        
        $message = $view->render("forget", [
            "name" => $user->name,
            "mail" => $user->mail,
            "forget_link" => url("/recuperar/{$user->mail}|{$user->forget}"),
            "paragrapf" => "Informamos que a sua senha, é o seu email agora"
        ]);
        
        (new Email())->bootstrap(
            "Recupere sua senha no " . CONF_SITE_NAME,
            $message,
            $user->mail,
            "{$user->name} {$user->mail}"
        )->send();
        
        return true;
    }
    
    /**
     * @param User $user
     * @return bool
     */
    public function register(User $user): bool
    {
        if (!$user->save()) {
            $this->message = $user->message;
            return false;
        }
        return true;
    }


    
    
}