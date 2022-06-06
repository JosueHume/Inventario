<?php

    // Exibe os detalhes do item:
    class Item 
    {
        public static function selecionarItens($idItem) 
        {
            $conn = Connection::getConn();

            $sql = "SELECT * FROM itens WHERE id = :id";
            $sql = $conn->prepare($sql); 
            $sql->bindValue(':id', $idItem, PDO::PARAM_INT);
            $sql->execute();

            $resultado = array();

            while ($row = $sql->fetchObject('item')) {
                $resultado[] = $row;
            }   
            return $resultado;
        }
        
    }