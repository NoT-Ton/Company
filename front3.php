
<?php
$a=[11,28,19,49,7];
$b = 0;
foreach ($a as $key=>$val) {
    if ($val > $b) {
        $b = $val;
    }
}
echo $b;
?>