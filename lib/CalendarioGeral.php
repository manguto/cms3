<?php
namespace manguto\lib;

class CalendarioGeral
{

    private $dateStr;

    public $anoSolicitado;

    public $mesSolicitado;

    public $diaSolicitado;

    public $mesNomeExibir = true;

    public $mesNomeTamanho = 'p';

    public $diaNomeExibir = true;

    public $diaNomeTamanho = 'p';

    public $css = '';

    public $tableId = '';

    public $tableClass = '';

    public $tableStyle = '';

    public $thTitleClass = '';

    public $thTitleStyle = '';

    public $thClass = '';

    public $thStyle = '';

    public $tdClass = '';

    public $tdStyle = '';

    public $conteudoTD = '{$d}';

    public $conteudoMatriz = [];

    public function __construct($dateStr, $dateFormat = '')
    {
        $datas = new Datas($dateStr, $dateFormat);

        $this->anoSolicitado = $datas->getDate('Y');
        $this->mesSolicitado = $datas->getDate('m');
        $this->diaSolicitado = $datas->getDate('d');
    }

    public function obterMesSolicitadoHTML()
    {
        $return = [];
        // css -----------------------------------------------------------------------------------
        $return[] = $this->obterConteudoCSS();
        // abertura da tabela ---------------------------------------------------------------------
        $return[] = "<table>";
        // ---------------------------------------------------------------------
        $return[] = "<THEAD>";
        // mes nome exibir -------------------------------------------------
        if ($this->mesNomeExibir) {
            $mesNome = Datas::getMonthName($this->mesSolicitado, 'g',false,true);
            $mesNome = utf8_decode($mesNome);
            $return[] = "<tr class='nomedomes'>";
            $return[] = "<th colspan='7' class='$this->thTitleClass nome' style='$this->thTitleStyle'>$mesNome</th>";
            $return[] = "</tr>";
        }
        // titulos dos dias exibir ------------------------------------------
        $return[] = "<tr class='diadasemana'>";
        $return[] = "<th>" . Datas::staticGetWeekDayName(0) . "</th>";
        $return[] = "<th>" . Datas::staticGetWeekDayName(1) . "</th>";
        $return[] = "<th>" . Datas::staticGetWeekDayName(2) . "</th>";
        $return[] = "<th>" . Datas::staticGetWeekDayName(3) . "</th>";
        $return[] = "<th>" . Datas::staticGetWeekDayName(4) . "</th>";
        $return[] = "<th>" . Datas::staticGetWeekDayName(5) . "</th>";
        $return[] = "<th>" . Datas::staticGetWeekDayName(6) . "</th>";
        $return[] = "</tr>";
        // ---------------------------------------------------------------------
        $return[] = "</THEAD>";
        // ---------------------------------------------------------------------
        $return[] = "<TBODY>";
        // ---------------------------------------------------------------------
        $ultimoDiaDoMes = Datas::getMonthNumberOfDays($this->anoSolicitado, $this->mesSolicitado);
        // deb($ultimoDiaDoMes,0);
        for ($d = 01; $d <= $ultimoDiaDoMes; $d ++) {

            $ddsNumero = Datas::staticGetWeekDayNumber(Datas::mktime('Ymd', $this->anoSolicitado . $this->mesSolicitado . $d));
            // deb($ddsNumero,0);

            // controle de linha - tr
            if ($d == 01 || $ddsNumero == 0) {
                // abertura de linha - tr
                $return[] = "<tr>";
            }

            // complemento INICIAL dos dias do mes anterior! <<<<<<<<<<!
            if ($d == 1) {
                $return[] = str_repeat("<td>&nbsp;</td>", $ddsNumero);
            }

            $conteudoCelula = $this->conteudoTD;
            if (isset($this->conteudoMatriz[intval($d)])) {
                foreach ($this->conteudoMatriz[intval($d)] as $search => $replace) {
                    $conteudoCelula = str_replace($search, $replace, $conteudoCelula);
                }
            }
            $conteudoCelula = str_replace('{$d}', $d, $conteudoCelula);

            // ##################################################################################>
            // ####################################################################################>
            // ######################################################################################>
            $return[] = "<td>$conteudoCelula</td>"; // #################################################>
                                                    // ######################################################################################>
                                                    // ####################################################################################>
                                                    // ##################################################################################>

            // complemento de dias do mes posterior
            if ($d == $ultimoDiaDoMes) {
                // completa com celulas vazias relativas aos dias do mes seguinte >>>>>>>>>>>!
                $return[] = str_repeat("<td>&nbsp;</td>", (6 - $ddsNumero));
                // ativa o fechamento da linha
                $fecharLinha = true;
            } else {
                $fecharLinha = false;
            }

            // fechamento da linha
            if ($ddsNumero == 6 || $fecharLinha) {
                $return[] = "</tr>";
            }
        }
        // tbody --------------------------------------------------------------------------------------------------------------------------
        $return[] = "</TBODY>";
        // table --------------------------------------------------------------------------------------------------------------------------
        $return[] = "</table>";
        // implode content ----------------------------------------------------------------------------------------------------------------
        $return = implode('', $return);
        // add class style tags -----------------------------------------------------------------------------------------------------------

        /*
         * $return = str_replace("<table", "<table id='$this->tableId' class='mes $this->tableClass' style='$this->tableStyle'", $return);
         * $return = str_replace("<th", "<th class='$this->thClass' style='$this->thStyle'", $return);
         * $return = str_replace("<td", "<td class='dia $this->tdClass' style='$this->tdStyle'", $return);
         */

        { // DEFINICAO DE ATRIBUTOS DAS TAGS ENVOLVIDAS
            {//TABLE
                $this->tableClass .= ' mes ';
                {
                    $tableId = $this->loadTagAttrStructure('id', 'tableId');
                    $tableClass = $this->loadTagAttrStructure('class', 'tableClass');
                    $tableStyle = $this->loadTagAttrStructure('style', 'tableStyle');
                }
                $return = str_replace("<table", "<table $tableId $tableClass $tableStyle", $return);
            }
            {//TH
                {
                    $thClass = $this->loadTagAttrStructure('class', 'thClass');
                    $thStyle = $this->loadTagAttrStructure('style', 'thStyle');
                }
                $return = str_replace("<th", "<th $thClass $thStyle", $return);
            }
            {//TD
                $this->tdClass .= "dia";
                {
                    $tdClass = $this->loadTagAttrStructure('class', 'tdClass');
                    $tdStyle = $this->loadTagAttrStructure('style', 'tdStyle');
                }
                $return = str_replace("<td", "<td $tdClass $tdStyle", $return);
            }
        }

        // return -------------------------------------------------------------------------------------------------------------------------
        return $return;
    }

    private function loadTagAttrStructure($tagAttrName, $classAttr)
    {
        $return = '';
        if ($this->$classAttr != '') {
            $return .= " $tagAttrName='" . $this->$classAttr . "' ";
        }
        return $return;
    }

    public function obterConteudoCSS()
    {
        $css = [];
        if ($this->css != '') {
            $css[] = '<style>';
            $css[] = $this->css;
            $css[] = '</style>';
        }
        return implode(chr(10), $css);
    }
}

?>