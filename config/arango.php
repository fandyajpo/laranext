<?php
use ArangoDBClient\Connection as ArangoConnection;
use ArangoDBClient\ConnectionOptions as ArangoConnectionOptions;
use ArangoDBClient\UpdatePolicy as ArangoUpdatePolicy;
use ArangoDBClient\Exception as ArangoException;
return [
    ArangoConnectionOptions::OPTION_DATABASE => '_system',
    ArangoConnectionOptions::OPTION_ENDPOINT => env('ARANGO_URL'),
    ArangoConnectionOptions::OPTION_AUTH_TYPE => 'Basic',
    ArangoConnectionOptions::OPTION_AUTH_USER => 'root',
    ArangoConnectionOptions::OPTION_AUTH_PASSWD => '',  
    ArangoConnectionOptions::OPTION_CONNECTION => 'Keep-Alive',
    ArangoConnectionOptions::OPTION_TIMEOUT => 3,
    ArangoConnectionOptions::OPTION_RECONNECT => true,
    ArangoConnectionOptions::OPTION_CREATE => true,
    ArangoConnectionOptions::OPTION_UPDATE_POLICY => ArangoUpdatePolicy::LAST,
    ArangoConnectionOptions::OPTION_MEMCACHED_TTL => 600
];
ArangoException::enableLogging();
?>
