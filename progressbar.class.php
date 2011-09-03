<?php

/**
 * Creates and draws a progress bar using GD
 * @author Danilo Bargen <gezuru@gmail.com>
 * @license LGPLv3
 * @param $curVal int (Current value (x in x/y))
 * @param optional $maxVal int (Max value (y in x/y), default 100)
 * @param optional $width int (Width of progressbar in pixels, default 500)
 * @param optional $height int (Height of progressbar in pixels, default 20)
 * @param optional $absVal bool (true or false, display absolute values instead of percent values, default false)
 * @param optional $suffix string (String to append to the numbers if absVal=true, default none)
 */
class progressBar
{
    private $curVal;
    private $maxVal;
    private $width;
    private $height;
    private $absVal;
    private $suffix;

    private $backgroundColor = Array(255, 255, 255);
    private $borderColor = Array(0, 0, 0);
    private $progressColor = Array(238, 181, 12);
    private $fontColor = Array(0, 0, 0);

    /**
     * Constructor
     */
    function __construct($curVal, $maxVal=100, $width=500, $height=20, $absVal=false, $suffix='')
    {
        $maxVal = ($maxVal === NULL) ? 100 : $maxVal;
        $width = ($width === NULL) ? 500 : $width;
        $height = ($height === NULL) ? 20 : $height;
        $this->curVal = $curVal;
        $this->maxVal = $maxVal;
        $this->width = $width;
        $this->height = $height;
        $this->absVal = $absVal;
        $this->suffix = $suffix;
    }

    /**
     * Sets the current value
     * @param $curVal int (Current value)
     * @param optional $maxVal int (Max value (y in x/y), default 100)
     */
    public function setValue($curVal, $maxVal=100)
    {
        $this->curVal = $curVal;
        $this->maxVal = $maxVal;
    }

    /**
     * Sets the dimensions
     * @param $width int (Width of progressbar in pixels)
     * @param $height int (Height of progressbar in pixels)
     */
    public function setSize($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Sets the suffix string
     * @param $suffix string
     */
    public function setSuffix($suffix) {
        $this->suffix = $suffix;
    }

    /**
     * Sets whether to use absolute values or not
     * @param $absVal bool (true or false, display absolute values instead of percent values)
     */
    public function setAbsVal($absVal) {
        $this->absVal = $absVal;
    }

    /**
     * Sets the background color
     * @param $r int (Red value (0-255))
     * @param $g int (Green value (0-255))
     * @param $b int (Blue value (0-255))
     */
    public function setBackgroundColor($r, $g, $b)
    {
        $this->backgroundColor[0] = $r;
        $this->backgroundColor[1] = $g;
        $this->backgroundColor[2] = $b;
    }

    /**
     * Sets the border color
     * @param $r int (Red value (0-255))
     * @param $g int (Green value (0-255))
     * @param $b int (Blue value (0-255))
     */
    public function setBorderColor($r, $g, $b)
    {
        $this->borderColor[0] = $r;
        $this->borderColor[1] = $g;
        $this->borderColor[2] = $b;
    }

    /**
     * Sets the progress color
     * @param $r int (Red value (0-255))
     * @param $g int (Green value (0-255))
     * @param $b int (Blue value (0-255))
     */
    public function setProgressColor($r, $g, $b)
    {
        $this->progressColor[0] = $r;
        $this->progressColor[1] = $g;
        $this->progressColor[2] = $b;
    }

    /**
     * Sets the font color
     * @param $r int (Red value (0-255))
     * @param $g int (Green value (0-255))
     * @param $b int (Blue value (0-255))
     */
    public function setFontColor($r, $g, $b)
    {
        $this->fontColor[0] = $r;
        $this->fontColor[1] = $g;
        $this->fontColor[2] = $b;
    }

    /**
     * Draws the progressbar, content-type is image/png
     */
    public function draw()
    {
        // Set content-type
        header('Content-type: image/png');

        // Create image
        $image = @imagecreate($this->width, $this->height);

        // Define colors
        $backgroundColor = imagecolorallocate($image, $this->backgroundColor[0], $this->backgroundColor[1], $this->backgroundColor[2]);
        $borderColor = imagecolorallocate($image, $this->borderColor[0], $this->borderColor[1], $this->borderColor[2]);
        $progressColor = imagecolorallocate($image, $this->progressColor[0], $this->progressColor[1], $this->progressColor[2]);
        $fontColor = imagecolorallocate($image, $this->fontColor[0], $this->fontColor[1], $this->fontColor[2]);

        // Calculate progress width and percent
        $progressPercent = round($this->curVal/$this->maxVal*100, 1);
        $progressWidth = round($this->curVal*$this->width/$this->maxVal, 0);
        
        // Draw progressbar
        imagefilledrectangle($image, 0, 0, $progressWidth, $this->height-1, $progressColor);
        imagerectangle($image, 0, 0, $this->width-1, $this->height-1, $borderColor);

        // Draw text
        $textPosX = 5;
        $textPosY = $this->height/2-7;
        if ($this->absVal == 1)
        {
            $string = $this->curVal." / ".$this->maxVal." ".$this->suffix;
        }
        else
        {
            $string = $progressPercent."%";
        }
        imagestring($image, 3, $textPosX, $textPosY, $string, $fontColor);

        // Show image
        imagepng($image);
    }

}

?>
