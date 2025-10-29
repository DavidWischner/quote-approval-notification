<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mailer;

use Generated\Shared\Transfer\MailRecipientTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToMailFacadeInterface;

class QuoteApprovalMailer implements QuoteApprovalMailerInterface
{
    /**
     * @param \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToMailFacadeInterface $mailFacade
     */
    public function __construct(
        protected QuoteApprovalNotificationToMailFacadeInterface $mailFacade,
    ) {
    }

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
        string $emailType
    ): void {
        $mailTransfer = (new MailTransfer())
            ->setQuoteApprovalNotification($quoteApprovalNotificationTransfer)
            ->setType($emailType);

        $this->mailFacade->handleMail($mailTransfer);
    }
}
