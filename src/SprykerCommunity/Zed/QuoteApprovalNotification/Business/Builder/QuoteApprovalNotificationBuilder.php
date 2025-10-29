<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder;

use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;

class QuoteApprovalNotificationBuilder implements QuoteApprovalNotificationBuilderInterface
{
    /**
     * @param array<\SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Expander\QuoteApprovalNotificationExpanderPluginInterface> $quoteApprovalNotificationExpanderPlugins
     */
    public function __construct(
        protected array $quoteApprovalNotificationExpanderPlugins
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function createQuoteApprovalNotificationTransferFromQuoteApprovalEventTransfer(
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer
    ): QuoteApprovalNotificationTransfer {
        $quoteApprovalNotificationTransfer = new QuoteApprovalNotificationTransfer();

        foreach ($this->quoteApprovalNotificationExpanderPlugins as $expanderPlugin) {
            $quoteApprovalNotificationTransfer = $expanderPlugin->expand(
                $quoteApprovalNotificationTransfer,
                $quoteApprovalEventTransfer,
            );
        }

        return $quoteApprovalNotificationTransfer;
    }
}
