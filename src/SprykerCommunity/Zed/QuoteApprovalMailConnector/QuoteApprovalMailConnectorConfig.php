<?php declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class QuoteApprovalMailConnectorConfig extends AbstractBundleConfig
{
    public const STATUS_APPROVED = 'approved';
    public const STATUS_DECLINED = 'declined';
}
