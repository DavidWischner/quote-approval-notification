<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler;

use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail\QuoteApprovalApprovedMailTypeBuilderPlugin;
use SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail\QuoteApprovalDeclinedMailTypeBuilderPlugin;
use SprykerCommunity\Zed\QuoteApprovalNotification\QuoteApprovalNotificationConfig;

class QuoteApprovalUpdateEventHandler extends AbstractQuoteApprovalEventHandler
{
    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer
     *
     * @return string
     */
    protected function getMailType(QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer): string
    {
        $status = $quoteApprovalNotificationTransfer->getQuoteApprovalOrFail()->getStatusOrFail();

        return match ($status) {
            QuoteApprovalNotificationConfig::STATUS_APPROVED => QuoteApprovalApprovedMailTypeBuilderPlugin::MAIL_TYPE,
            QuoteApprovalNotificationConfig::STATUS_DECLINED => QuoteApprovalDeclinedMailTypeBuilderPlugin::MAIL_TYPE,
            default => '',
        };
    }
}
