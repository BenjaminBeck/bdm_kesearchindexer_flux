<?php
if ( !defined( 'TYPO3_MODE' ) ) {
	die ( 'Access denied.' );
}

call_user_func(
	function ($extKey) {

	    if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('ke_search')) return;

		global $GLOBALS;
		$regObjName                                                                           = 'BDM\\BdmKesearchindexerFlux\\Hooks\\KeSearch\\RegisterIndexerFluidcontent';
		$regObj                                                                               = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance( $regObjName );
		$GLOBALS['T3_VAR']['getUserObj'][ $regObjName ]                                       = $regObj;
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] = $regObjName;
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][]                = $regObjName;




	},
	$_EXTKEY
);
