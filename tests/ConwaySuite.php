<?php


namespace App\Tests;


class ConwaySuite
{
    private $lineJump = "\n";
    private $spaceSeparator = " ";
    private $emptyString = "";

    public function draw($line): string
    {
        return $this->drawSourceLine($line) . $this->drawNextLine($line);
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
        if(strlen($compressedLine) > 1 && $compressedLine[0] !== $compressedLine[1]){
            return $this->drawLineChunks(substr($compressedLine, 1),
                $chunks . $this->countConsecutiveLineNumbers(substr($compressedLine, 0, 1)) . $this->spaceSeparator);
        }
        return $chunks . $this->countConsecutiveLineNumbers($compressedLine);
        //return $this->countConsecutiveLineNumbers(substr($compressedLine, 0, 1))
            //. $this->spaceSeparator . $this->countConsecutiveLineNumbers(substr($compressedLine, 1));
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
