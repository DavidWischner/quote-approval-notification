<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business;

use Generated\Shared\Transfer\EventEntityTransfer;
use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;

interface QuoteApprovalNotificationFacadeInterface
{
    /**
     * Specification:
     * - Handles quote approval create event.
     * - Maps event entity to quote approval event transfer.
     * - Expands quote approval event with approval data.
     * - Builds notification transfer with all required data.
     * - Sends email to requested approver.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     *
     * @return void
     */
    public function handleQuoteApprovalCreateEvent(EventEntityTransfer $eventEntityTransfer): void;

    /**
     * Specification:
     * - Handles quote approval update event.
     * - Maps event entity to quote approval event transfer.
     * - Expands quote approval event with approval data.
     * - Builds notification transfer with all required data.
     * - Sends email to buyer (approved or declined).
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     *
     * @return void
     */
    public function handleQuoteApprovalUpdateEvent(EventEntityTransfer $eventEntityTransfer): void;

    /**
     * Specification:
     * - Handles quote approval delete event.
     * - Maps event entity to quote approval event transfer.
     * - Expands quote approval event with approval data.
     * - Builds notification transfer with all required data.
     * - Sends email to requested approver (cancelled).
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     *
     * @return void
     */
    public function handleQuoteApprovalDeleteEvent(EventEntityTransfer $eventEntityTransfer): void;

    /**
     * Specification:
     * - Expands notification transfer with approver data.
     * - Loads company user by id from quote approval.
     * - Sets requested approver on notification transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expandNotificationWithApprover(
        QuoteApprovalNotificationTransfer $notificationTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer
    ): QuoteApprovalNotificationTransfer;

    /**
     * Specification:
     * - Expands notification transfer with buyer data.
     * - Loads quote by id and extracts customer.
     * - Sets buyer on notification transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expandNotificationWithBuyer(
        QuoteApprovalNotificationTransfer $notificationTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer
    ): QuoteApprovalNotificationTransfer;

    /**
     * Specification:
     * - Expands notification transfer with link.
     * - Generates URL for the specific quote approval notification.
     * - Sets link on notification transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expandNotificationWithLink(
        QuoteApprovalNotificationTransfer $notificationTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer
    ): QuoteApprovalNotificationTransfer;

    /**
     * Specification:
     * - Expands notification transfer with quote data.
     * - Loads complete quote by id.
     * - Sets quote on notification transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expandNotificationWithQuote(
        QuoteApprovalNotificationTransfer $notificationTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer
    ): QuoteApprovalNotificationTransfer;

    /**
     * Specification:
     * - Expands notification transfer with quote approval data.
     * - Loads complete quote approval by id.
     * - Sets quote approval on notification transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expandNotificationWithQuoteApproval(
        QuoteApprovalNotificationTransfer $notificationTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer
    ): QuoteApprovalNotificationTransfer;
}
