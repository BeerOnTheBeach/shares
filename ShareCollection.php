<?php

class ShareCollection
{
    /**
     * @var array
     */
    private array $shareDataArray;

    public function __construct()
    {
        $this->shareDataArray = $this->csvToAssocArray("stock2.csv");
    }

    /**
     * @param $file
     * @return array
     */
    public function csvToAssocArray($file): array
    {
        $assocArray = [];

        $rows = array_map(function ($v) {
            return str_getcsv($v, ";");
        }, file($file));

        $header = array_shift($rows);
        foreach ($rows as $row) {
            $assocArray[] = array_combine($header, $row);
        }
        return $assocArray;
    }

    /**
     * @return void
     */
    public function printArray()
    {
        print_r($this->shareDataArray);
    }

    /**
     * @return void
     */
    public function printShareDataCount()
    {
        print_r("Amount data-rows: " . count($this->shareDataArray) . "\n");
    }

    /**
     * As I don't know which keys to check, make it dynamically
     * As I also don't know for what to check, make it dynamically
     *
     * @param array $faultyValues
     * @return array
     */
    public function getDatesWithFaultyValues(array $faultyValues = ["NaN", "inf"]): array
    {
        $shares2d = $this->create2dArray();
        $faultyDates = [];
        print_r("Finding dates with faulty values... ");

        /**
         *  $date is the array key, e.g. "2020-10-01"
         *  $sharesOnDate is an array holding values (Rendite) for all shares on the given date, e.g.
         *  array(5) {
         *    ["Airbus SE"]=>
         *    string(3) "0.0"
         *    ["TotalEnergies SE"]=>
         *    string(3) "0.0"
         *    ["LVMH Moët Hennessy - Louis Vuitton, Société Européenne"]=>
         *    string(3) "0.0"
         *    ["Carnival Corporation & plc"]=>
         *    string(5) "-2.71"
         *    ["Meta Platforms, Inc."]=>
         *    string(3) "0.0"
         *  }
         */
        foreach ($shares2d as $date => $sharesOnDate) {
            /**
             * $share holds value of "rendite", e.g. 5.38
             */
            foreach ($sharesOnDate as $share) {
                // Checks if given value from a share is one of the given faulty values, e.g. "inf", "NaN" or whatever
                if (in_array($share, $faultyValues)) {
                    // Faulty value detected, remember this date to delete later
                    $faultyDates[] = $date;
                }
            }
        }
        print_r("Dates with faulty values found: " . count($faultyDates) . "\n");

        return $faultyDates;
    }

    /**
     * @return array
     */
    public function getDatesWithIncompleteData(): array
    {
        $datesWithIncompleteData = [];

        $shares2d = $this->create2dArray();

        $sharesOnDateBefore = [];
        $dateBefore = "";

        ksort($shares2d);

        print_r("Finding dates with incomplete data... \n");
        foreach ($shares2d as $date => $sharesOnDates) {
            if (count($sharesOnDates) < count($sharesOnDateBefore) && !empty($sharesOnDateBefore)) {
                print_r("Date[$date]: Amount[" . $this->getFormattedCount($sharesOnDates) . "] <---> " );
                print_r("Date[$dateBefore]: Amount[" . $this->getFormattedCount($sharesOnDateBefore) . "]"
                    . " --> Diff[" . count($sharesOnDateBefore) - count($sharesOnDates) .  "]\n");
                $datesWithIncompleteData[] = $date;
            }
            $dateBefore = $date;
            $sharesOnDateBefore = $sharesOnDates;
        }

        print_r("Dates with incomplete data (less shares than day before) found: "
            . count($datesWithIncompleteData) . "\n\n");


        return $datesWithIncompleteData;
    }

    /**
     * Creates "Wide-Format", to get faulty-dates later
     *
     * @return array
     */
    public function create2dArray(): array
    {
        $shares2d = [];
        foreach ($this->shareDataArray as $shareOnDate) {
            // Create a date-object for unique date-values,
            // cause apparently the date-format changes in-between in the data-set.
            // Also format it properly
            $date = $this->createComparableDate($shareOnDate['Date']);

            $shares2d[$date][$shareOnDate['Name']] = $shareOnDate['Rendite'];
        }
        return $shares2d;
    }

    /**
     * @param array $faultyDates
     */
    public function deleteDatesFromDataSet(array $faultyDates)
    {
        // Count deleted rows to double-check
        $deletedRowsCount = 0;
        print_r("Delting faulty entries...\n");
        // loop through the original csv
        foreach ($this->shareDataArray as $key => $shareOnDate) {
            $date = $this->createComparableDate($shareOnDate['Date']);

            if (in_array($date, $faultyDates)) {
                // delete all entries with faulty dates
                unset($this->shareDataArray[$key]);
                $deletedRowsCount++;
            }

        }
        print_r("Deleted entries (rows): " . $deletedRowsCount . "\n");
    }

    /**
     * @param string $date
     * @return string
     */
    private function createComparableDate(string $date): string
    {
        // Create a date-object for unique date-values, cause apparently the date-format changes in-between in the data-set
        $date = new DateTime($date);
        // Format it properly and return
        return $date->format("Y-m-d");
    }

    public function writeToNewCsv()
    {
        $fileName = "stocksWithoutFaultyDates.csv";

        // delete file in case it already exists and create a new one
        unlink($fileName);
        $newCsv = fopen($fileName, 'a');

        // add headers from keys
        fputcsv($newCsv, array_keys($this->shareDataArray[0]), ";");

        foreach ($this->shareDataArray as $newRow) {
            fputcsv($newCsv, $newRow, ";");
        }

        fclose($newCsv);

        print_r("Created new csv-file without faulty dates\n");
    }

    private function getFormattedCount(array $array): string
    {
        return str_pad(count($array), 2, '0', STR_PAD_LEFT);
    }


}
