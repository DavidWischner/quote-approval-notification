<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailRecipientTransfer;
use Generated\Shared\Transfer\MailTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\QuoteApprovalNotificationConfig getConfig()
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\Business\QuoteApprovalNotificationFacadeInterface getFacade()
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\Business\QuoteApprovalNotificationBusinessFactory getFactory()
 */
abstract class AbstractQuoteApprovalMailTypeBuilderPlugin extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * @var string
     */
    public const MAIL_TYPE = '';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_HTML = '';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_TEXT = '';

    /**
     * @var string
     */
    protected const MAIL_SUBJECT_GLOSSARY_KEY = '';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::MAIL_TYPE;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function build(MailTransfer $mailTransfer): MailTransfer
    {
        $htmlMailTemplateTransfer = $this->createHtmlMailTemplateTransfer();
        $textMailTemplateTransfer = $this->createTextMailTemplateTransfer();
        $mailRecipientTransfer = $this->createMailRecipientTransfer($mailTransfer->getQuoteApprovalNotificationOrFail());

        return $mailTransfer
            ->setSubject(static::MAIL_SUBJECT_GLOSSARY_KEY)
            ->addTemplate($htmlMailTemplateTransfer)
            ->addTemplate($textMailTemplateTransfer)
            ->addRecipient($mailRecipientTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\MailTemplateTransfer
     */
    protected function createHtmlMailTemplateTransfer(): MailTemplateTransfer
    {
        return (new MailTemplateTransfer())
            ->setName(static::MAIL_TEMPLATE_HTML)
            ->setIsHtml(true);
    }

    /**
     * @return \Generated\Shared\Transfer\MailTemplateTransfer
     */
    protected function createTextMailTemplateTransfer(): MailTemplateTransfer
    {
        return (new MailTemplateTransfer())
            ->setName(static::MAIL_TEMPLATE_TEXT)
            ->setIsHtml(false);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer
     *
     * @return \Generated\Shared\Transfer\MailRecipientTransfer
     */
    protected function createMailRecipientTransfer(QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer): MailRecipientTransfer
    {
        $customerTransfer = $this->getRecipientCustomer($quoteApprovalNotificationTransfer);

        return (new MailRecipientTransfer())
            ->setEmail($customerTransfer->getEmailOrFail())
            ->setName(
                sprintf(
                    '%s %s',
                    $customerTransfer->getFirstName(),
                    $customerTransfer->getLastName(),
                )
            );
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    abstract protected function getRecipientCustomer(QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer): CustomerTransfer;
}
