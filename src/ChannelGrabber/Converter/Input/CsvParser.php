<?php

namespace ChannelGrabber\Converter\Input;

use ChannelGrabber\Converter\InputParserInterface;

/**
 * Converts a CSV string input to a multidimensional array, grouping headers with underscores into nested arrays
 *
 * Class CsvParser
 * @package ChannelGrabber\Converter\Input
 * @todo This currently only works for nesting one level deep. i.e. address_line1 but not address_lines_line1, needs replacing
 */
class CsvParser implements InputParserInterface
{
    protected CONST CSV_DELIMITER = ',';
    /** @var array */
    protected $structure;

    /**
     * @param mixed $data
     * @return array $data
     */
    public function parse(string $data): array
    {
        // Turn the string of CSV data into an array, where each element contains an array of fields for each row
        $csv = array_map('str_getcsv', str_getcsv($data,"\n"));

        // Get the headings from the first row and create a formatted headings array to store the new values in
        $headings = array_shift($csv);
        $formattedHeadings = [];

        /*
         * Loop over the headings, find any with an underscore and create a nested array with the relevant parts,
         * where no underscore exists, simply set the value as a value in the array
         */
        $count = 0;
        foreach($headings as $heading) {
            if (strpos($heading, '_') !== false) {
                $outerHeading = str_split($heading, strpos($heading, '_'));
                $formattedHeadings[$outerHeading[0]][ltrim($outerHeading[1], '_')] = $count;
            } else {
                $formattedHeadings[$heading] = $count;
            }
            $count++;
        }

        // Set the formatted headings as the structure
        $this->structure = $formattedHeadings;

        $output = [];

        /**
         * Iterate over the csv rows, then iterate over the structure.
         *  Find the relevant row field that should be mapped to the array key (as determined above) and set it
         */
        foreach ($csv as $row) {
            $data = [];
            foreach ($this->structure as $heading => $value) {
                if (is_array($value)) {
                    foreach($value as $subHeading => $subValue) {
                        $data[$heading][$subHeading] = $row[$subValue];
                    }
                } else {
                    $data[$heading] = $row[$value];
                }
            }
            $output[] = $data;
        }
        return $output;
    }
}