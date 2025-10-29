<?php declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Mail\Business\MailFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\Sender\QuoteApprovalMailSender;
use SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\Sender\QuoteApprovalMailSenderInterface;
use SprykerCommunity\Zed\QuoteApprovalMailConnector\QuoteApprovalMailConnectorDependencyProvider;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalMailConnector\QuoteApprovalMailConnectorConfig getConfig()
 */
class QuoteApprovalMailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\Sender\QuoteApprovalMailSenderInterface
     */
    public function createQuoteApprovalMailSender(): QuoteApprovalMailSenderInterface
    {
        return new QuoteApprovalMailSender($this->getMailFacade(), $this->getConfig());
    }

    /**
     * @return \Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    public function getMailFacade(): MailFacadeInterface
    {
        return $this->getProvidedDependency(QuoteApprovalMailConnectorDependencyProvider::FACADE_MAIL);
    }
}
