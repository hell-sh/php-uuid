# uuid-php [![Build Status](https://travis-ci.org/hell-sh/php-uuid.svg?branch=master)](https://travis-ci.org/hell-sh/php-uuid)

A wrapper for 128 unique bits.

1. `composer require hell-sh/uuid`
2. [Read the docs](https://hell-sh.github.io/php-uuid/classhellsh_1_1UUID.html)

## Branches

- `1.0`: The initial release with the `\hellsh\UUID` class featuring `v4()`, `v5($str, UUID $namespace = null)`, and `toString($withDashes = false)`. Supports PHP 5 and above. Maintenance is limited to fixing critical issues.
- `1.1`: The second release adding the `hashCode` method and with it the `GMP` dependency. Maintenance is limited to fixing critical issues.
- `master`: The latest version, requiring PHP 7.1+ and GMP, with all the latest features and active maintenance.
