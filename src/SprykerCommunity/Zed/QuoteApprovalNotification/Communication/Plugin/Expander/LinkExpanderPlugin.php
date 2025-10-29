<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Expander;

use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\Business\QuoteApprovalNotificationFacadeInterface getFacade()
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\QuoteApprovalNotificationConfig getConfig()
 */
class LinkExpanderPlugin extends AbstractPlugin implements QuoteApprovalNotificationExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Expands QuoteApprovalNotificationTransfer with configured link.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expand(
        QuoteApprovalNotificationTransfer $notificationTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer
    ): QuoteApprovalNotificationTransfer {
        return $this->getFacade()->expandNotificationWithLink(
            $notificationTransfer,
            $quoteApprovalEventTransfer
        );
    }
}
