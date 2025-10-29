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
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\Business\QuoteApprovalNotificationBusinessFactory getFactory()
 */
class QuoteApprovalNotificationFacade extends AbstractFacade implements QuoteApprovalNotificationFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     *
     * @return void
     *
     * @SuppressWarnings("FacadeArgumentsNotAllowedUseEntityTransferRule") must be suppressed here, as the rule is not specific enough and the EventEntityTransfer is incorrectly interpreted as a database entity transfer.
     *
     * @api
     */
    public function handleQuoteApprovalCreateEvent(EventEntityTransfer $eventEntityTransfer): void
    {
        $this->getFactory()->createQuoteApprovalCreateEventHandler()->handleEvent($eventEntityTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     *
     * @return void
     *
     * @SuppressWarnings("FacadeArgumentsNotAllowedUseEntityTransferRule") must be suppressed here, as the rule is not specific enough and the EventEntityTransfer is incorrectly interpreted as a database entity transfer.
     *
     * @api
     */
    public function handleQuoteApprovalUpdateEvent(EventEntityTransfer $eventEntityTransfer): void
    {
        $this->getFactory()->createQuoteApprovalUpdateEventHandler()->handleEvent($eventEntityTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     *
     * @return void
     *
     * @SuppressWarnings("FacadeArgumentsNotAllowedUseEntityTransferRule") must be suppressed here, as the rule is not specific enough and the EventEntityTransfer is incorrectly interpreted as a database entity transfer.
     *
     * @api
     */
    public function handleQuoteApprovalDeleteEvent(EventEntityTransfer $eventEntityTransfer): void
    {
        $this->getFactory()->createQuoteApprovalDeleteEventHandler()->handleEvent($eventEntityTransfer);
    }

    /**
     * {@inheritDoc}
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
    ): QuoteApprovalNotificationTransfer {
        return $this->getFactory()
            ->createApproverExpander()
            ->expand($notificationTransfer, $quoteApprovalEventTransfer);
    }

    /**
     * {@inheritDoc}
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
    ): QuoteApprovalNotificationTransfer {
        return $this->getFactory()
            ->createBuyerExpander()
            ->expand($notificationTransfer, $quoteApprovalEventTransfer);
    }

    /**
     * {@inheritDoc}
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
    ): QuoteApprovalNotificationTransfer {
        return $this->getFactory()
            ->createLinkExpander()
            ->expand($notificationTransfer, $quoteApprovalEventTransfer);
    }

    /**
     * {@inheritDoc}
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
    ): QuoteApprovalNotificationTransfer {
        return $this->getFactory()
            ->createQuoteExpander()
            ->expand($notificationTransfer, $quoteApprovalEventTransfer);
    }

    /**
     * {@inheritDoc}
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
    ): QuoteApprovalNotificationTransfer {
        return $this->getFactory()
            ->createQuoteApprovalExpander()
            ->expand($notificationTransfer, $quoteApprovalEventTransfer);
    }
}
