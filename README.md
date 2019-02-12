# Customer IP Magento Module
Magento module save and display a customer's IP used during registration. Customer IP is used by default [ipapi](https://ipapi.co/)

# Installation
**Using modman**
```php
$cd /path/to/magento
modman clone https://github.com/dmitrykazak/customer-ip.git
```
**via Composer**
```
composer require dmitrykazak/customer-ip
```
**Manual Installation**
```
1) Copy all the files folders to the root folder of your Magento installation
2) Clear the cache.
```

# Usage

After installation of module, go to the magento admin panel
> System -> Configuration -> Customer IP

If you want using google map in the Manage Customer. Insert your public key to field  `Google API Key`

# How use custom data provider for IP
Add the following code to your module's `config.xml` file
```
<ip>
    <services>
        <custom_name>
            <name>Custom Name</name>
            <model>custom_data_provider</model>
        </custom_name>
    </services>
</ip>
```
In the admin panel in section Customer IP you select your custom data provide of ip.
