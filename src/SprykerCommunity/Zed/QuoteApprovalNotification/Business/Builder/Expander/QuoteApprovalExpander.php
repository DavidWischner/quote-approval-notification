<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander;

use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use Generated\Shared\Transfer\QuoteApprovalRequestTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteApprovalFacadeInterface;

class QuoteApprovalExpander implements QuoteApprovalNotificationExpanderInterface
{
    /**
     * @param \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteApprovalFacadeInterface $quoteApprovalFacade
     */
    public function __construct(
        protected QuoteApprovalNotificationToQuoteApprovalFacadeInterface $quoteApprovalFacade,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expand(QuoteApprovalNotificationTransfer $notificationTransfer, QuoteApprovalEventTransfer $quoteApprovalEventTransfer): QuoteApprovalNotificationTransfer
    {
        $quoteApprovalRequestTransfer = (new QuoteApprovalRequestTransfer())
            ->addQuoteId($quoteApprovalEventTransfer->getIdQuote());

        $quoteApprovalsByQuote = $this->quoteApprovalFacade->getQuoteApprovals($quoteApprovalRequestTransfer);

        foreach ($quoteApprovalsByQuote as $quoteApprovalList) {
            foreach ($quoteApprovalList as $quoteApproval) {
                if ($quoteApproval->getIdQuoteApproval() === $quoteApprovalEventTransfer->getIdQuoteApproval()) {
                    return $notificationTransfer->setQuoteApproval($quoteApproval);
                }
            }
        }

        return $notificationTransfer;
    }
}
