<?php declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Mail\Business\MailFacadeInterface;

class QuoteApprovalMailConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_MAIL = 'FACADE_MAIL';

    /**
     * @inheritDoc
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container->set(static::FACADE_MAIL, static function (Container $container): MailFacadeInterface {
            return $container->getLocator()->mail()->facade();
        });

        return $container;
    }
}
