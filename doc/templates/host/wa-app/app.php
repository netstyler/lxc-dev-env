<?php
/**
 * Things you MUST change:
 *
 * - Set email transport from debug to Mail or something else you want
 * - Configure the database connections
 * - Check that Redis is up and running if you want to use it
 *
 * ATTENTION: Due to the fact that our lovely shitty legacy DB schema has
 * fields that use Mysql keywords we need to configure ALL Mysql connections
 * to use `quoteIdentifiers` true to escape them.
 *
 * See http://dev.mysql.com/doc/refman/5.7/en/keywords.html
 */


$mysqlServer = '172.16.0.10';
$mysqlUser = 'admin';
$mysqlPass = 'rel0aded';

$elasticServer = '172.16.0.12';
$mailHogServr = '172.16.0.4';

$cacheEngine = 'File';
$redisHost = '172.16.0.5';
$redisPort = '6379';

if (extension_loaded('redis')) {
	// Test the connection, will throw an exception if it can't connect
	$redis = new Redis();
	$redis->connect($redisHost, $redisPort);
	$redis->close();
	$cacheEngine = 'Redis';
}

return [
	/**
	 * Debug Level:
	 * Production Mode:
	 * false: No error messages, errors, or warnings shown.
	 * Development Mode:
	 * true: Errors and warnings shown.
	 */
	'debug' => true,

	/**
	 * Configure basic information about the application.
	 * - namespace - The namespace to find app classes under.
	 * - encoding - The encoding used for HTML + database connections.
	 * - base - The base directory the app resides in. If false this
	 *   will be auto detected.
	 * - dir - Name of app directory.
	 * - webroot - The webroot directory.
	 * - wwwRoot - The file path to webroot.
	 * - baseUrl - To configure CakePHP to *not* use mod_rewrite and to
	 *   use CakePHP pretty URLs, remove these .htaccess
	 *   files:
	 *      /.htaccess
	 *      /webroot/.htaccess
	 *   And uncomment the baseUrl key below.
	 * - fullBaseUrl - A base URL to use for absolute links.
	 * - imageBaseUrl - Web path to the public images directory under webroot.
	 * - cssBaseUrl - Web path to the public css directory under webroot.
	 * - jsBaseUrl - Web path to the public js directory under webroot.
	 * - paths - Configure paths for non class based resources. Supports the
	 *   `plugins`, `templates`, `locales` subkeys, which allow the definition of
	 *   paths for plugins, view templates and locale files respectively.
	 */
	'App' => [
		'namespace' => 'App',
		'encoding' => 'UTF-8',
		'base' => false,
		'dir' => 'src',
		'webroot' => 'webroot',
		'wwwRoot' => WWW_ROOT,
		// 'baseUrl' => env('SCRIPT_NAME'),
		'fullBaseUrl' => false,
		'imageBaseUrl' => 'img/',
		'cssBaseUrl' => 'css/',
		'jsBaseUrl' => 'js/',
		'paths' => [
			'plugins' => [ROOT . DS . 'plugins' . DS],
			'templates' => [APP . 'Template' . DS],
			'locales' => [APP . 'Locale' . DS],
		],
	],

	/**
	 * Security and encryption configuration
	 * - salt - A random string used in security hashing methods.
	 *   The salt value is also used as the encryption key.
	 *   You should treat it as extremely sensitive data.
	 */
	'Security' => [
		'salt' => strrev('DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi'),
	],

	/**
	 * Apply timestamps with the last modified time to static assets (js, css, images).
	 * Will append a querystring parameter containing the time the file was modified.
	 * This is useful for busting browser caches.
	 * Set to true to apply timestamps when debug is true. Set to 'force' to always
	 * enable timestamping regardless of debug value.
	 */
	'Asset' => [
		// 'timestamp' => true,
	],

	/**
	 * Configure the cache adapters.
	 */
	'Cache' => [
		'default' => [
			'className' => $cacheEngine,
			'path' => CACHE,
			'host' => $redisHost,
			'port' => $redisPort,
			'database' => 0,
		],
		'domains' => [
			'className' => $cacheEngine,
			'path' => CACHE . 'domains/',
			'host' => $redisHost,
			'port' => $redisPort,
			'database' => 1,
		],
		'navigation' => [
			'className' => $cacheEngine,
			'path' => CACHE . 'navigation/',
			'host' => $redisHost,
			'port' => $redisPort,
			'database' => 2,
		],
		'routes' => [
			'className' => $cacheEngine,
			'path' => CACHE . 'routes/',
			'host' => $redisHost,
			'port' => $redisPort,
			'database' => 3,
		],
		'smartad' => [
			'className' => $cacheEngine,
			'path' => CACHE . 'smartad/',
			'host' => $redisHost,
			'port' => $redisPort,
			'database' => 4,
		],

		/**
		 * Configure the cache used for general framework caching.
		 * Translation cache files are stored with this configuration.
		 */
		'_cake_core_' => [
			'className' => $cacheEngine,
			'prefix' => 'myapp_cake_core_',
			'path' => CACHE . 'persistent/',
			'serialize' => true,
			'duration' => '+2 minutes',
			'host' => $redisHost,
			'port' => $redisPort,
			'database' => 4,
		],

		/**
		 * Configure the cache for model and datasource caches. This cache
		 * configuration is used to store schema descriptions, and table listings
		 * in connections.
		 */
		'_cake_model_' => [
			'className' => $cacheEngine,
			'prefix' => 'myapp_cake_model_',
			'path' => CACHE . 'models/',
			'serialize' => true,
			'duration' => '+2 minutes',
			'host' => $redisHost,
			'port' => $redisPort,
			'database' => 5,
		],
	],

	/**
	 * Configure the Error and Exception handlers used by your application.
	 * By default errors are displayed using Debugger, when debug is true and logged
	 * by Cake\Log\Log when debug is false.
	 * In CLI environments exceptions will be printed to stderr with a backtrace.
	 * In web environments an HTML page will be displayed for the exception.
	 * With debug true, framework errors like Missing Controller will be displayed.
	 * When debug is false, framework errors will be coerced into generic HTTP errors.
	 * Options:
	 * - `errorLevel` - int - The level of errors you are interested in capturing.
	 * - `trace` - boolean - Whether or not backtraces should be included in
	 *   logged errors/exceptions.
	 * - `log` - boolean - Whether or not you want exceptions logged.
	 * - `exceptionRenderer` - string - The class responsible for rendering
	 *   uncaught exceptions.  If you choose a custom class you should place
	 *   the file for that class in src/Error. This class needs to implement a
	 *   render method.
	 * - `skipLog` - array - List of exceptions to skip for logging. Exceptions that
	 *   extend one of the listed exceptions will also be skipped for logging.
	 *   E.g.:
	 *   `'skipLog' => ['Cake\Network\Exception\NotFoundException', 'Cake\Network\Exception\UnauthorizedException']`
	 */
	'Error' => [
		'errorLevel' => E_ALL & ~E_DEPRECATED,
		'exceptionRenderer' => 'App\Error\ExceptionRenderer',
		'skipLog' => [],
		'log' => true,
		'trace' => true,
	],

	/**
	 * Email configuration.
	 * By defining transports separately from delivery profiles you can easily
	 * re-use transport configuration across multiple profiles.
	 * You can specify multiple configurations for production, development and
	 * testing.
	 * Each transport needs a `className`. Valid options are as follows:
	 *  Mail   - Send using PHP mail function
	 *  Smtp   - Send using SMTP
	 *  Debug  - Do not send the email, just return the result
	 * You can add custom transports (or override existing transports) by adding the
	 * appropriate file to src/Mailer/Transport.  Transports should be named
	 * 'YourTransport.php', where 'Your' is the name of the transport.
	 */
	'EmailTransport' => [
		'default' => [
			'className' => 'Debug',
			// The following keys are used in SMTP transports
			'host' => $mailHogServr,
			'port' => 1025,
			'timeout' => 30,
			'username' => '',
			'password' => '',
			'client' => null,
			'tls' => null,
		],
	],

	/**
	 * Email delivery profiles
	 * Delivery profiles allow you to predefine various properties about email
	 * messages from your application and give the settings a name. This saves
	 * duplication across your application and makes maintenance and development
	 * easier. Each profile accepts a number of keys. See `Cake\Network\Email\Email`
	 * for more information.
	 */
	'Email' => [
		'default' => [
			'transport' => 'default',
			'from' => 'you@localhost',
			//'charset' => 'utf-8',
			//'headerCharset' => 'utf-8',
		],
	],

	/**
	 * Connection information used by the ORM to connect
	 * to your application's datastores.
	 * Drivers include Mysql Postgres Sqlite Sqlserver
	 * See vendor\cakephp\cakephp\src\Database\Driver for complete list
	 */
	'Datasources' => [
		'default' => [
			'className' => 'Cake\Database\Connection',
			'driver' => 'Cake\Database\Driver\Mysql',
			'persistent' => false,
			'host' => $mysqlServer,
			/**
			 * CakePHP will use the default DB port based on the driver selected
			 * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
			 * the following line and set the port accordingly
			 */
			//'port' => 'nonstandard_port_number',
			'username' => $mysqlUser,
			'password' => $mysqlPass,
			'database' => 'wa3',
			'encoding' => 'utf8',
			'timezone' => 'UTC',
			'cacheMetadata' => true,
			'log' => false,

			/**
			 * Set identifier quoting to true if you are using reserved words or
			 * special characters in your table or column names. Enabling this
			 * setting will result in queries built using the Query Builder having
			 * identifiers quoted when creating SQL. It should be noted that this
			 * decreases performance because each query needs to be traversed and
			 * manipulated before being executed.
			 *
			 * We sadly have to set this to true because some dumbass developers
			 * of the legacy app decided it's a good idea to use plenty of
			 * reserved words in their tables...
			 */
			'quoteIdentifiers' => true,

			/**
			 * During development, if using MySQL < 5.6, uncommenting the
			 * following line could boost the speed at which schema metadata is
			 * fetched from the database. It can also be set directly with the
			 * mysql configuration directive 'innodb_stats_on_metadata = 0'
			 * which is the recommended value in production environments
			 */
			//'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
		],
		'mailing' => [
			'className' => 'Cake\Database\Connection',
			'driver' => 'Cake\Database\Driver\Mysql',
			'persistent' => false,
			'host' => $mysqlServer,
			'prefix' => '',
			/**
			 * CakePHP will use the default DB port based on the driver selected
			 * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
			 * the following line and set the port accordingly
			 */
			//'port' => 'nonstandard_port_number',
			'username' => $mysqlUser,
			'password' => $mysqlPass,
			'database' => 'wa_newsletters',
			'encoding' => 'utf8',
			'timezone' => 'UTC',
			'cacheMetadata' => true,
			'log' => false,

			/**
			 * Set identifier quoting to true if you are using reserved words or
			 * special characters in your table or column names. Enabling this
			 * setting will result in queries built using the Query Builder having
			 * identifiers quoted when creating SQL. It should be noted that this
			 * decreases performance because each query needs to be traversed and
			 * manipulated before being executed.
			 */
			'quoteIdentifiers' => true,

			/**
			 * During development, if using MySQL < 5.6, uncommenting the
			 * following line could boost the speed at which schema metadata is
			 * fetched from the database. It can also be set directly with the
			 * mysql configuration directive 'innodb_stats_on_metadata = 0'
			 * which is the recommended value in production environments
			 */
			//'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
		],
		'elastic' => [
			'className' => 'Cake\ElasticSearch\Datasource\Connection',
			'driver' => 'Cake\ElasticSearch\Datasource\Connection',
			'host' => $elasticServer,
			'port' => 9200,
			'index' => 'wa-search',
		],
		/**
		 * The test connection is used during the test suite.
		 */
		'test' => [
			'className' => 'Cake\Database\Connection',
			'driver' => 'Cake\Database\Driver\Mysql',
			'persistent' => false,
			'host' => $mysqlServer,
			//'port' => 'nonstandard_port_number',
			'username' => $mysqlUser,
			'password' => $mysqlPass,
			'database' => 'test',
			'encoding' => 'utf8',
			'timezone' => 'UTC',
			'cacheMetadata' => true,
			'quoteIdentifiers' => true,
			'log' => false,
			//'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
		],
		'test_mailing' => [
			'className' => 'Cake\Database\Connection',
			'driver' => 'Cake\Database\Driver\Mysql',
			'persistent' => false,
			'host' => $mysqlServer,
			'username' => $mysqlUser,
			'password' => $mysqlPass,
			'database' => 'test_mailing',
			'encoding' => 'utf8',
			'timezone' => 'UTC',
			'cacheMetadata' => true,
			'quoteIdentifiers' => true,
			'log' => false,
			//'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
		],
		'test_elastic' => [
			'className' => 'Cake\ElasticSearch\Datasource\Connection',
			'driver' => 'Cake\ElasticSearch\Datasource\Connection',
			'host' => $elasticServer,
			'port' => 9200,
			'index' => 'test-world-architects',
		],
	],

	/**
	 * Configures logging options
	 */
	'Log' => [
		'debug' => [
			'className' => 'Cake\Log\Engine\FileLog',
			'path' => LOGS,
			'file' => 'debug',
			'levels' => ['notice', 'info', 'debug'],
		],
		'error' => [
			'className' => 'Cake\Log\Engine\FileLog',
			'path' => LOGS,
			'file' => 'error',
			'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
		],
		'queries' => [
			'className' => 'Console',
			'stream' => 'php://stderr',
			'scopes' => ['queriesLog']
		],
		'slowQueries' => [
			'className' => 'Cake\Log\Engine\FileLog',
			'path' => LOGS,
			'file' => 'slow-queries',
			'scopes' => ['slowQueriesLog']
		]
	],

	/**
	 * Session configuration.
	 * Contains an array of settings to use for session configuration. The
	 * `defaults` key is used to define a default preset to use for sessions, any
	 * settings declared here will override the settings of the default config.
	 * ## Options
	 * - `cookie` - The name of the cookie to use. Defaults to 'CAKEPHP'.
	 * - `cookiePath` - The url path for which session cookie is set. Maps to the
	 *   `session.cookie_path` php.ini config. Defaults to base path of app.
	 * - `timeout` - The time in minutes the session should be valid for.
	 *    Pass 0 to disable checking timeout.
	 *    Please note that php.ini's session.gc_maxlifetime must be equal to or greater
	 *    than the largest Session['timeout'] in all served websites for it to have the
	 *    desired effect.
	 * - `defaults` - The default configuration set to use as a basis for your session.
	 *    There are four built-in options: php, cake, cache, database.
	 * - `handler` - Can be used to enable a custom session handler. Expects an
	 *    array with at least the `engine` key, being the name of the Session engine
	 *    class to use for managing the session. CakePHP bundles the `CacheSession`
	 *    and `DatabaseSession` engines.
	 * - `ini` - An associative array of additional ini values to set.
	 * The built-in `defaults` options are:
	 * - 'php' - Uses settings defined in your php.ini.
	 * - 'cake' - Saves session files in CakePHP's /tmp directory.
	 * - 'database' - Uses CakePHP's database sessions.
	 * - 'cache' - Use the Cache class to save sessions.
	 * To define a custom session handler, save it at src/Network/Session/<name>.php.
	 * Make sure the class implements PHP's `SessionHandlerInterface` and set
	 * Session.handler to <name>
	 * To use database sessions, load the SQL file located at config/Schema/sessions.sql
	 */
	'Session' => [
		'defaults' => 'cache',
		'timeout' => 3600,
		'host' => $redisHost,
		'port' => $redisPort,
		'database' => 6,
	],
];
