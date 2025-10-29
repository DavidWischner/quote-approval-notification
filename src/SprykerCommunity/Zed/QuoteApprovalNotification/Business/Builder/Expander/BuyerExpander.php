<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander;

use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCustomerFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteFacadeInterface;

class BuyerExpander implements QuoteApprovalNotificationExpanderInterface
{
    /**
     * @param \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteFacadeInterface $quoteFacade
     * @param \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCustomerFacadeInterface $customerFacade
     */
    public function __construct(
        protected QuoteApprovalNotificationToQuoteFacadeInterface    $quoteFacade,
        protected QuoteApprovalNotificationToCustomerFacadeInterface $customerFacade,
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

        $customerReference = $this->quoteFacade->findQuoteById($idQuote)?->getQuoteTransfer()?->getCustomerReference();
        if ($customerReference === null) {
            return $notificationTransfer;
        }

        $notificationTransfer->setBuyer($this->customerFacade->findByReference($customerReference));

        return $notificationTransfer;
    }
}
