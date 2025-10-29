<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\Sender;

use SprykerCommunity\Zed\QuoteApprovalMailConnector\Dependency\Facade\QuoteApprovalMailConnectorToMailFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalMailConnector\QuoteApprovalMailConnectorConfig;

/**
 * Handles sending of quote approval related mails.
 * TODO IMPLEMENTATION
 */
class QuoteApprovalMailSender implements QuoteApprovalMailSenderInterface
{
    /**
     * @param \SprykerCommunity\Zed\QuoteApprovalMailConnector\QuoteApprovalMailConnectorConfig $config
     * @param \SprykerCommunity\Zed\QuoteApprovalMailConnector\Dependency\Facade\QuoteApprovalMailConnectorToMailFacadeInterface $mailFacade
     */
    public function __construct(
        protected QuoteApprovalMailConnectorConfig $config,
        protected QuoteApprovalMailConnectorToMailFacadeInterface $mailFacade,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function handleCreateEvents(array $eventEntityTransfers): void
    {
        foreach ($eventEntityTransfers as $eventTransfer) {
            // TODO
            // get relevant data from event transfer
            // find approver data
            // send mail to approver
        }
    }

    /**
     * @inheritDoc
     */
    public function handleUpdateEvents(array $eventEntityTransfers): void
    {
        foreach ($eventEntityTransfers as $eventTransfer) {
            // TODO
            // get relevant data from event transfer
            // check if status was changed to approved or declined
            // find quote owner data
            // send mail (approved or declined) to quote owner
        }
    }

    /**
     * @inheritDoc
     */
    public function handleDeleteEvents(array $eventEntityTransfers): void
    {
        foreach ($eventEntityTransfers as $eventEntityTransfer) {
            // TODO
            // get relevant data from event transfer
            // find quote approver data
            // send mail to approver about cancellation of approval request

        }
    }
}
