# PHPStan rules to disallow use of global keyword and $GLOBALS variable

# Usage
To use these rules, require it via [Composer](https://getcomposer.org/)
```
composer require artspeople/no-globals --dev
```

Include rules.neon in your project's PHPStan config
```
includes:
    - vendor/artspeople/no-globals/rules.neon
```
