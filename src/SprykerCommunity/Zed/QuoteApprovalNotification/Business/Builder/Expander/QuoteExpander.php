<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander;

use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteFacadeInterface;

class QuoteExpander implements QuoteApprovalNotificationExpanderInterface
{
    /**
     * @param \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteFacadeInterface $quoteFacade
     */
    public function __construct(
        protected QuoteApprovalNotificationToQuoteFacadeInterface $quoteFacade,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expand(
        QuoteApprovalNotificationTransfer $notificationTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer
    ): QuoteApprovalNotificationTransfer {
        $idQuote = $quoteApprovalEventTransfer->getIdQuote();

        if ($idQuote === null) {
            return $notificationTransfer;
        }

        $quoteResponseTransfer = $this->quoteFacade->findQuoteById($idQuote);

        if ($quoteResponseTransfer->getIsSuccessful() === false) {
            return $notificationTransfer;
        }

        return $notificationTransfer->setQuote($quoteResponseTransfer->getQuoteTransfer());
    }
}
