<?php declare(strict_types=1);


namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Communication\Plugin\Event;


use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\QuoteApprovalMailConnectorFacadeInterface getFacade()
 */
class QuoteApprovalUpdateListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * Specification:
     * - Handles quote approval update events.
     * - Sends notification emails to quote owner when a pending quote approval request is updated.
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
        $this->getFacade()->handleQuoteApprovalUpdateEvents($eventEntityTransfers);
    }

}
