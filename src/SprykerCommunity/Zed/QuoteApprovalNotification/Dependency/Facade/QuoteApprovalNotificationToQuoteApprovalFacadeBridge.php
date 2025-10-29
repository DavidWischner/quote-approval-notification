<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade;

use Generated\Shared\Transfer\QuoteApprovalRequestTransfer;

class QuoteApprovalNotificationToQuoteApprovalFacadeBridge implements QuoteApprovalNotificationToQuoteApprovalFacadeInterface
{
    /**
     * @var \Spryker\Zed\QuoteApproval\Business\QuoteApprovalFacadeInterface
     */
    protected $quoteApprovalFacade;

    /**
     * @param \Spryker\Zed\QuoteApproval\Business\QuoteApprovalFacadeInterface $quoteApprovalFacade
     */
    public function __construct($quoteApprovalFacade)
    {
        $this->quoteApprovalFacade = $quoteApprovalFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer
     *
     * @return array<int, array<\Generated\Shared\Transfer\QuoteApprovalTransfer>>
     */
    public function getQuoteApprovals(QuoteApprovalRequestTransfer $quoteApprovalRequestTransfer): array
    {
        return $this->quoteApprovalFacade->getQuoteApprovals($quoteApprovalRequestTransfer);
    }
}
