<?php
function printOptions ($options, $parent, $level=0)
{
    foreach ($options as $opt)
    {
       if ($parent == $opt['parentid'])
       {
           $indent = str_repeat('---', $level); 
           echo "<option value='{$opt['id']}'>$indent {$opt['name']}</option>\n";
           printOptions($options, $opt['id'], $level+1);
       }
             
    }
}

$options = array (
    Array
        (
            'id' => 19,
            'name' => 'Food',
            'parentid' => 1,
            'type' => 1
        ),

    Array
        (
            'id' => 32,
            'name' => 'Apple',
            'parentid' => 19,
            'type' => 1
        ),

    Array
        (
            'id' => 33,
            'name' => 'Orange',
            'parentid' => 19,
            'type' => 2
        )
);

echo "<select name='myselect'>\n" ;
// call function
printOptions ($options,1);
echo "</select>\n";
?>