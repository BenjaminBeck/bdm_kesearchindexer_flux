<?php

namespace BDM\BdmKesearchindexerFlux\KeSearchIndexer;

use BDM\BdmKesearchindexerFlux\Helper\FluxHelper;
use FluidTYPO3\Flux\Form;
use FluidTYPO3\Flux\Form\Container\Sheet;
use FluidTYPO3\Flux\Form\FieldInterface;
use FluidTYPO3\Flux\Provider\ProviderInterface;
use FluidTYPO3\Flux\Provider\ProviderResolver;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

require_once ( ExtensionManagementUtility::extPath( 'ke_search' ).'Classes/indexer/types/class.tx_kesearch_indexer_types_tt_content.php');

class TypesFluidcontent extends \tx_kesearch_indexer_types_tt_content{

    private function getIndexableFromFluxForm(ProviderInterface $provider, Form $form, array $ttContentRow){
        $indexable = '';
        $flexFormValues = $provider->getFlexFormValues($ttContentRow);
        /** @var Sheet $sheets */
        $sheets = $form->getSheets();
        foreach($sheets as $sheet){
            $fields = $sheet->getFields();
            /** @var FieldInterface $field */
            foreach($fields as $field){
                if( null !== $field->getVariable('allowKeSearchIndex') ){
                    $indexable .= $flexFormValues[$field->getName()]."\r\n";
                }
            }
        }
        return $indexable;
    }

	public function getContentFromContentElement($ttContentRow) {
	    /** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        /** @var ProviderResolver $fluxProviderResolver */
        $fluxProviderResolver = $objectManager->get(ProviderResolver::class);
        $fluxProvider = $fluxProviderResolver->resolvePrimaryConfigurationProvider('tt_content', 'pi_flexform', $ttContentRow);
        if(!is_object($fluxProvider)) return '';
        $form = $fluxProvider->getForm($ttContentRow);
        if(!is_object($form)) return '';
        // @TODO index pdf files linked with FAL ..
        $content = $this->getIndexableFromFluxForm($fluxProvider, $form, $ttContentRow);
		$content .= parent::getContentFromContentElement($ttContentRow);
		return $content;
	}

	/**
	 * Constructor of this object
	 */
	public function __construct($pObj) {
	    $fluidContentTypes = FluxHelper::getFluxContentTypes();
        $pObj->indexerConfig['contenttypes'] = implode(',',$fluidContentTypes);
		parent::__construct($pObj);
	}
}
