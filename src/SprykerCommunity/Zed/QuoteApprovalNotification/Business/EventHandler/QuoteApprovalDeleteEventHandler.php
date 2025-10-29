<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail\QuoteApprovalCancelledMailTypeBuilderPlugin;

class QuoteApprovalDeleteEventHandler extends AbstractQuoteApprovalEventHandler
{
    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer
     *
     * @return string
     */
    protected function getMailType(QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer): string
    {
        return QuoteApprovalCancelledMailTypeBuilderPlugin::MAIL_TYPE;
    }
}
