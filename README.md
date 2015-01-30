# Magento Google Trusted Stores
A simple Google Trusted Stores integration for use with Magento.

## What is Google Trusted Stores?
For more information on [Google Trusted Stores see their website](http://www.google.com/trustedstores/for-businesses/).

## Installation Guide
### Requirements:
- [Modman](https://github.com/colinmollenhour/modman)
- Git or subversion

### With Symlinks
1. Initialise modman
    ```
    modman init
    ```
2. Install this module
    ```
    modman clone https://github.com/develodesign/magento-google-trusted-stores.git
    ```
3. Ensure your Magento installation will allow you to use symlinks. Check your system config settings:
    ```
    Advanced > Developer > Template Settings > Allow Symlinks
    ```

### Without Symlinks
1. Initialise modman
    ```
    modman init
    ```
2. Install this module
    ```
    modman clone https://github.com/develodesign/magento-google-trusted-stores.git
    ```
3. Copy the module to the correct Magento directories.
    ```
    modman deploy magento-google-trusted-stores --copy
    ```
## Setup Instructions
1. Login to your Magento admin panel.
2. Access the modules configuration settings.
    ```
    System > Configuration > Develo > Google Trusted Stores
    ```
3. The only required settings for the extension to work is the Store Id and Badge Position. Badge Position will default to bottom right.
