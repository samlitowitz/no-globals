# PHPStan rules to disallow use of global keyword and $GLOBALS variable
[![Build Status](https://travis-ci.org/samlitowitz/no-globals.svg?branch=master)](https://travis-ci.org/samlitowitz/no-globals)

# Usage
To use these rules, require it via [Composer](https://getcomposer.org/)
```
composer require samlitowitz/no-globals --dev
```

Include rules.neon in your project's PHPStan config
```
includes:
    - vendor/samlitowitz/no-globals/rules.neon
```
