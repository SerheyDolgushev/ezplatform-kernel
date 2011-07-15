<?php
/**
 * File containing the Criterion class
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 *
 */

namespace ezp\Persistence\Content;

/**
 */
abstract class Criterion
{
    /**
     */
    public $children = array();

    /**
     * The operator used by the Criterion
     * @var string
     */
    public $operator;
}
?>
