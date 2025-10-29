<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Event;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\Business\QuoteApprovalNotificationFacadeInterface getFacade()
 */
class QuoteApprovalDeleteListenerPlugin extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * {@inheritDoc}
     * - Handles quote approval delete event.
     * - Sends notification email to selected approver when a pending quote approval request is deleted.
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param string $eventName
     *
     * @return void
     *@api
     *
     */
    public function handle(TransferInterface $transfer, $eventName): void
    {
        // phpcs:ignore SlevomatCodingStandard.Commenting.InlineDocCommentDeclaration.MissingVariable
        /** @var \Generated\Shared\Transfer\EventEntityTransfer $transfer */
        $this->getFacade()->handleQuoteApprovalDeleteEvent($transfer);
    }
}
