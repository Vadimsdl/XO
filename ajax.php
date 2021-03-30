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


$arrs = null;
function robot( $arr, $hod, $hod_now ) {
    global $arrs;
    if( $hod != $hod_now ) {    
        for( $i = 1; $i < 9; $i+=3 ) {
        
            if( $arr[$i][0] != '-1' && $arr[$i+2][0] == '-1' && $arr[$i][0] == $arr[$i+1][0] && $arr[$i][0] == $hod ) {
                $arr[$i+2] = $arr[$i];
                $arrs = $arr;
                return $i+2;
            }
            if( $arr[$i+1][0] != '-1' && $arr[$i][0] == '-1' && $arr[$i+1][0] == $arr[$i+2][0] && $arr[$i+1][0] == $hod ) {
                $arr[$i] = $arr[$i+1];
                $arrs = $arr;
                return $i;
            }
            if( $arr[$i][0] != '-1' && $arr[$i+1][0] == '-1' && $arr[$i][0] == $arr[$i+2][0] && $arr[$i][0] == $hod ) {
                $arr[$i+1] = $arr[$i];
                $arrs = $arr;
                return $i+1;
            }

        }
        for( $i = 1; $i < 4; $i++ ) {
            
            if( $arr[$i][0] != '-1' && $arr[$i+6][0] == '-1' && $arr[$i][0] == $arr[$i+3][0] && $arr[$i][0] == $hod ) {
                $arr[$i+6] = $arr[$i];
                $arrs = $arr;
                return $i+6;
            }
            if( $arr[$i+3][0] != '-1' && $arr[$i][0] == '-1' && $arr[$i+3][0] == $arr[$i+6][0] && $arr[$i+3][0] == $hod ) {
                $arr[$i] = $arr[$i+3];
                $arrs = $arr;
                return $i;
            }
            if( $arr[$i][0] != '-1' && $arr[$i+3][0] == '-1' && $arr[$i][0] == $arr[$i+6][0] && $arr[$i][0] == $hod ) {
                $arr[$i+3] = $arr[$i];
                $arrs = $arr;
                return $i+3;
            }
        
        }
        
        if( $arr[1][0] != '-1' && $arr[9][0] == '-1' && $arr[1][0] == $arr[5][0] && $arr[1][0] == $hod ) {
            $arr[9] = $arr[1];
            $arrs = $arr;
            return 9;
        }
        if( $arr[5][0] != '-1' && $arr[1][0] == '-1' && $arr[5][0] == $arr[9][0] && $arr[5][0] == $hod ) {
            $arr[1] = $arr[5];
            $arrs = $arr;
            return 1;
        } 
        if( ( $arr[1][0] != '-1' && $arr[5][0] == '-1' && $arr[1][0] == $arr[9][0] && $arr[1][0] == $hod ) || 
        ( $arr[3][0] != '-1' && $arr[5][0] == '-1' && $arr[3][0] == $arr[7][0]&& $arr[3][0] == $hod ) ) {
            $arr[5] = $hod;
            $arrs = $arr;
            return 5;
        }
        if( $arr[3][0] != '-1' && $arr[7][0] == '-1' && $arr[3][0] == $arr[5][0] && $arr[3][0] == $hod ) {
            $arr[7] = $arr[3];
            $arrs = $arr;
            return 7;
        } 
        if( $arr[5][0] != '-1' && $arr[3][0] == '-1' && $arr[5][0] == $arr[7][0] && $arr[5][0] == $hod ) {
            $arr[5] = $arr[3];
            $arrs = $arr;
            return 3;
        } 
    
    }
    return -1;
}

$_REQUEST['bots'] = robot($_REQUEST['arr'], $_REQUEST['bot_hod'], $_REQUEST['hod_now']);
if( $arrs != null )
    $_REQUEST['arr'] = $arrs;
$_REQUEST['res'] = proverka( $_REQUEST['arr'] );
echo json_encode($_REQUEST);

?>