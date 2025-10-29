<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mailer;

use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;

interface QuoteApprovalMailerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer
     * @param string $recipientEmail
     * @param string $recipientName
     * @param string $emailType
     *
     * @return void
     */
    public function sendMail(
        QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer,
//        string $recipientEmail,
//        string $recipientName,
        string $emailType
    ): void;
}
