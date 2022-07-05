# PHP Dot Notation
 Fornece acesso de leitura ou gravação para o array através de notação de ponto

## Lendo valores:

Permite que você use uma sintaxe separada por pontos para ler os dados.

Exemplo:

    $value = `$this->data('array', 'path1.path2.path3...path_N');`

Ao ler valores, você obterá `null` para chaves ou valores não existentes.

## Escrevendo valores:

    `$this->data('array', 'path1.path2.path3', 'New Value');`

* Obs.: Se o caminho ou chave não existir no array, o mesmo será criado e o valor configurado.

### Params:
    array :: arrayData 
    - Propriedade ou variável contendo o array.
    
    string :: arrayPath
    - Caminho separado por pontos para leitura ou gravação
    
        Exemplo:
            'path1.path2.path3'
    
        Obs.: Para acessar um array composto basta especificar seu index. Exemplo: 'path1.path2.path3.2'
          
        [
            'path1' => '',
            'path2' => '',
            'path3' => [
                ['item1'],
                ['item2'],
                ['item3']
            ]
        ]