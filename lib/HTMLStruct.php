<?php
namespace manguto\cms3\lib;

use manguto\cms3\model\Model;

class HTMLStruct extends HTML
{

    /*static function form_model(Model $model)
    {
        $form = [];
        {
            $form[] = HTMLTag::form_open('', 'POST', '');
            {
                $structures = $model->getStructure();

                foreach ($structures as $name => $structure) {
                    {
                        $label = $structure['label'];
                        $type = $structure['type'];
                        $value = $structure['value'];
                    }
                    $form[] = HTMLTag::input($name, $label, $value, $type);
                }
                $form[] = HTMLTag::button('Salvar');
            }
            $form[] = HTMLTag::form_close();
        }
        $form = implode(chr(10), $form);

        return $form;
    }*/
}

?>