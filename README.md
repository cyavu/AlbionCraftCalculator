<div id="top"></div>

<br />
<div align="center">
  <a href="https://github.com/cyavu/AlbionCraftCalculator">
    <img src="https://slishy.com/albiononline.png" alt="Logo" width="80" height="80">
  </a>

  
  <h3 align="center">Albion Online Crafting Calculator</h3>

  <p align="center">
    Written in PHP + MySQL
    <br />
    <strong>Self hosted crafting calculator for offline and online usage</strong>
    <br />
    <br />
    <a href="https://slishy.com">View Demo</a>
    ·
    <a href="https://github.com/cyavu/AlbionCraftCalculator/issues">Report Bug</a>
    ·
    <a href="https://github.com/cyavu/AlbionCraftCalculator/issues">Request Feature</a>
  </p>
</div>


## What's This Project
[![Crafting Calculator][product-screenshot]](https://slishy.com)
<div align="center">
  <a href="https://github.com/cyavu/AlbionCraftCalculator">
    <img src="https://slishy.com/slishycom_preview_1.png" alt="Preview">
  </a>

Albion Online Craft Calculator is a crafting calculator for the free MMORPG game Albion Online. With this code you can search for an item that you would like to craft and instantly see which items are required to craft the given item. The code works with Albion Data Project to provide you prices for the item that you would like to craft and the items that are required for each city.

You can use this Crafting Calculator for multiple purposes. Here are a few to demonstrate them:
* Price check on an item in different cities without traveling in-game
* See which and how many items are required to make one specific item
* Calculate profitability if crafting an item is cheaper than buying it off the market
* See available tiers for each item
* Apply the crafting bonus when the right city is selected

A live demo is available at `https://slishy.com`.

<p align="right">(<a href="#top">back to top</a>)</p>


### Prerequisites

You need the following services set up before you can run this code on your webserver:

* Any Linux distro (fully compatible with CentOS and Debian-based distros)
* Apache 2 with mod_rewrite
* PHP 7.4+ (8.0 is recommended)
* MySQL 5.7+ / MariaDB 10.5+
* TCP_OUT:443 in case if you have a firewall set up

<p align="right">(<a href="#top">back to top</a>)</p>


### Installation

_Please read ALL the instructions below, they include very important steps after carefully completing the next steps:_
1. Create a utf8mb4_unicode_ci MySQL database
2. Import dump.sql into the newly created database
3. Edit the following file:
  ```
  /root/api/dbconnect.php
  ```
4. Upload all contents of the root folder to your webserver root folder (e.g. httpdocs or public_html)
5. Visit your website and verify if our MySQL connection is working by searching for an item at the topleft side of the webpage


### Updating Default City

By default, the calculator has to have a default city which in our case is Lymhurst. If you are planning on using this calculator for yourself and would like to change the default city, edit the $location paramater in the following files:
  ```
  /root/index.php
  /root/api/searchItem.php
  ```

The city names are hardcoded in the following file and do not need to be changed (only change if SBI decides to change city names or whatever in the future):
  ```
  /root/api/JSON/cities.json
  ```


### Updating API Endpoints

The calculator uses data from the Albion Data Project and the official Albion Online Render API. You may change these to other endpoints if you wish so. The following files include webhooks that you may want to change if you are switching to another price providing API or if you would like to change the default API for the retrieval of item images:
  ```
  /root/api/cardFour.php
  /root/api/cardOne.php
  /root/api/searchItem.php
  ```


### Updating The Itemlist

Since SBI do not provide any documentation or files in order to set this kind of project up, we have to hack one specific game file in order to retrieve all game item names and details. This used to be a simple .xml file which SBI later on decided to encode into a blob file. I cannot tell you how to do this but there are ways to retrieve the items.xml from various sources or Discord servers. For our sake, this project has an items.xml included and there is a trimmed down version available which only includes the parts we only need (items.xml version: Jan 2021).

The trick is to do the following:
1. Obtain items.xml or use the one provided by this project (api/XML/items.xml)
2. Use api/readXML.php to convert this XML into MySQL records
3. Execute the given MySQL records by the tool into your database

Now that you've updated the itemlist, you would have to manually change the itemlist that appears under the search bar in:
  ```
  /root/api/itemList.php
  ```


### Further Customization

The project is built on the free HTML template called SB Admin 2: https://startbootstrap.com/theme/sb-admin-2
If you need to change the way the project is calculating data with JavaScript, you would need to tweak it in the following file:
  ```
  /root/js/priceUpdate.js
  ```

Our custom.js is located at:
  ```
  /root/js/custom.js
  ```

Our custom.css is located at:
  ```
  /root/css/custom.css
  ```

<p align="right">(<a href="#top">back to top</a>)</p>


## License

Distributed under the Apache 2.0 License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>


## Contact

Slishy - info@breander.com

<p align="right">(<a href="#top">back to top</a>)</p>