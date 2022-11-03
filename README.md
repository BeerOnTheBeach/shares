# Marketstack-API-Script

Easy connect to the Marketstack-API to get the data from shares you want.
Create a CSV-File to easily read from - for you python-program or whatever.

[WIP] Create graphs from you data

## How to use

Clone the Project
````shell
git@github.com:BeerOnTheBeach/shares.git
````

Create an .env-file from the .env.dist and add you API-Key
````dotenv
MARKETSTACK_API_KEY="you-api-key-here"
MARKETSTACK_API_BASE_URL="https://api.marketstack.com/v1"
````

Create an sharesInput.json from the sharesInputDist.json with
the shares you want, when you bought them and optionally when you
sold them.
````json
{
  "shares": [
    {
      "symbol": "ABC" ,
      "bought": "01-01-2022",
      "sold": ""
    },
    {
      "symbol": "DEF" ,
      "bought": "01-02-2022",
      "sold": ""
    },
    {
      "symbol": "HIK" ,
      "bought": "01-03-2022",
      "sold": ""
    },
    {
      "symbol": "LMO" ,
      "bought": "01-04-2022",
      "sold": ""
    }
  ]
}
````

Install dependencies / create autoload file
````shell
composer install 
````

Run the index.php file and get a CSV-file.

````shell
php index.php
````

[WIP] Run the graph-command to create interactive
graphs.
````shell
bin/console shares:graph
````

[WIP] Run the csv-command to create a csv from you data
````shell
bin/console shares:csv
````