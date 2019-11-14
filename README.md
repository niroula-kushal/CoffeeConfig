# CoffeeConfig

A simple library for retrieving configuration.

## Installation

You can install this library through composer
> composer require rehmat/coffee-config

## Usage

You can set the config using the Coffee\Config\AppConfig class.

> AppConfig::setAppConfig($configData);

Here $configData is an php array with your data.
```php

$configData = [
  'app' => [
    'key' => 'YOUR_APP_KEY',
    'db_name' => 'DB_NAME',
    'routes' => [
      'web' => [
        'home' => [
          'route' => '/home',
          'controller' => YourController::class
        ]
      ],
      'console' => [
        'login' => [
          'command' => 'login',
          'controller' => YourController::class
        ]
      ]
    ]
  ]
];
Coffee\Config\AppConfig::setAppConfig($configData);
```

To retrieve the appconfig, use the getAppConfig method.
> $appConfig = Coffee\Config\AppConfig::getAppConfig();

However, if the app config is not set, it will throw a Coffee\Config\Exception\AppConfigNotSetException . So, you could check if the config is set or not beforehand using the hasAppConfigSet method.

> $hasConfigSet = Coffee\Config\AppConfig::hasAppConfigSet();

## Retrieve Config
AppConfig::getAppConfig() returns an instance of Coffee\Config\Config . 

To retrieve the values within your config, use the get method.

In the above config, to retrieve the value of the 'app' key, use $config->get('key'); This will return another Config instance with from where you can query data inside child nodes of 'app' or get the array as a whole using the getValue method.
```php
$configFromAppNode = $appConfig->get('app');
$appNodeData = $configFromAppNode->getValue();

```

You can retrieve the values further down the tree using this method.

```php
$homeController = $appConfig->get('app')->get('routes')->get('web')->get('home')->get('controller')->getValue();
```

However, it can quickly get too verbose. Luckily, you could do the same using a path expression, where you specify the path till the config you would need.

```diff
- $homeController = $appConfig->get('app')->get('routes')->get('web')->get('home')->get('controller')->getValue();
+ $homeController = $appConfig->get('app/routes/web/home/controller')->getValue();
```

If you specify an invalid path, i.e. the path that does not exist, then it will throw an Coffee\Config\Exception\InvalidConfigPathException .

Infact, you could use this path expression in the AppConfig itself, using the AppConfig::get($path) method. However, this method is only provided as helper and you are suggested to first retrieve the app config using the getAppConfig method and use its get method.


If you call the get method on a LeafNode, it will throw an Coffee\Config\Exception\LeafNodeException . A node or config is a leaf node, if it does not have any child. 'db_name' is a leaf node as it does not have any child. In a leaf node, you can only retrieve its value using the getValue method.

You can use the isLeaf method of the config instance to check if it is a leaf node or not.

### Conclusion

Use this library to store you app configuration and retrieve it. This library will provide you with a fluent interface to your application configuration. This library does not care how the configuration is stored. So, it can be used with most of the php project with minimal configuration.

Ensure that you call the AppConfig::setAppConfig() with appropriate data when you application starts, in index.php for example.

Happy Coding !!


