<?php

namespace BDM\BdmKesearchindexerFlux\Helper;


use FluidTYPO3\Flux\Core;
use FluidTYPO3\Flux\Helper\ContentTypeBuilder;
use FluidTYPO3\Flux\Utility\ExtensionNamingUtility;

class FluxHelper
{
    public static function getFluxContentTypes(){
        $fluxContentTypes = [];
        $fluidContentTypes = Core::getQueuedContentTypeRegistrations();
        //$contentTypeBuilder = new ContentTypeBuilder();
        foreach ($fluidContentTypes as $queuedRegistration) {
            /** @var ProviderInterface $provider */
            list ($providerExtensionName, $templatePathAndFilename) = $queuedRegistration;
           /* $provider = $contentTypeBuilder->configureContentTypeFromTemplateFile(
                $providerExtensionName,
                $templatePathAndFilename
            );*/
            // Determine which plugin name and controller action to emulate with this CType, base on file name.
            $controllerExtensionName = $providerExtensionName;
            $emulatedPluginName = ucfirst(pathinfo($templatePathAndFilename, PATHINFO_FILENAME));
            $extensionSignature = str_replace('_', '', ExtensionNamingUtility::getExtensionKey($controllerExtensionName));
            $fullContentType = $extensionSignature . '_' . strtolower($emulatedPluginName);
            $fluxContentTypes[] = $fullContentType;
        }
        return $fluxContentTypes;
    }
}
