# Laravel ActiveCampaign

[![Latest Stable Version](https://poser.pugx.org/rossbearman/laravel-active-campaign/v/stable?style=flat-square)](https://packagist.org/packages/rossbearman/laravel-active-campaign)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

This package provides a simple interface to the ActiveCampaign API v3. It is a continuation of the original laravel-active-campaign package by [Tjardoo/Label84](https://github.com/tjardoo) and can easily be [migrated](#migrating-from-label84activecampaign).  

The package currently supports `Contacts`, `Custom Fields`, `Custom Fields Values`, `Tags` and `Lists`. Feel free to open a pull request to add support for other endpoints.

- [Laravel Support](#laravel-support)
- [Installation](#installation)
- [Migrating from Label84/ActiveCampaign](#migrating-from-label84activecampaign)
- [Usage](#usage)
- [Examples](#examples)
  - [Contacts](#contacts)
  - [Custom Fields](#custom-fields)
  - [Custom Field Values](#custom-field-values)
  - [Tags](#tags)
- [Code Quality](#code-quality)
- [License](#license)

## Laravel Support

| Version | Release |
|---------|---------|
| 10.x    | 1.3     |
| 11.x    | 1.3.1   |
| 12.x    | 1.3.2   |

## Installation

### 1. Install the package via composer

```sh
composer require rossbearman/laravel-active-campaign
```

### 2. Publish the config file

```sh
php artisan vendor:publish --provider="RossBearman\ActiveCampaign\ActiveCampaignServiceProvider" --tag="config"
```

### 3. Add the base URL and API key to your .env

```env
ACTIVE_CAMPAIGN_BASE_URL=
ACTIVE_CAMPAIGN_API_KEY=
```

## Migrating from Label84/ActiveCampaign
The only change required to migrate to v1.3 is replacing `Label84` with `RossBearman` in namespaces and requiring `rossbearman/laravel-active-campaign` instead of `label84/laravel-active-campaign` in your `composer.json` file.

## Usage

- [Active Campaign API Documentation](https://developers.activecampaign.com/reference)
- [Active Campaign Contact API Documentation](https://developers.activecampaign.com/reference/contact)

Access via facade:

```php
use RossBearman\ActiveCampaign\Facades\ActiveCampaign;

$contact = ActiveCampaign::contacts()->get(1);
```

Resolve directly out of the container:

```php
use RossBearman\ActiveCampaign\ActiveCampaign;

$contact = resolve(ActiveCampaign::class)->contacts()->get(1);
```

Inject into a constructor or method via [automatic injection](https://laravel.com/docs/10.x/container#automatic-injection):

```php
use RossBearman\ActiveCampaign\ActiveCampaign;

class ContactController extends Controller
{
    public function __construct(private readonly ActiveCampaign $activeCampaign) { }

    $this->activeCampaign->contacts()->get(1);
}
```

## Examples

The following examples use the facade for simplicity and assume `RossBearman\ActiveCampaign\Facades\ActiveCampaign` has been imported.

### Contacts

#### Retrieve an existing contact

```php
$contact = ActiveCampaign::contacts()->get(1);
```

#### List all contact, search contacts, or filter contacts by query defined criteria

See the API docs for a [full list of possible query parameters](https://developers.activecampaign.com/reference/list-all-contacts).

```php
$contacts = ActiveCampaign::contacts()->list();
$contactByEmail = ActiveCampaign::contacts()->list('email=info@example.com');
$singleList = ActiveCampaign::contacts()->list('listid=1');
```

#### Create a new contact

```php
$contactId = ActiveCampaign::contacts()->create('info@example.com', [
    'firstName' => 'John',
    'lastName' => 'Doe',
    'phone' => '+3112345678',
]);
```

#### Create a contact if they don't exist, or update an existing contact

```php
$contact = ActiveCampaign::contacts()->sync('info@example.com', [
    'firstName' => 'John',
    'lastName' => 'Doe',
    'phone' => '+3112345678',
]);
```

#### Update an existing contact

```php
use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignContact;

$contact = new ActiveCampaignContact(
    id: 1,
    email: 'info@example.com',
    phone: '+3112345678',
    firstName: 'John',
    lastName: 'Deer',
);

ActiveCampaign::contacts()->update($contact);
```

#### Update the status of a contact on a list

The status should be `1` for subscribed and `2` for unsubscribed

```php
$contact = ActiveCampaign::contacts()->updateListStatus(
    contactId: 1,
    listId: 1,
    status: 1,
);
```

#### Delete an existing contact

```php
ActiveCampaign::contacts()->delete(1);
```

#### Add a tag to contact

```php
$contactTagId = ActiveCampaign::contacts()->tag(
    id: 1,
    tagId: 20
);
```

#### Remove a tag from a contact

```php
ActiveCampaign::contacts()->untag(contactTagId: 2340);
```

### Custom Field Values

#### Retrieve an existing field value

```php
$fieldValue = ActiveCampaign::fieldValues()->get(50);
```

#### Create a field value

```php
$fieldValueId = ActiveCampaign::fieldValues()->create(
    contactId: 1,
    fieldId: 50,
    value: 'active',
);
```

#### Update an existing field value

```php
use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignFieldValue;

$fieldValue = new ActiveCampaignFieldValue(
    contactId: 1,
    field: 50,
    value: 'inactive',
);

ActiveCampaign::fieldValues()->update($fieldValue);
```

#### Delete an existing field value

```php
ActiveCampaign::fieldValues()->delete(50);
```

### Custom Fields

#### Retrieve an existing field

```php
$field = ActiveCampaign::fields()->get(1);
```

#### Create a field

```php
$fieldId = ActiveCampaign::fields()->create(
    type: 'textarea',
    title: 'about',
    description: 'Short introduction',
);
```

#### Update an existing field

```php
use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignField;

$fieldValue = new ActiveCampaignField(
    id: 1,
    type: 'textarea',
    title: 'about',
    description: 'Relevant skills',
);

ActiveCampaign::fields()->update($fieldValue);
```

#### Delete an existing field

```php
ActiveCampaign::fields()->delete(1);
```

### Tags

#### Retrieve an existing tag

```php
$tag = ActiveCampaign::tags()->get(100);
```

#### List all tags, optionally filtered by name

```php
$tags = ActiveCampaign::tags()->list();
$filteredTags = ActiveCampaign::tags()->list('test_');
```

#### Create a tag

```php
$tag = ActiveCampaign::tags()->create(
    name: 'test_tag',
    description: 'This is a new tag'
);
```

#### Update an existing tag

```php
use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignTag;

$tag = new ActiveCampaignTag(
    id: 100,
    name: 'test_tag',
    description: 'Another description',
);

ActiveCampaign::tags()->update($tag);
```

#### Delete an existing tag

```php
ActiveCampaign::tags()->delete(100);
```

## Code Quality

```sh
./vendor/bin/phpstan analyse
```

## License

[MIT](https://opensource.org/licenses/MIT)
