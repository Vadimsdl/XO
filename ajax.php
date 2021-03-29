<?php

//var_dump($_REQUEST);

function proverka( $arr ) {

    for( $i = 1; $i < 9; $i+=3 ){
        if( $arr[$i][0] == '1' && $arr[$i+1][0] == '1' && $arr[$i+2][0] == '1' ) {
            return true;
        }
        if( $arr[$i][0] == '0' && $arr[$i+1][0] == '0' && $arr[$i+2][0] == '0' ) {
            return false;            
        }
    }
    for( $i = 1; $i < 4; $i++ ) {
        if( $arr[$i][0] == '1' && $arr[$i+3][0] == '1' && $arr[$i+6][0] == '1' ) {
            return true;
        }
        if( $arr[$i][0] == '0' && $arr[$i+3][0] == '0' && $arr[$i+6][0] == '0' ) {
            return false;
        }
    }
    if( ( $arr[1][0] == '1' && $arr[5][0] == '1' && $arr[9][0] == '1' ) || 
        ( $arr[3][0] == '1' && $arr[5][0] == '1' && $arr[7][0] == '1' ) ) {
        return true;
    }
    if( ( $arr[1][0] == '0' && $arr[5][0] == '0' && $arr[9][0] == '0' ) || 
        ( $arr[3][0] == '0' && $arr[5][0] == '0' && $arr[7][0] == '0' ) ) {
        return false;
    }

}
$_REQUEST['res'] = proverka( $_REQUEST['arr'] );

echo json_encode($_REQUEST);

?>