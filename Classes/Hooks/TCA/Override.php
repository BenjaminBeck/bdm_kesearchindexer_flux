<?php

namespace BDM\BdmKesearchindexerFlux\Hooks\TCA;


use BDM\BdmKesearchindexerFlux\Helper\FluxHelper;

class Override
{
    public static function main(){

        foreach($GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns'] as $key => $column){
            if(isset($column['displayCond'])){
                $displayCond = $column['displayCond'];
                $displayCond = str_replace('tt_content','tt_content,fluidcontent',$displayCond);
                $GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns'][$key]['displayCond'] = $displayCond;
            }
        }



        // this does not work atm .. maybe in the future:
        $fluidContentTypes = FluxHelper::getFluxContentTypes();
        $GLOBALS['TCA']['tx_kesearch_indexerconfig']['types']['fluidcontent']['columnsOverrides'] = array(
          'contenttypes' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ke_search/locallang_db.xml:tx_kesearch_indexerconfig.contenttypes',
            'displayCond' => 'FIELD:type:IN:page,tt_content,fluidcontent',
            'config' => array(
                'type' => 'text',
                'cols' => 48,
                'rows' => 10,
                'eval' => 'trim',
                'default' => implode(',',$fluidContentTypes)
            )
        )
        );

        // until then we just hide it:
        $GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['contenttypes']['displayCond'] = str_replace(
            'tt_content,fluidcontent',
            'tt_content',
            $GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['contenttypes']['displayCond']
        );



    }
}
