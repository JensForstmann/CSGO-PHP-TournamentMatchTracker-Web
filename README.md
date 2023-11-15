# ARCHIVED - ARCHIVED - ARCHIVED

This repo has been archived in favor of [TMT2](https://github.com/JensForstmann/tmt2).

---

# DESCRIPTION
This is just a small and simple (and quick'n'dirty) webapp to send match_init data to an instance of TMT.

Because it isn't well tested, expect some errors :D

# REQUIREMENTS
* PHP
* PHP-JSON

# CONFIGURATION
Just edit the `tmt-web.config.php` file. Example:
```
<?php
$TMT_IP_PORT = '127.0.0.1:9999';
$TMT_TOKEN = 'somesecurity';
```

# START
Just open the `index.html` file via a browser.

# TESTING
If no webserver is available you can use php's builtin webserver:
    
    cd /path/to/tmt-web
    php -S 0.0.0.0:80
    
See `start-php-webserver.bat` for an example.

# FEATURES
* Request form to send a match_init request to the TMT instance.
* List that displays all current matches, refresh with clicking on the "List" heading.
