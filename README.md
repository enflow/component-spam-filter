# Simple PHP spam filter which checks input against a blacklist

[![Latest Version on Packagist](https://img.shields.io/packagist/v/enflow/component-spam-filter.svg?style=flat-square)](https://packagist.org/packages/enflow/component-spam-filter)
[![Software License](https://img.shields.io/badge/license-GPL3-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/enflow-nl/component-spam-filter/master.svg?style=flat-square)](https://travis-ci.org/spatie/component-spam-filter)
[![Total Downloads](https://img.shields.io/packagist/dt/enflow/component-spam-filter.svg?style=flat-square)](https://packagist.org/packages/enflow/component-spam-filter)

The `enflow/component-spam-filter` package provides a easy way to check if a given text matches any of the [blacklists](https://github.com/enflow-nl/spam-filter-blacklists).

Component is based on [`IQAndreas/php-spam-filter`](https://github.com/IQAndreas/php-spam-filter).

## Installation
You can install the package via composer:

``` bash
composer require enflow/component-spam-filter
```

## Usage
``` php
use Enflow\Component\SpamFilter\SpamFilter;

$spamFilter = new SpamFilter();

$spamFilter->isPossibleSpam('fun gambling'); // true
$spamFilter->isPossibleSpam('keyword or full text without blacklisted words'); // false
```

To use a custom blacklist, specify your path in the constructor like where the *.txt files reside:
``` php
use Enflow\Component\SpamFilter\SpamFilter;

$spamFilter = new SpamFilter('path/to/blacklist');
```

## Blacklist updates
Pull Requests for blacklist changes are always welcome! You can find the blacklist files on https://github.com/enflow-nl/spam-filter-blacklists
Changes on this list are automatically pulled in with every `composer update`, as this package includes the `master` version of the spam-filter-blacklists package.

## Testing
``` bash
$ composer test
```

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security related issues, please email michel@enflow.nl instead of using the issue tracker.

## Changes
The original package from [Andreas Renberg](https://github.com/IQAndreas) has been modified and cleanup, most notable changes:
- Added support for a PSR-4 autoloader
- Added tests
- Removed the blacklist self updater

## Credits
- [Michel Bardelmeijer](https://github.com/mbardelmeijer)
- [Andreas Renberg](https://github.com/IQAndreas)
- [All Contributors](../../contributors)

## About Enflow
Enflow is a digital creative agency based in Alphen aan den Rijn, Netherlands. We specialize in developing web applications, mobile applications and websites. You can find more info [on our website](https://enflow.nl/en).

## License
The GNU General Public License v3.0 (GPL-3.0). Please see [License File](LICENSE.md) for more information.
