<?php declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\QuoteApprovalMailConnectorBusinessFactory getFactory()
 */
class QuoteApprovalMailConnectorFacade extends AbstractFacade implements QuoteApprovalMailConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     * @api
     * @param array $eventTransfers
     *
     * @return void
     */
    public function handleQuoteApprovalCreateEvents(array $eventTransfers): void
    {
        $this->getFactory()->createQuoteApprovalMailSender()->handleCreateEvents($eventTransfers);
    }

    /**
     * {@inheritDoc}
     * @api
     * @param array $eventTransfers
     * @return void
     */
    public function handleQuoteApprovalUpdateEvents(array $eventTransfers): void
    {
        $this->getFactory()->createQuoteApprovalMailSender()->handleUpdateEvents($eventTransfers);
    }

    /**
     * {@inheritDoc}
     * @api
     * @param array $eventTransfers
     *
     * @return void
     */
    public function handleQuoteApprovalDeleteEvents(array $eventEntityTransfers): void
    {
        $this->getFactory()->createQuoteApprovalMailSender()->handleDeleteEvents($eventEntityTransfers);
    }
}
