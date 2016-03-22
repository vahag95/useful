<?php
/* Sort $data by key(Date)*/
usort($data,'invenDescSort');

function invenDescSort($item1,$item2)
{	
    if ($item1['Date'] == $item2['Date']) return 0;
    return ($item1['Date'] < $item2['Date']) ? 1 : -1;
}
?>