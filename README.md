# QuoteApprovalNotifications Module
[![Latest Stable Version](https://poser.pugx.org/spryker-community/quote-approval-notifications/v/stable.svg)](https://packagist.org/packages/spryker-community/quote-approval-notifications)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.2-8892BF.svg)](https://php.net/)

Provides quote approval notification functionality.

## Documentation

### Prerequisites

Install the required features:

| NAME | VERSION | INSTALLATION GUIDE |
|---|---|---|
| Spryker Core | 202507.0 | [Install the Spryker Core feature](/docs/pbc/all/miscellaneous/latest/install-and-upgrade/install-features/install-the-spryker-core-feature.html) |

### 1) Install the required modules

Install the required modules using Composer:

```bash
composer require spryker-community/quote-approval-notifications:^1.0.0
```

{% info_block warningBox "Verification" %}

Make sure that the following modules have been installed:

| MODULE                     | EXPECTED DIRECTORY                             |
|----------------------------|------------------------------------------------|
| QuoteApprovalNotifications | spryker-community/quote-approval-notifications |
| ...                        | ...                                            |

{% endinfo_block %}

### 2) Make your project aware of Spryker Community (if not done already)

#### Sprykers Autoloading (PHP-side)

1. Configure Spryker Core Namespaces

Add the SprykerCommunity namespace to your Spryker configuration:

File: `config/Shared/config_default.php`

```php
<?php

// Add SprykerCommunity to the core namespaces array
$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerCommunity',  // Add this line
    'SprykerShop',
    'SprykerEco',
    'Spryker',
    'SprykerSdk',
];
```

2. Clear Cache (Optional)

If needed, clear the Spryker cache:

```bash
vendor/bin/console cache:empty-all
```

### 3) Set up transfer objects

Generate transfers:

```bash
console transfer:generate
```

### 4) Set up database changes

Generate transfers:

```bash
console propel:install
```

### 5) Configure module

#### File: `config/Shared/config_default.php`
```php
<?php
use SprykerCommunity\Shared\QuoteApprovalNotification\QuoteApprovalNotificationConstants;
//...

$config[ApplicationConstants::BASE_URL_YVES]
// ...
     = $config[QuoteApprovalNotificationConstants::BASE_URL_YVES] // Add this line
     = sprintf(
         'http://%s',
         $yvesHost,
    );
```

#### File: `Pyz/Zed/Event/EventDependencyProvider.php`
```php
<?php
use SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Event\QuoteApprovalEventSubscriberPlugin;
// ...
    public function getEventSubscriberCollection(): EventSubscriberCollectionInterface
    {
        $eventSubscriberCollection = parent::getEventSubscriberCollection();
        // ...
        // QuoteApprovalNotification
        $eventSubscriberCollection->add(new QuoteApprovalEventSubscriberPlugin());
       // ...
    }
```
#### File: `Pyz/Zed/Mail/MailDependencyProvider.php`
```php
<?php
use SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail\QuoteApprovalApprovedMailTypeBuilderPlugin;
use SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail\QuoteApprovalCancelledMailTypeBuilderPlugin;
use SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail\QuoteApprovalDeclinedMailTypeBuilderPlugin;
use SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Mail\QuoteApprovalRequestedMailTypeBuilderPlugin;
// ...
    protected function getMailTypeBuilderPlugins(): array
    {
        return [
        // ...
            # QuoteApprovalNotification
            new QuoteApprovalRequestedMailTypeBuilderPlugin(),
            new QuoteApprovalApprovedMailTypeBuilderPlugin(),
            new QuoteApprovalDeclinedMailTypeBuilderPlugin(),
            new QuoteApprovalCancelledMailTypeBuilderPlugin(),
       // ...
       ];
    }
```

### 6) Import necessary data

#### File: `data/import/common/common/cms_block.csv`
add block-entries from vendor/spryker-community/quote-approval-notification/data/import/cms_block.csv
#### File: `data/import/common/*/cms_block_store.csv`
add block-store-entries from vendor/spryker-community/quote-approval-notification/data/import/cms_block_store.csv
#### Execute imports
```bash
console data:import:cms-block
console data:import:cms-block-store
```

### Verification

After successful installation, you should receive e-mails whenever a new quote approval request is made and after the quote approval request has been approved or declined. To adjust the content of these e-mails use the prepared cms-blocks (see: `data/import/common/common/cms_block.csv`)
Within the cms-blocks you have access to the QuoteApprovalNotificationTransfer. E.g.:
```
Approver FirstName: {{ mail.quoteApprovalNotification.requestedApprover.customer.firstName }}
Buyer-Email: {{ mail.quoteApprovalNotification.buyer.email }}
CartPageLink: {{ mail.quoteApprovalNotification.link }}
QuoteApprovalStatus: {{ mail.quoteApprovalNotification.quoteApproval.status }}
```
