<?php


namespace App\Tests;


class ConwaySuite
{
    private $lineJump = "\n";
    private $spaceSeparator = " ";
    private $emptyString = "";

    public function draw($line, $deep): string
    {
        return $this->drawSourceLine($line) . $this->drawSuite($line, $deep, $this->emptyString);
    }

    public function drawSuite($line, $deep, $conwaySuite): string
    {
        if($deep === 0){
            return $conwaySuite;
//            return $conwaySuite . $this->drawNextLine($line);
        }
        $nextLine = $this->drawNextLine($line);
        return $this->drawSuite($nextLine, $deep - 1,
            $this->accumulateNextLine($conwaySuite, $nextLine));
//            (empty($conwaySuite) ? $conwaySuite : $conwaySuite . $this->lineJump) . $nextLine);
//        return $this->drawSuite($nextLine, $deep - 1, $conwaySuite . $this->lineJump . $nextLine);
        //return $this->drawNextLine($line) . $this->lineJump . $this->drawNextLine($this->drawNextLine($line));
    }

    public function accumulateNextLine($conwaySuite, $nextLine): string
    {
        return $this->prependSuite($conwaySuite). $nextLine;
    }

    public function prependSuite($conwaySuite)
    {
        return empty($conwaySuite) ? $conwaySuite : $conwaySuite . $this->lineJump;
    }

    public function drawSourceLine($line): string
    {
        return $line . $this->lineJump;
    }

    public function drawNextLine($line): string
    {
        $compressedLine = $this->removeLineSpaces($line);
        //if(strlen($compressedLine) > 1 && $compressedLine[0] !== $compressedLine[1]){
            return $this->drawLineChunks($compressedLine, $this->emptyString);
        //}
        //return $this->countConsecutiveLineNumbers($compressedLine);
    }

    public function drawLineChunks($compressedLine, $chunks): string
    {
        if(empty($compressedLine)){
            return trim($chunks);
        }
        $indexOfNextDistinctNumber = $this->indexOfNextDistinctNumber($compressedLine, 0);
//        if(strlen($compressedLine) > 1 && $compressedLine[0] !== $compressedLine[1]){
            return $this->drawLineChunks(
                $this->tail($compressedLine, $indexOfNextDistinctNumber + 1),
                    $this->accumulateChunk($compressedLine, $chunks, $indexOfNextDistinctNumber) . $this->spaceSeparator);
//        }
//        return $chunks . $this->countConsecutiveLineNumbers($compressedLine);
        //return $this->countConsecutiveLineNumbers(substr($compressedLine, 0, 1))
            //. $this->spaceSeparator . $this->countConsecutiveLineNumbers(substr($compressedLine, 1));
    }

    public function accumulateChunk($compressedLine, $chunks, $indexOfNextDistinctNumber): String
    {
        return $chunks . $this->countConsecutiveLineNumbers(substr($compressedLine, 0, $indexOfNextDistinctNumber + 1));
    }

    public function tail($compressedLine, $i): String
    {
        return substr($compressedLine, $i);
    }

    public function indexOfNextDistinctNumber($compressedLine, $index)
    {
        if($this->hasOnlyOneNumber($compressedLine)|| $this->isNextNumberDistinct($compressedLine)){
            return $index;
        }
        return $this->indexOfNextDistinctNumber($this->tail($compressedLine, 1), $index + 1);
    }

    public function isNextNumberDistinct($compressedLine): bool
    {
        return $compressedLine[0] !== $compressedLine[1];
    }

    public function hasOnlyOneNumber($compressedLine): bool
    {
        return strlen($compressedLine) === 1;
    }

    public function removeLineSpaces($line): string
    {
        return str_replace($this->spaceSeparator, $this->emptyString, $line);
    }

    public function countConsecutiveLineNumbers($compressedLine): string
    {
        return strlen($compressedLine) . $this->spaceSeparator . $compressedLine[0];
    }
}
