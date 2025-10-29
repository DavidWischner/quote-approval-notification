<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;

interface QuoteApprovalNotificationToCustomerFacadeInterface
{
 /**
  * @param string $customerReference
  *
  * @return \Generated\Shared\Transfer\CustomerTransfer|null
  */
    public function findByReference(string $customerReference): ?CustomerTransfer;
}
