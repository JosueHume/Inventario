<?php

// Gera mensagem de erro ao acessar algum local não autorizado
class ErroController {

    public function index() {
        echo '<br> Atenção: ERRO, favor atualizar a página e tentar novamente!';
    }

}