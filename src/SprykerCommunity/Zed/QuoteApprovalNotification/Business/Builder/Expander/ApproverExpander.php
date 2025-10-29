<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander;

use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCompanyUserFacadeInterface;

class ApproverExpander implements QuoteApprovalNotificationExpanderInterface
{
    /**
     * @param \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCompanyUserFacadeInterface $companyUserFacade
     */
    public function __construct(
        protected QuoteApprovalNotificationToCompanyUserFacadeInterface $companyUserFacade,
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
        if ($quoteApprovalEventTransfer->getIdCompanyUser() === null) {
            return $notificationTransfer;
        }

        $companyUserTransfer = $this->companyUserFacade->getCompanyUserById(
            $quoteApprovalEventTransfer->getIdCompanyUser(),
        );

        return $notificationTransfer->setRequestedApprover($companyUserTransfer);
    }
}
