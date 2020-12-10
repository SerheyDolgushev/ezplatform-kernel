<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace eZ\Publish\Core\QueryType\BuiltIn\SortSpec\SortClauseParser;

use eZ\Publish\API\Repository\Values\Content\Query\SortClause;
use eZ\Publish\API\Repository\Values\Content\Query\SortClause\CustomField;
use eZ\Publish\Core\QueryType\BuiltIn\SortSpec\SortClauseParserInterface;
use eZ\Publish\Core\QueryType\BuiltIn\SortSpec\SortSpecParserInterface;
use eZ\Publish\Core\QueryType\BuiltIn\SortSpec\Token;

/**
 * Parser for \eZ\Publish\API\Repository\Values\Content\Query\SortClause\RawField sort clause.
 *
 * Example of correct input:
 *
 *      custom_field custom_field_name ASC
 */
final class CustomFieldSortClauseParser implements SortClauseParserInterface
{
    private const SUPPORTED_CLAUSE_NAME = 'custom_field';

    public function parse(SortSpecParserInterface $parser, string $name): SortClause
    {
        $args = [];
        $args[] = $parser->match(Token::TYPE_ID)->getValue();
        $args[] = $parser->parseSortDirection();

        return new CustomField(...$args);
    }

    public function supports(string $name): bool
    {
        return $name === self::SUPPORTED_CLAUSE_NAME;
    }
}
