<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Publish\Core\Persistence\Cache\Tests;

use eZ\Publish\SPI\Persistence\Content\UrlAlias;
use eZ\Publish\SPI\Persistence\Content\UrlAlias\Handler as SPIUrlAliasHandler;

/**
 * Test case for Persistence\Cache\UrlAliasHandler.
 */
class UrlAliasHandlerTest extends AbstractInMemoryCacheHandlerTest
{
    public function getHandlerMethodName(): string
    {
        return 'urlAliasHandler';
    }

    public function getHandlerClassName(): string
    {
        return SPIUrlAliasHandler::class;
    }

    public function providerForUnCachedMethods(): array
    {
        // string $method, array $arguments, array? $tags, array? $key, mixed? $returnValue
        return [
            ['publishUrlAliasForLocation', [44, 2, 'name', 'eng-GB', true, false], ['urlAlias-location-44', 'urlAlias-location-path-44', 'urlAlias-notFound']],
            ['createCustomUrlAlias', [44, '1/2/44', true, null, false], ['urlAlias-location-44', 'urlAlias-location-path-44', 'urlAlias-notFound', 'urlAlias-5'], null, new UrlAlias(['id' => 5])],
            ['createGlobalUrlAlias', ['something', '1/2/44', true, null, false], ['urlAlias-notFound']],
            ['createGlobalUrlAlias', ['something', '1/2/44', true, 'eng-GB', false], ['urlAlias-notFound']],
            ['listGlobalURLAliases', ['eng-GB', 10, 50]],
            ['removeURLAliases', [[new UrlAlias(['id' => 5, 'type' => UrlAlias::LOCATION, 'isCustom' => true, 'destination' => 21])]], ['urlAlias-5', 'urlAlias-location-21', 'urlAlias-location-path-21', 'urlAlias-custom-21']],
            ['locationMoved', [21, 45, 12], ['urlAlias-location-21', 'urlAlias-location-path-21']],
            ['locationCopied', [21, 33, 12], ['urlAlias-location-21', 'urlAlias-location-33']],
            ['locationDeleted', [21], ['urlAlias-location-21', 'urlAlias-location-path-21'], null, []],
            ['locationSwapped', [21, 2, 33, 45], ['urlAlias-location-21', 'urlAlias-location-path-21', 'urlAlias-location-33', 'urlAlias-location-path-33']],
            ['translationRemoved', [[21, 33], 'eng-GB'], ['urlAlias-location-21', 'urlAlias-location-path-21', 'urlAlias-location-33', 'urlAlias-location-path-33']],
            ['archiveUrlAliasesForDeletedTranslations', [21, 33, ['eng-GB']], ['urlAlias-location-21', 'urlAlias-location-path-21']],
        ];
    }

    public function providerForCachedLoadMethods(): array
    {
        $object = new UrlAlias(['id' => 5]);

        // string $method, array $arguments, string $key, mixed? $data
        return [
            ['listURLAliasesForLocation', [5], 'ez-urlAlias-location-list-5', [$object]],
            ['listURLAliasesForLocation', [5, true], 'ez-urlAlias-location-list-5-custom', [$object]],
            ['lookup', ['/Home'], 'ez-urlAlias-url-_SHome', $object],
            ['loadUrlAlias', [5], 'ez-urlAlias-5', $object],
        ];
    }
}
