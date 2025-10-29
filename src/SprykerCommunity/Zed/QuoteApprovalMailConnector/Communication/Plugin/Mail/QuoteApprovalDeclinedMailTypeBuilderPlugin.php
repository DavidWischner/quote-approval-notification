<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Communication\Plugin\Mail;

use Generated\Shared\Transfer\MailRecipientTransfer;
use Generated\Shared\Transfer\MailTemplateTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

/**
 * @method \Meesenburg\Zed\Customer\CustomerConfig getConfig()
 * @method \Meesenburg\Zed\Customer\Business\CustomerFacadeInterface getFacade()
 * @method \Meesenburg\Zed\Customer\Communication\CustomerCommunicationFactory getFactory()
 */
class QuoteApprovalDeclinedMailTypeBuilderPlugin extends AbstractPlugin implements MailTypeBuilderPluginInterface
{
    /**
     * @var string
     */
    public const MAIL_TYPE = 'QuoteApprovalDeclinedMailType';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_HTML = 'customer/mail/quote_approval_declined_mail.html.twig';

    /**
     * @var string
     */
    protected const MAIL_TEMPLATE_TEXT = 'customer/mail/quote_approval_declined_mail.text.twig';

    /**
     * @var string
     */
    protected const MAIL_SUBJECT_GLOSSARY_KEY = 'mail.quote.approval.declined.subject';

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
        $mailRecipientTransfer = $this->createMailRecipientTransfer();

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
     * @return \Generated\Shared\Transfer\MailRecipientTransfer
     */
    protected function createMailRecipientTransfer(): MailRecipientTransfer
    {
        return (new MailRecipientTransfer())
            ->setEmail('me@acme.com')
            ->setName('ac me');
    }
}
