<?php
/**
 * Int Field domain object
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */

namespace ezp\Content\Field;
use ezp\Content\AbstractFieldType,
    ezp\Content\Interfaces\ContentFieldType,
    ezp\Content\Interfaces\ContentFieldDefinition;

/**
 * Int Field value object class
 */
class Int extends AbstractFieldType implements ContentFieldType
{
    /**
     * Field type identifier
     * @var string
     */
    const FIELD_IDENTIFIER = 'ezinteger';

    /**
     * @public
     * @var int
     */
    public $value = 0;

    /**
     * @var array Readable of properties on this object
     */
    protected $readableProperties = array(
        'value' => 'data_int',
    );

    /**
     * @var ContentFieldDefinition
     */
    protected $contentTypeFieldType;

    /**
     * @see ContentFieldType
     */
    public function __construct( ContentFieldDefinition $contentTypeFieldType )
    {
        if ( isset( $contentTypeFieldType->default ) )
            $this->value = $contentTypeFieldType->default;

        $this->contentTypeFieldType = $contentTypeFieldType;
        $this->types[] = self::FIELD_IDENTIFIER;
        parent::__construct( $contentTypeFieldType );
    }
}
