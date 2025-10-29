<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler;

use Generated\Shared\Transfer\EventEntityTransfer;
use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\QuoteApprovalNotificationBuilderInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mailer\QuoteApprovalMailerInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mapper\QuoteApprovalEventMapperInterface;

abstract class AbstractQuoteApprovalEventHandler implements QuoteApprovalEventHandlerInterface
{
    public function __construct(
        protected QuoteApprovalEventMapperInterface $quoteApprovalEventMapper,
        protected QuoteApprovalNotificationBuilderInterface $quoteApprovalNotificationBuilder,
        protected QuoteApprovalMailerInterface $quoteApprovalMailer,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     *
     * @return void
     */
    public function handleEvent(EventEntityTransfer $eventEntityTransfer): void
    {
        $quoteApprovalEventTransfer = $this->quoteApprovalEventMapper->mapEventEntityTransferToQuoteApprovalEventTransfer(
            $eventEntityTransfer,
            new QuoteApprovalEventTransfer(),
        );

        $quoteApprovalNotificationTransfer = $this->quoteApprovalNotificationBuilder
            ->createQuoteApprovalNotificationTransferFromQuoteApprovalEventTransfer($quoteApprovalEventTransfer);

        $this->quoteApprovalMailer->sendMail(
            $quoteApprovalNotificationTransfer,
            $this->getMailType($quoteApprovalNotificationTransfer),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer
     *
     * @return string
     */
    abstract protected function getMailType(QuoteApprovalNotificationTransfer $quoteApprovalNotificationTransfer): string;
}
