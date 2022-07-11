<?php
$userdb = array(
	'1' => array(
		'maqh'	=>	'001',
		'name'	=>	'Test 1',
		'matp'	=>	'01'
	),
	'2' => array(
		'maqh'	=>	'002',
		'name'	=>	'Test 3',
		'matp'	=>	'002'
	),
	'3' => array(
		'maqh'	=>	'003',
		'name'	=>	'Test 2',
		'matp'	=>	'02'
	),
	'4' => array(
		'maqh'	=>	'004',
		'name'	=>	'Test 4',
		'matp'	=>	'02'
	)
);
function search_in_array($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search_in_array($subarray, $key, $value));
        }
    }

    return $results;
}
$value = search_in_array($userdb, 'matp', '02');

echo '<pre>';
print_r($value);
echo '</pre>';
