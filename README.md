# Magento2 API Endpoint for Newsletter module

    albedo/module-newsletter-api

### Description
REST API Layer for Magento Newsletter module adds additional 4 methods which allow to manage Magento subscribers.
Somehow, Magento Newsletter doesn't provide these methods, while they might be useful for 3rd party integrations with ESPs or other marketing software.

Features:
 - Possibility to get list using `searchCriteria`
 - Possiblity to subscribe/confiirm/unsubscribe using REST
 - Separate ACL rules for read/write permissions
 
 
When e-mail is subscribed, it will trigger/dispatch all observers and send e-mail to customer. It is equivalent to subscribe with normal form (same Magento methods used).

 📖  API Reference (Postman): https://documenter.getpostman.com/view/4376907/TVsxCSUj 
 
You can run tests by executing:
```$xslt 
php ../../../vendor/bin/phpunit ../../../app/code/Albedo/NewsletterApi/Test/* -c ../api-functional/phpunit_rest.xml 
```

⚠️ Make sure to have `api-functional/phpunit_rest.xml` properly configured!

Roadmap:
 - possibility to send multiple contacts in one requests
 - deleting subscribers

### Installation

 Install the module composer by running 
 
 `composer require albedo/module-newsletter-api`
 
 Enable the module by running 
 
 `php bin/magento module:enable Albedo_NewsletterApi`
 
Apply database updates by running 

`php bin/magento setup:upgrade`


 Flush the cache by running 
 
 `php bin/magento cache:flush`





