<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade;

use Generated\Shared\Transfer\QuoteApprovalRequestTransfer;

interface QuoteApprovalNotificationToQuoteApprovalFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer
     *
     * @return array<int, array<\Generated\Shared\Transfer\QuoteApprovalTransfer>>
     */
    public function getQuoteApprovals(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): array;
}
