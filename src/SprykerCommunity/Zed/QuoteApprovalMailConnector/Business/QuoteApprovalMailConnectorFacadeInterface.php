<?php declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Business;

interface QuoteApprovalMailConnectorFacadeInterface
{
    /**
     *  Specification:
     *  - Handles quote approval creation events.
     *  - Sends notification emails to selected quote approver when a new quote approval is created.
     *
     * @api
     * @param array $eventTransfers
     *
     * @return void
     */
    public function handleQuoteApprovalCreateEvents(array $eventTransfers): void;

    /**
     * Specification:
     * - Handles quote approval update events.
     * - Sends notification emails to quote owners based on the updated approval status.
     *
     * @api
     * @param array $eventTransfers
     *
     * @return void
     */
    public function handleQuoteApprovalUpdateEvents(array $eventTransfers): void;

    /**
     * Specification:
     * - Handles quote approval deletion events.
     * - Sends notification emails to quote owners when a quote approval is deleted.
     *
     * @param array $eventEntityTransfers
     *
     * @return void
     *
     * @api
     */
    public function handleQuoteApprovalDeleteEvents(array $eventEntityTransfers): void;
}
