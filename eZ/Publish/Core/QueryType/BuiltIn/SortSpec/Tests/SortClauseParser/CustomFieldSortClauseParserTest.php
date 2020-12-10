<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace eZ\Publish\Core\QueryType\BuiltIn\SortSpec\Tests\SortClauseParser;

use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\SortClause\CustomField;
use eZ\Publish\Core\QueryType\BuiltIn\SortSpec\SortClauseParser\CustomFieldSortClauseParser;
use eZ\Publish\Core\QueryType\BuiltIn\SortSpec\SortSpecParserInterface;
use eZ\Publish\Core\QueryType\BuiltIn\SortSpec\Token;
use PHPUnit\Framework\TestCase;

final class CustomFieldSortClauseParserTest extends TestCase
{
    private const EXAMPLE_SEARCH_INDEX_FIELD = 'custom_field_s';

    /** @var \eZ\Publish\Core\QueryType\BuiltIn\SortSpec\SortClauseParser\CustomFieldSortClauseParser */
    private $parser;

    protected function setUp(): void
    {
        $this->parser = new CustomFieldSortClauseParser();
    }

    public function testParse(): void
    {
        $parser = $this->createMock(SortSpecParserInterface::class);
        $parser
            ->method('match')
            ->with(Token::TYPE_ID)
            ->willReturn(
                new Token(
                    Token::TYPE_ID,
                    self::EXAMPLE_SEARCH_INDEX_FIELD
                ),
            );

        $parser->method('parseSortDirection')->willReturn(Query::SORT_ASC);

        $this->assertEquals(
            new CustomField(
                self::EXAMPLE_SEARCH_INDEX_FIELD,
                Query::SORT_ASC
            ),
            $this->parser->parse($parser, 'custom_field')
        );
    }

    public function testSupports(): void
    {
        $this->assertTrue($this->parser->supports('custom_field'));
    }
}
