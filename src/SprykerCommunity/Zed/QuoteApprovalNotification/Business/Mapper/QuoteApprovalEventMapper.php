<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mapper;

use Generated\Shared\Transfer\EventEntityTransfer;
use Generated\Shared\Transfer\QuoteApprovalEventTransfer;

class QuoteApprovalEventMapper implements QuoteApprovalEventMapperInterface
{
    /**
     * @uses \Orm\Zed\QuoteApproval\Persistence\Map\SpyQuoteApprovalTableMap::COL_FK_COMPANY_USER
     *
     * @var string
     */
    protected const FOREIGN_KEY_COMPANY_USER = 'spy_quote_approval.fk_company_user';

    /**
     * @uses \Orm\Zed\QuoteApproval\Persistence\Map\SpyQuoteApprovalTableMap::COL_FK_QUOTE
     *
     * @var string
     */
    protected const FOREIGN_KEY_QUOTE = 'spy_quote_approval.fk_quote';

    /**
     * @param \Generated\Shared\Transfer\EventEntityTransfer $eventEntityTransfer
     * @param \Generated\Shared\Transfer\QuoteApprovalEventTransfer $quoteApprovalEventTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteApprovalEventTransfer
     */
    public function mapEventEntityTransferToQuoteApprovalEventTransfer(
        EventEntityTransfer $eventEntityTransfer,
        QuoteApprovalEventTransfer $quoteApprovalEventTransfer,
    ): QuoteApprovalEventTransfer {
        $foreignKeys = $eventEntityTransfer->getForeignKeys();

        return $quoteApprovalEventTransfer
            ->setEventName($eventEntityTransfer->getEvent())
            ->setIdCompanyUser($foreignKeys[static::FOREIGN_KEY_COMPANY_USER] ?? null)
            ->setIdQuote($foreignKeys[static::FOREIGN_KEY_QUOTE] ?? null)
            ->setIdQuoteApproval($eventEntityTransfer->getId());
    }
}
