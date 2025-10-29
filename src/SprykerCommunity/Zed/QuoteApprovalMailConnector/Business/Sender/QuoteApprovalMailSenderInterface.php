<?php declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Business\Sender;

interface QuoteApprovalMailSenderInterface {
    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     *
     * @return void
     */
    public function handleCreateEvents(array $eventEntityTransfers): void;

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     *
     * @return void
     */
    public function handleDeleteEvents(array $eventEntityTransfers): void;

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     *
     * @return void
     */
    public function handleUpdateEvents(array $eventEntityTransfers): void;}
