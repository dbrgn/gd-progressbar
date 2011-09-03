gd-progressbar
==============

This is a simple PHP class that I created some time ago. It does nothing fancy, just creating a
simple GD based progress bar. Probably there are many other classes like this out there :)

Usage
-----

Constructor:

    function __construct($curVal, $maxVal=100, $width=500, $height=20, $absVal=false, $suffix='')

Methods:

    public function setValue($curVal, $maxVal=100)
    public function setSize($width, $height)
    public function setSuffix($suffix)
    public function setAbsVal($absVal)
    public function setBackgroundColor($r, $g, $b)
    public function setBorderColor($r, $g, $b)
    public function setProgressColor($r, $g, $b)
    public function setFontColor($r, $g, $b)
    public function draw()

For further information, see source documentation.

Examples
--------

```php
<?php
require_once('progressbar.class.php');
$p = new progressBar(42);
$p->draw();
?>
```

![Example 1](http://github.com/gwrtheyrn/gd-progressbar/raw/master/example1.png)

```php
<?php
require_once('progressbar.class.php');
$p = new progressBar();
$p->setValue(275, 900);
$p->draw();
?>
```

![Example 2](http://github.com/gwrtheyrn/gd-progressbar/raw/master/example2.png)

```php
<?php
require_once('progressbar.class.php');
$p = new progressBar(17, 31, 400, 60);
$p->setAbsVal(true);
$p->setSuffix('days');
$p->setProgressColor(100, 150, 200);
$p->setFontColor(220, 220, 255);
$p->setBackgroundColor(220, 220, 255);
$p->draw();
?>
```

![Example 3](http://github.com/gwrtheyrn/gd-progressbar/raw/master/example3.png)

License
-------

LGPLv3 http://www.gnu.org/licenses/lgpl.html
