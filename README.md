# IP locator - A class to identity the location on an IP address

# Usage
    <?php
        require_once('IPlocator.php');

        $locator = new IPlocator;

        $ip = "127.0.0.1";
        $results =  $locator->locateIP($ip);

    ?>

# Documentation
See http://extreme-ip-lookup.com/