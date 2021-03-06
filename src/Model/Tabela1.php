<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 13/07/18
 * Time: 22:13
 */

namespace App\Model;


use App\Core\Model;

class Tabela1 extends Model
{
    private $id;

    private $nome;

    private $email;

    private $senha;

    private $ultimaAlteracao;

    public function __construct()
    {
        parent::__construct();
        $this->setSource('tabela1');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        if (empty($nome)) {
            throw new \Exception('Nome é obrigatório');
        }
        $string = str_replace(' ', '', $nome);

        if (preg_match('/\W|\d/', $string)) {
            throw new \Exception('Nome não deve conter números ou caracteres especiais');
        }

        $this->nome = trim($nome);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('E-mail inválido');
        }

        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        if (false == preg_match("/(?=.*[a-z])(?=.*\d).{6,}/", $senha)) {
            throw new \Exception("Senha deve possuir no mínimo 6 caracteres e ter no mínimo uma letra e um número");
        }

        $this->senha = md5($senha);
    }

    /**
     * @return mixed
     */
    public function getUltimaAlteracao()
    {
        return $this->ultimaAlteracao;
    }

    /**
     * @param mixed $ultimaAlteracao
     */
    public function setUltimaAlteracao($ultimaAlteracao)
    {
        $this->ultimaAlteracao = $ultimaAlteracao;
    }

    /**
     * Função para buscar os registros da tabela 1 aproveitando a procedure criada
     * @return array
     */
    public function buscaRegistros(): array
    {
        return $this->db->query("CALL Busca_Registros")->fetchAll();
    }


}
