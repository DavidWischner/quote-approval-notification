<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mapper;

use Generated\Shared\Transfer\EventEntityTransfer;
use Generated\Shared\Transfer\QuoteApprovalEventTransfer;

interface QuoteApprovalEventMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalEventTransfer
     */
    public function mapEventEntityTransferToQuoteApprovalEventTransfer(
        EventEntityTransfer $eventEntityTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer,
    ): QuoteApprovalEventTransfer;
}
