<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\QuoteApprovalNotificationConfig getConfig()
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\Business\QuoteApprovalNotificationFacadeInterface getFacade()
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\Business\QuoteApprovalNotificationBusinessFactory getFactory()
 */
class QuoteApprovalCancelledMailTypeBuilderPlugin extends AbstractQuoteApprovalMailTypeBuilderPlugin
{
    /**
     * @var string
     */
    public const MAIL_TYPE = 'QuoteApprovalCancelledMailType';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_HTML = 'QuoteApprovalNotification/mail/quote_approval_cancelled_mail.html.twig';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_TEXT = 'QuoteApprovalNotification/mail/quote_approval_cancelled_mail.text.twig';

    /**
     * @var string
     */
    protected const MAIL_SUBJECT_GLOSSARY_KEY = 'mail.quote.approval.cancelled.subject';

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function getRecipientCustomer(QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer): CustomerTransfer
    {
        return $quoteApprovalNotificationTransfer->getRequestedApproverOrFail()->getCustomerOrFail();
    }
}
