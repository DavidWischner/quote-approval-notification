<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade;

use Spryker\Zed\Router\Business\Router\ChainRouter;

interface QuoteApprovalNotificationToRouterFacadeInterface
{
    /**
     * @return \Spryker\Zed\Router\Business\Router\ChainRouter
     */
    public function getRouter(): ChainRouter;
}
