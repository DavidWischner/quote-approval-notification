<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\Sender\QuoteApprovalMailSender;
use SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\Sender\QuoteApprovalMailSenderInterface;
use SprykerCommunity\Zed\QuoteApprovalMailConnector\Dependency\Facade\QuoteApprovalMailConnectorToMailFacadeInterface;
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
        return new QuoteApprovalMailSender(
            $this->getConfig(),
            $this->getMailFacade()
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalMailConnector\Dependency\Facade\QuoteApprovalMailConnectorToMailFacadeInterface
     */
    public function getMailFacade(): QuoteApprovalMailConnectorToMailFacadeInterface
    {
        return $this->getProvidedDependency(QuoteApprovalMailConnectorDependencyProvider::FACADE_MAIL);
    }
}
