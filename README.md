# Get rid of faulty dates from yfinance.csv

Deletes all faulty dates from your yfinance.csv. A faulty date is either a date
where there are faulty values (NaN, inf) or where the date before has less
shares the current day. This assumes you don't sell shares (WIP), but only
add more to the file.


## How to use
A yfinance.csv has to be in the same folder with at least those fields

``` csv
Date;Name;Rendite
2020-10-01;Airbus SE;0.0
2020-10-02;Airbus SE;3.0
2020-10-04;Airbus SE;7.2
```

Just call the index.php via:

``` shell
php index.php
```
