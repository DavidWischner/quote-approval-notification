<?php declare(strict_types=1);


namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Communication\Plugin\Event;


use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\QuoteApprovalMailConnectorFacadeInterface getFacade()
 */
class QuoteApprovalCreateListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * Specification:
     * - Handles quote approval create events.
     * - Sends notification emails to selected quote approver when a new quote approval is created.
     *
     * {@inheritDoc}
     * @param array $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     * @api
     *
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $this->getFacade()->handleQuoteApprovalCreateEvents($eventEntityTransfers);
    }

}
