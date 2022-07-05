<?php


namespace DotNotation;


class DotNotation
{
    private array $arrayData;
    private string $arrayPath;

    /**
     * Obtém o valor de acordo com o path especificado.
     *
     * @return mixed
     *  O valor obtido no array ou nulo caso o path especificado não exista.
     *
     */
    private function get() {
        $path = $this->arrayPath;
        $data = $this->arrayData;

        if (empty($data)) return null;

        $bradCrumbs = explode('.', $path);

        foreach ($bradCrumbs as $key) {
            if (is_array($data) && isset($data[$key])) {
                $data =& $data[$key];
            } else {
                return null;
            }
        }

        return $data;
    }

    /**
     * Insere o valor em um array de acordo com o path especificado.
     *
     * @param mixed|null $newValues
     *  Os valores que serão inseridos.
     *
     */
    private function set($newValues = null)
    {
        $list =& $this->arrayData;
        $bradCrumbs = explode('.', $this->arrayPath);
        $count = count($bradCrumbs);
        $last = $count - 1;

        foreach ($bradCrumbs as $index => $key) {
            if (is_numeric($key) && intval($key) > 0 || $key === '0') {
                $key = intval($key);
            }

            if ($index === $last) {
                $list[$key] = $newValues;
                break;
            }

            if (!isset($list[$key])) {
                $list[$key] = [];
            }

            $list =& $list[$key];

            if (!is_array($list)) {
                $list = [];
            }
        }

    }

    /**
     * Fornece acesso de leitura ou gravação para o array através de notação de ponto.
     *
     * Lendo valores:
     *
     * Permite que você use uma sintaxe separada por pontos para ler os dados.
     * Exemplo:
     *	$value = `$this->data('array', 'path1.path2.path3...path_N');`
     *  Ao ler valores, você obterá `null` para chaves ou valores não existentes.
     *
     * Escrevendo valores:
     *
     * `$this->data('array', 'path1.path2.path3', 'New Value');`
     *
     * Obs.: Se o caminho ou chave não existir no array, o mesmo será criado e o valor configurado.
     *
     * @arrayData
     * 	Propriedade ou variável que contém o array.
     *
     * @param string $arrayPath
     * 	Caminho separado por pontos para leitura ou gravação
     *      Exemplos:
     *          'path1.path2.path3'
     *
     *      Obs.: Para acessar um array composto basta especificar seu index. Exemplo: 'path1.path2.path3.2'
     *      [
     *          'path1' => '',
     *          'path2' => '',
     *          'path3' => [
     *              ['item1'],
     *              ['item2'],
     *              ['item3']
     *          ]
     *      ]
     *
     * @return mixed
     * 	O valor lido ou array com o novo valor configurado.
     */
    public function data(array $arrayData, string $arrayPath) {
        $args = func_get_args();
        $this->arrayData = $arrayData;
        $this->arrayPath = $arrayPath;

        if (count($args) == 3) {
            $this->set($args[2]);
            return $this->arrayData;
        }

        return $this->get();
    }

}