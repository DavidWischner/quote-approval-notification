<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification;

use SprykerCommunity\Shared\QuoteApprovalNotification\QuoteApprovalNotificationConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class QuoteApprovalNotificationConfig extends AbstractBundleConfig
{
    /**
     * @uses \Spryker\Shared\QuoteApproval\QuoteApprovalConfig::STATUS_APPROVED
     * @var string
     */
    public const STATUS_APPROVED = 'approved';

    /**
     * @uses \Spryker\Shared\QuoteApproval\QuoteApprovalConfig::STATUS_DECLINED
     * @var string
     */
    public const STATUS_DECLINED = 'declined';

    /**
     * @see \SprykerShop\Yves\CartPage\Plugin\Router\CartPageRouteProviderPlugin::addCartRoute
     * @string
     */
    public const NOTIFICATION_URL = '/cart';

    /**
     * @return string
     */
    public function getNotificationUrl(): string
    {
        return static::NOTIFICATION_URL;
    }

    /**
     * Specification:
     * - Returns base URL for Yves including scheme and port (e.g. http://www.de.demoshop.local:8080).
     *
     * @api
     *
     * @return string
     */
    public function getYvesBaseUrl(): string
    {
        return $this->get(QuoteApprovalNotificationConstants::BASE_URL_YVES);
    }
}
