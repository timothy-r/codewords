[![Build Status](https://travis-ci.org/timothy-r/codewords.png)](https://travis-ci.org/timothy-r/codewords) 


# A codewords solving app

* Read file / input into a Board in memory - based on grid cells which have a number which can map to a character
* Fill out initial letters - set the character value of a number
* Scan frequency of numbers in cells
* Discover possible Q numbers
* Use frequencies to discover possible vowels, use double chars too
* Consult Dictionary to guess at words


# Classes:

* Board contains a grid of Cells
* Cell has a number and can have its character set via the mapping of numbers to characters
* Use 26 Cells and store references to them in the Board
* Character to Number mapping?
* DataReader - string / file to Board
* Game to contain parts of the puzzle - removed
* Dictionary - allows lookups based on reg exp patterns

A Player that interacts with the Board/Game/Dictionary objects
