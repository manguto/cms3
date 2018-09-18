<?php
namespace manguto\cms3\model;

use manguto\cms3\lib\ServerHelp;
use manguto\cms3\lib\Exception;

class Model
{

    protected $values = [];

    protected $structure = [];

    protected $modelname;

    protected $repositoryname;

    protected $idname;

    public function __construct(int $idValue = 0)
    {
        $this->setModelname();

        $this->setRepositoryname();

        $this->setIdname();

        $this->setIdValue($idValue);

        $this->ordenateValues();
    }

    /**
     * obtem o nome da classe do objeto atual
     *
     * @return string
     */
    public function getModelname(): string
    {
        return $this->modelname;
    }

    /**
     * obtem o nome da possivel tabela do repositorio para o objeto atual
     *
     * @return string
     */
    public function getRepositoryname(): string
    {
        return $this->repositoryname;
    }

    // magic methods GET & SET
    public function __call($name, $args)
    {
        $method = substr($name, 0, 3);
        $method = strtolower($method);
        if ($method == 'get' || $method == 'set') {
            // garimpa o nome do parametro
            $fieldName = strtolower(substr($name, 3, strlen($name)));
            // se o parametro nao existir, cria-o
            if (! isset($this->values[$fieldName])) {
                $this->values[$fieldName] = null;
                // throw new Exception("Atributo não encontrado ou inexistente ($fieldName).");
            }
            if ($method == 'get') {
                // get
                return $this->values[$fieldName];
            } else {
                // set
                $this->values[$fieldName] = $args[0];
            }
        } else {
            throw new Exception("Método não encontrado ou incorreto (model->$name).");
        }
    }

    /**
     * define os parametros ou atributos do modelo
     * atraves de um array passado
     *
     * @param array $data
     */
    public function setData(array $data = array())
    {
        foreach ($data as $key => $value) {
            $key = strtolower($key);
            $this->{"set" . $key}($value);
        }
    }

    /**
     * obtem o conteudo do modelo em forma de array
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->values;
    }

    /**
     * define um conteudo estrutural para o modelo
     *
     * @return array
     */
    public function setStructure($name, $value='', $label='', $type='string')
    {   
        {
            $label = $label=='' ? ucfirst($name) : $label;
        }
        $this->structure[$name] = [
            'name' => $name,
            'label' => $label,
            'value' => $value,
            'type' => $type
        ];
    }

    /**
     * obtem o conteudo estrutural do modelo
     *
     * @return array
     */
    public function getStructure(): array
    {   
        $values = $this->values;
        foreach ($values as $name=>$value){
            if(isset($this->structure[$name])){
                $this->structure[$name]['value'] = $this->values[$name];
            }else{                
                $this->setStructure($name,$value);
            }
        }
        return $this->structure;
    }

    /**
     * obtem o nome do identificador do modelo atual
     *
     * @return string
     */
    public function getIdname(): string
    {
        return $this->idname;
    }

    static function getIdnameStatic(string $repositoryname)
    {
        $className = '\lib\model\\' . $repositoryname;
        $obj = new $className();
        return $obj->getIdname();
    }

    /**
     * obtem o valor do identificador (identificador propriamente dito)
     *
     * @return int
     */
    public function getIdValue(): int
    {
        $method = 'get' . $this->getIdname() . '';
        $return = $this->$method();
        return intval($return);
    }

    /**
     * define o valor do identificador do modelo atual
     *
     * @param int $idValue
     * @return int
     */
    public function setIdValue(int $idValue)
    {
        $method = 'set' . $this->getIdname() . '';
        $this->$method($idValue);
    }

    public function loadReferences()
    {
        foreach ($this->values as $key => $value) {
            // deb("$key $value");

            if (substr($key, - 2, 2) == 'id' && $value != 0) {
                $possibleRepositoryName = ucfirst(str_replace('id', '', $key));
                // deb("$possibleRepositoryName | ".$this->getModelname());
                // evita o re-carregamento do proprio objeto
                if ($possibleRepositoryName != $this->getModelname()) {
                    // deb("$key $value");
                    if (class_exists($possibleRepositoryName)) {
                        // deb($possibleRepositoryName);
                        $modelPossibleRepositoryName = '\lib\model\\' . $possibleRepositoryName;
                        // deb($modelPossibleRepositoryName);
                        $referencedObjectTemp = new $modelPossibleRepositoryName($value);
                        // deb($referencedObjectTemp);
                        $this->{'set' . $possibleRepositoryName}($referencedObjectTemp);
                        // deb($this);
                    }
                }
            }
        }
    }

    /**
     * retorna o modelo em forma de string
     *
     * @return string
     */
    public function __toString(): string
    {
        $return = array();
        foreach ($this->values as $c => $v) {
            $return[] = "$c: $v";
        }
        $return = strtoupper(Model::getModelname($this)) . ': ' . json_encode($this->values);
        return $return;
    }

    // --------------------------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------------
    /**
     * define o nome do modelo do objeto
     */
    private function setModelname(): void
    {
        $modelname = get_class($this);
        $modelname = ServerHelp::fixds($modelname);
        $modelname = explode(DIRECTORY_SEPARATOR, $modelname);
        $modelname = array_pop($modelname);
        $this->modelname = $modelname;
    }

    /**
     * define o nome da possivel tabela do repositorio para o objeto atual
     */
    private function setRepositoryname(): void
    {
        $this->repositoryname = strtolower($this->modelname);
    }

    /**
     * define o nome do id (entificador) da possivel tabela do objeto
     */
    private function setIdname(): void
    {
        $this->idname = $this->repositoryname . 'id';
    }

    /**
     * Ordena os parametros ou valores do objeto de forma que o id fique como o primeiro item da lista
     */
    private function ordenateValues(): void
    {
        $valuesOrd = [];
        $valuesOrd[$this->getIdname()] = NULL;
        foreach ($this->values as $k => $v) {
            $valuesOrd[$k] = $v;
        }
        $this->values = $valuesOrd;
    }

    // ...
    // ...
    // ...
    // ...
}

?>