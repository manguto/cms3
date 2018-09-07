<?php

namespace manguto\cms3\model;

class ModelCSV{
    
    const parameterSeparator = ';';
    
    const lineSeparator = '
';
    
    const reservedCaracters = [';','
'];
    
    /**
     * Converte um ARRAY para uma string no formato CSV
     * @param array $array
     * @throws \Exception
     * @return string
     */
    static function ArrayToCSV(array $array):string{
        //Help::deb($array);
        $lines = [];
        if(sizeof($array)>0){            
            {//header                
                //deb($array,0);
                $arrayIdsValues = array_keys($array);
                $firstEntryKey = array_shift($arrayIdsValues);
                $header = array_keys($array[$firstEntryKey]);
                $lines[] = implode(ModelCSV::parameterSeparator, $header);                
            }
            {//body

                foreach ($array as $lineValues) {
                    //Help::deb($lineValues);
                    if(is_array($lineValues)){                        
                        //pula as linhas vazias
                        if(trim(implode('', $lineValues))!=''){
                            $line = [];
                            foreach ($lineValues as $value){
                                $line[] = ModelCSV::mascString($value);
                            }                            
                            $lines[]=implode(ModelCSV::parameterSeparator, $line);
                        }                        
                    }else{
                        throw new \Exception("Não foi possível converter o array para uma string (CSV).");
                    }
                }
            }
        }
        
        $csv=implode(ModelCSV::lineSeparator, $lines).ModelCSV::lineSeparator;        
        return $csv;
        
    }
    /**
     * Converte um string no formato CSV para um ARRAY
     * @param array $array
     * @throws \Exception
     * @return string
     */
    static function CSVToArray(string $csv,string $idname){
        
        //deb($csv);
        $array=[];
        $csvLineArray = explode(ModelCSV::lineSeparator, $csv);
        //deb($csvLines,0);
        if(sizeof($csvLineArray)>1){
            
            {// montagem / analise do cabecalho
                
                //retirada da primeira linha (em csv) que seria o cabecalho das colunas (titulos)
                $csvHeaderLineCSV = array_shift($csvLineArray);

                //transformacao em array
                $csvHeaderLine_ = explode(ModelCSV::parameterSeparator, $csvHeaderLineCSV);
                
                $headerLineArray = [];
                
                foreach ($csvHeaderLine_ as $key=>$p){                    
                    $p = ModelCSV::unmascString($p);                    
                    $headerLineArray[$key] = $p;                    
                    if($p==$idname){
                        $idKey = $key;
                    }
                }
                if(!isset($idKey)){
                    throw new \Exception("Não foi encontrada nenhum parametro (".implode(', ',$headerLineArray).") que coincida com a chave para indexação informada ($idname).");
                }
                //deb($csvHeaderLine,0);
            }
            
            {//body
                //deb($csvLines);
                foreach ($csvLineArray as $csvLine) {
                    //pula linhas vazias 
                    if(trim($csvLine)==""){
                        continue;
                    }
                    
                    $csvBodyLine_ = explode(ModelCSV::parameterSeparator, $csvLine);                        
                    $idValue = $csvBodyLine_[$idKey];
                    foreach ($csvBodyLine_ as $key=>$p){
                        {
                            $columnName = $headerLineArray[$key];
                            $columnValue = ModelCSV::unmascString($p);
                        }                        
                        $array[$idValue][$columnName] = $columnValue;
                    }                    
                }
            }
        }
        return $array;        
    }
    
    //------------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------
    //---------------------------------  FUNCOES AUXILIARES INTERNAS ---------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------------------------------------
    
    /**
     * aplica mascara a uma string para evitar conflito de 'parseamento'
     * @param string $string
     * @return string
     */
    static private function mascString(string $string):string{
        foreach (ModelCSV::reservedCaracters as $key=>$rc) {
            {
                $search = $rc;
                $replace = "<$key>";
            }
            $string = str_replace($search, $replace, $string);
        }
        return $string;
    }
    /**
     * remove a mascara de string, colocada para evitar conflito de 'parseamento'
     * @param string $string
     * @return string
     */
    static private function unmascString(string $string):string{
        foreach (ModelCSV::reservedCaracters as $key=>$rc) {
            {   
                $search = "<$key>";
                $replace = $rc;
            }
            $string = str_replace($search, $replace, $string);
        }
        return $string;
    }
    
    
}