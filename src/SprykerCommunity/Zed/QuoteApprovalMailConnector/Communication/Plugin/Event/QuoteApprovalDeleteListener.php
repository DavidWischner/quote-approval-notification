<?php declare(strict_types=1);


namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Communication\Plugin\Event;


use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\QuoteApprovalMailConnectorFacadeInterface getFacade()
 */
class QuoteApprovalDeleteListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * Specification:
     * - Handles quote approval delete events.
     * - Sends notification emails to selected approver when a pending quote approval request is deleted.
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
        $this->getFacade()->handleQuoteApprovalDeleteEvents($eventEntityTransfers);
    }

}
