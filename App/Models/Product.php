<?php

namespace App\Models;

use App\Contracts\ModelContract;
use App\Conn;
use PDO;
use PDOException;

class Product extends Conn implements ModelContract
{
    protected $pdo;
    private $table = "produtos";
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


    /**
     * Returns an object with all the data from the table
     */
    public function readProduct()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $this->table");
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return $stmt->fetchAll(PDO::FETCH_OBJ);
                } else {
                    throw new PDOException("Não foi encontrado nenhum produto");
                }
            } else {
                throw new PDOException("Houve um problema com a consulta SQL");
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        return null;
    }

    /**
     * Returns an object with all the data from the table
     *
     * @return Product object
     */
    public function create(): ?Product
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO $this->table (nome, descricao, preco, imagem)
            VALUE(:nome,:descricao,:preco,:imagem)");
            $stmt->bindValue(":nome",  $this->__get('nome'), PDO::PARAM_STR);
            $stmt->bindValue(":descricao", $this->__get('descricao'), PDO::PARAM_STR);
            $stmt->bindValue(":preco", $this->__get('preco'), PDO::PARAM_STR);
            $stmt->bindValue(":imagem", $this->__get('imagem'), PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION['msg'] = "<div class=\"alert alert-success\" role=\"alert\">
                        Produto cadastrado com sucesso</div>";
                    return $this;
                } else {
                    throw new PDOException("Não foi possível inserir registros na tabela $this->table");
                }
            }
            else {
                throw new PDOException("Houve um problema com a consulta SQL");
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        return null;
    }


    /**
     * Validates the name of the product
     *
     * @return bool
     */
    public function validate()
    {
        if (strlen($this->__get('nome')) < 5) {
            $_SESSION['msg'] = $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">
                Campo NOME inválido!</div>";
            return false;
        }

        return true;
    }

    /**
     * Remove product by id
     *
     * @return ?Product
     */
    public function delete(): ?Product
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
            $stmt->bindvalue(":id", $this->__get('id'), PDO::PARAM_INT);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION['msg'] = "<div class=\"alert alert-succes\" role=\"alert\">
                        Produto excluido com sucesso!</div>";
                    return $this;
                } else {
                    throw new PDOException("Não foi possivel realizar a exclusão na tabela $this->table");
                }
            } else {
                throw new PDOException("Erro no SQL");
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        return null;
    }

    /**
     * Alter product by id
     *
     * @return ?Product
     */
    public function update($value, $column, $id): ?Product
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE $this->table SET $column = '$value' WHERE (id = '$id')");
            if ($stmt->execute($this->attrib)) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION['msg'] = "<div class=\"alert alert-succes\" role=\"alert\">
                        $column alterado com sucesso!</div>";
                    return $this;
                } else {
                    throw new PDOException("Não foi possivel realizar a alteração na tabela $this->table");
                }
            } else {
                throw new PDOException("Houve um problema no código SQL");
            }
        } catch (PDOException $e) {
            print_r(json_encode([$e])); exit;
            echo $e->getMessage();
        }

        return null;
    }

    /**
     * Search product by name
     *
     * @return ?Product/null
     */
    public function search($name)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE nome LIKE :nome");
            $stmt->bindvalue(":nome", "%" . $name . "%", PDO::PARAM_STR);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return $stmt->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $_SESSION['msg'] = "<div class=\"alert alert-danger\" role=\"alert\">Produto não encontrado!</div>";
                }
            } else {
                throw new PDOException('ERRO NO SQL');
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

        return null;
    }
}
