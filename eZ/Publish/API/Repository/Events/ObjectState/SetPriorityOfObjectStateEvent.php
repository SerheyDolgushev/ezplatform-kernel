<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace eZ\Publish\API\Repository\Events\ObjectState;

use eZ\Publish\API\Repository\Values\ObjectState\ObjectState;
use eZ\Publish\SPI\Repository\Event\AfterEvent;

final class SetPriorityOfObjectStateEvent extends AfterEvent
{
    /** @var \eZ\Publish\API\Repository\Values\ObjectState\ObjectState */
    private $objectState;

    private $priority;

    public function __construct(
        ObjectState $objectState,
        $priority
    ) {
        $this->objectState = $objectState;
        $this->priority = $priority;
    }

    public function getObjectState(): ObjectState
    {
        return $this->objectState;
    }

    public function getPriority()
    {
        return $this->priority;
    }
}
