<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander;

use Generated\Shared\Transfer\QuoteApprovalEventTransfer;
use Generated\Shared\Transfer\QuoteApprovalNotificationTransfer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToRouterFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\QuoteApprovalNotificationConfig;

class LinkExpander implements QuoteApprovalNotificationExpanderInterface
{
    /**
     * @param \SprykerCommunity\Zed\QuoteApprovalNotification\QuoteApprovalNotificationConfig $quoteApprovalNotificationConfig
     */
    public function __construct(
        protected QuoteApprovalNotificationConfig $quoteApprovalNotificationConfig,
        protected QuoteApprovalNotificationToRouterFacadeInterface $routerFacade,
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer $notificationTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalNotificationTransfer
     */
    public function expand(
        QuoteApprovalNotificationTransfer $notificationTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer,
    ): QuoteApprovalNotificationTransfer {
        $url = $this->quoteApprovalNotificationConfig->getNotificationUrl();

        return $notificationTransfer->setLink($this->formatUrl($url));
    }

    /**
     * @param string $url
     *
     * @return string
     */
    protected function formatUrl(string $url): string
    {
        return sprintf('%s%s', $this->quoteApprovalNotificationConfig->getYvesBaseUrl(), $url);
    }
}
