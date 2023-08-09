<?php

namespace App\Models;

use App\Conn;
use PDO;
use PDOException;
use App\Contracts\ModelContract;

class User extends Conn implements ModelContract
{

    protected $pdo;
    private $table = "usuarios";
    private $attrib;

    public function __construct()
    {
        $this->pdo = Conn::connect();
    }

    public function __get($attribute)
    {
        return $this->attrib[$attribute];
    }

    public function __set($attribute, $value)
    {
        $this->attrib[$attribute] = $value;
    }

    public function createUser()
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO $this->table (nome, email, senha) VALUE (:nome, :email, :senha)");
            $stmt->bindValue(":nome", $this->__get('nome', PDO::PARAM_STR));
            $stmt->bindValue(":email", $this->__get('email', PDO::PARAM_STR));
            $stmt->bindValue(":senha", md5($this->__get('senha', PDO::PARAM_STR)));

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION['msg'] = "<div class=\"alert alert-success\" role=\"alert\">
                    Usuário cadastrado com sucesso!
                  </div>";
                    return $this;
                } else {
                    throw new PDOException("Não foi cadastrado");
                }
            } else {
                throw new PDOException("Houve um problema com a consulta SQL");
            }
        } catch (PDOException $e) {
            $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
                                   " . $e->getMessage() . "
                                </div>";
        }
        return null;
    }

    /**
     * Function that validates the registry of a new user
     *
     * @return bool
     */
    public function validateRegister()
    {
        $valid = true;
        if (strlen($this->__get('nome')) < 5) {
            $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
             Campo NOME inválido
            </div>";
            $valid = false;
        }

        $email = filter_var($this->__get('email'), FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
             Campo EMAIL inválido
            </div>";
            $valid = false;
        }
        if (strlen($this->__get('senha')) < 6) {
            $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
             Campo SENHA inválido
            </div>";
            $valid = false;
        }


        return $valid;
    }

    public function searchUserEmail()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT email FROM $this->table WHERE email = :email");
            $stmt->bindValue(":email", $this->__get('email', PDO::PARAM_STR));

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                throw new PDOException("Houve um problema com a consulta SQL");
            }
        } catch (PDOException $e) {
            $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
                                   " . $e->getMessage() . "
                                </div>";
        }
        return null;
    }

    public function authenticate()
    {

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE email = :email AND senha = :senha");
            $stmt->bindValue(":email", $this->__get('email', PDO::PARAM_STR));
            $stmt->bindValue(":senha", md5($this->__get('senha', PDO::PARAM_STR)));

            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                if ($stmt->rowCount() == 1) {
                    $this->__set('id', $result[0]->id);
                    $this->__set('nome', $result[0]->nome);
                    $this->__set('email', $result[0]->email);
                    $this->__set('is_admin', $result[0]->is_admin);
                }
                return $result;
            } else {
                throw new PDOException("Houve um problema com a consulta SQL");
            }
        } catch (PDOException $e) {
            $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
                                   " . $e->getMessage() . "
                                </div>";
        }
        return null;
    }
}
