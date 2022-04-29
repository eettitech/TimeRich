
<?php
echo getenv('APP_ENV'); // need to create a class to parse .env file
echo 'test env above';

// Show all information, defaults to INFO_ALL
phpinfo();

// Show just the module information.
// phpinfo(8) yields identical results.
phpinfo(INFO_MODULES);

?>
