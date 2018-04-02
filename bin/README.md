# ChannelGrabber Technical Test
This project provides a script that allows you to convert a given CSV file into XML or Json.

## Requirements
**PHP 7.0 or greater**  

composer install:  

`composer install`  

a CSV in the following format:  
```
heading,heading_subheading1,heading_subheading2
Heading Value,Suheading 1 value,Subheading 2 value
```

## Running The Script
To get information on how to use the script, run the following:  
`bin/console converter:convert-csv --help`

currently supported options for the format are `XML` and `JSON`, if none are provided it will default to json

example:  

`bin/console converter:convert-csv resources/input.csv`  

or:  

`bin/console converter:convert-csv resources/input.csv -f XML`

## Tests
to run the available unit tests:  

`./vendor/bin/phpunit`