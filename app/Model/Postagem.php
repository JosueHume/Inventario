<?php

class Postagem 
{
    public static function selecionaTodos()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM itens ORDER BY id DESC";
        $sql = $conn->prepare($sql);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject('item')) {
            $resultado[] = $row;
        } 
        
        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco de dados!");
        }
        return $resultado;
    }

    // Exibe os detalhes do item com um ID em específico
    public static function selecionarPorId($idItem) 
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM itens WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $idItem, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('item');

        if (!$resultado) 
        {
            throw new Exception("Não foi encontrado nenhum registro no banco de dados!");
        } else {
            $resultado->itens = Item::selecionarItens($resultado->id);
    
        }
        return $resultado;
    }

    //Função para inserir no banco de dados!
    public static function insert($dadosItem) 
    {
        if (empty($dadosItem['nome']) OR empty($dadosItem['tipo']) OR empty($dadosItem['aquisicao']) OR empty($dadosItem['descricao']))
        {
            throw new Exception("Favor preencher todos os campos!");

            return false;
        }

        $conn = Connection::getConn();
        $sql =  $conn->prepare('INSERT INTO itens (nome, tipo, aquisicao, descricao) VALUES (:nom, :tip, :aqui, :descr)');
        $sql->bindValue(':nom', $dadosItem['nome']);
        $sql->bindValue(':tip', $dadosItem['tipo']);
        $sql->bindValue(':aqui', $dadosItem['aquisicao']);
        $sql->bindValue(':descr', $dadosItem['descricao']);
        $res = $sql->execute();

        if ($res == 0) {
            throw new Exception("Falha ao inserir item na coleção!");

            return false;
        }
            return true;
    }

    //Função para editar no banco de dados!
    public static function update($params) 
    {
        $conn = Connection::getConn();

        $sql = "UPDATE itens SET nome = :nom, tipo = :tip, aquisicao = :aqui, descricao = :descr WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $sql->bindValue(':nom', $params['nome']);
        $sql->bindValue(':tip', $params['tipo']);
        $sql->bindValue(':aqui', $params['aquisicao']);
        $sql->bindValue(':descr', $params['descricao']);
        $resultado = $sql->execute();

        if($resultado == 0) 
        {
            throw new Exception("Falha ao alterar dados do Item!");

            return false;
        }
            return true;
    }

    //Função para apagar no banco de dados!
    public static function delete($params) 
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM itens WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if($resultado == 0) 
        {
            throw new Exception("Falha ao deletar Item na coleção!");

            return false;
        }
            return true;
    } 

}