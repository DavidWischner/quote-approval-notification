<?php declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Communication\Plugin\Event;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;

/**
 * Subscribes to events dispatched by the Propel EventBehavior.
 */
class QuoteApprovalEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $this->addQuoteApprovalCreateListener($eventCollection);
        $this->addQuoteApprovalUpdateListener($eventCollection);
        $this->addQuoteApprovalDeleteListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addQuoteApprovalCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            'Entity.spy_quote_approval.create', // TODO const
            new QuoteApprovalCreateListener()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addQuoteApprovalUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            'Entity.spy_quote_approval.update', // TODO const
            new QuoteApprovalUpdateListener()
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addQuoteApprovalDeleteListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            'Entity.spy_quote_approval.delete', // TODO const
            new QuoteApprovalDeleteListener()
        );
    }
}
