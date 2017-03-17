<?php

if ( !defined( 'TYPO3_MODE' ) ) {
	die ( 'Access denied.' );
}

call_user_func(
	function () {

	    if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('ke_search')) return;

        \BDM\BdmKesearchindexerFlux\Hooks\TCA\Override::main();

	}
);





