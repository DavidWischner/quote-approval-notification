<?php declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\Sender;

use Spryker\Zed\Mail\Business\MailFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalMailConnector\QuoteApprovalMailConnectorConfig;

/**
 * Handles sending of quote approval related mails.
 * TODO IMPLEMENTATION
 */
class QuoteApprovalMailSender implements QuoteApprovalMailSenderInterface
{
    public function __construct(protected MailFacadeInterface $mailFacade, protected QuoteApprovalMailConnectorConfig $config)
    {
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
