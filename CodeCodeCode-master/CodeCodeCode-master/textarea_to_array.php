/*
Web http://levantoan.com
*/
************* Input value
0|0|test
12|40|test
************ Array output
Array
(
    [0] => Array
        (
            [0] => 0
            [1] => 0
            [2] => test
        )

    [1] => Array
        (
            [0] => 12
            [1] => 40
            [2] => test
        )

)

************************ Function


function string_to_array($options){
  if ( $options ) {
			$options = (array) explode( "\n", $options );
			if ( sizeof( $options ) > 0) {
				foreach ( $options as $option => $value ) {
					$value = trim( $value );
					$value = str_replace( array( "/", "," ), "|", $value );
					$rate = explode( "|", $value );
					foreach ( $rate as $key => $val ) {
						$rate[$key] = trim( $val );
					}
					if ( !isset( $rate[2] ) ) {
						$rate[2] = null;
					}
					$rates[] = $rate;
				}
			}
		}	  
		return( $rates );
}
