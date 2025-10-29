<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler;

use Generated\Shared\Transfer\EventEntityTransfer;

interface QuoteApprovalEventHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     *
     * @return void
     */
    public function handleEvent(EventEntityTransfer $eventEntityTransfer): void;
}
