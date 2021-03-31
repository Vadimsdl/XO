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
                $arr[$i+2] = $hod;
                $arrs = $arr;
                return $i+2;
            }
            if( $arr[$i+1][0] != '-1' && $arr[$i][0] == '-1' && $arr[$i+1][0] == $arr[$i+2][0] && $arr[$i+1][0] == $hod ) {
                $arr[$i] = $hod;
                $arrs = $arr;
                return $i;
            }
            if( $arr[$i][0] != '-1' && $arr[$i+1][0] == '-1' && $arr[$i][0] == $arr[$i+2][0] && $arr[$i][0] == $hod ) {
                $arr[$i+1] = $hod;
                $arrs = $arr;
                return $i+1;
            }
        }
        for( $i = 1; $i < 4; $i++ ) {
            
            if( $arr[$i][0] != '-1' && $arr[$i+6][0] == '-1' && $arr[$i][0] == $arr[$i+3][0] && $arr[$i][0] == $hod ) {
                $arr[$i+6] = $hod;
                $arrs = $arr;
                return $i+6;
            }
            if( $arr[$i+3][0] != '-1' && $arr[$i][0] == '-1' && $arr[$i+3][0] == $arr[$i+6][0] && $arr[$i+3][0] == $hod ) {
                $arr[$i] = $hod;
                $arrs = $arr;
                return $i;
            }
            if( $arr[$i][0] != '-1' && $arr[$i+3][0] == '-1' && $arr[$i][0] == $arr[$i+6][0] && $arr[$i][0] == $hod ) {
                $arr[$i+3] = $hod;
                $arrs = $arr;
                return $i+3;
            }
        }
        
        if( $arr[1][0] != '-1' && $arr[9][0] == '-1' && $arr[1][0] == $arr[5][0] && $arr[1][0] == $hod ) {
            $arr[9] = $hod;
            $arrs = $arr;
            return 9;
        }
        if( $arr[5][0] != '-1' && $arr[1][0] == '-1' && $arr[5][0] == $arr[9][0] && $arr[5][0] == $hod ) {
            $arr[1] = $hod;
            $arrs = $arr;
            return 1;
        } 
        if( ( $arr[1][0] != '-1' && $arr[5][0] == '-1' && $arr[1][0] == $arr[9][0] && $arr[1][0] == $hod ) || 
        ( $arr[3][0] != '-1' && $arr[5][0] == '-1' && $arr[3][0] == $arr[7][0] && $arr[3][0] == $hod ) ) {
            $arr[5] = $hod;
            $arrs = $arr;
            return 5;
        }
        if( $arr[3][0] != '-1' && $arr[7][0] == '-1' && $arr[3][0] == $arr[5][0] && $arr[3][0] == $hod ) {
            $arr[7] = $hod;
            $arrs = $arr;
            return 7;
        } 
        if( $arr[5][0] != '-1' && $arr[3][0] == '-1' && $arr[5][0] == $arr[7][0] && $arr[3][0] == $hod ) {
            $arr[5] = $hod;
            $arrs = $arr;
            return 3;
        }

        /* проверка на победу противника */
        for( $i = 1; $i < 9; $i+=3 ) {
        
            if( $arr[$i][0] != '-1' && $arr[$i+2][0] == '-1' && $arr[$i][0] == $arr[$i+1][0] && $arr[$i][0] == $hod_now ) {
                $arr[$i+2] = $hod;
                $arrs = $arr;
                return $i+2;
            }
            if( $arr[$i+1][0] != '-1' && $arr[$i][0] == '-1' && $arr[$i+1][0] == $arr[$i+2][0] && $arr[$i+1][0] == $hod_now ) {
                $arr[$i] = $hod;
                $arrs = $arr;
                return $i;
            }
            if( $arr[$i][0] != '-1' && $arr[$i+1][0] == '-1' && $arr[$i][0] == $arr[$i+2][0] && $arr[$i][0] == $hod_now ) {
                $arr[$i+1] = $hod;
                $arrs = $arr;
                return $i+1;
            }
        }
        for( $i = 1; $i < 4; $i++ ) {
            if( $arr[$i][0] != '-1' && $arr[$i+6][0] == '-1' && $arr[$i][0] == $arr[$i+3][0] && $arr[$i][0] == $hod_now ) {
                $arr[$i+6] = $hod;
                $arrs = $arr;
                return $i+6;
            }
            if( $arr[$i+3][0] != '-1' && $arr[$i][0] == '-1' && $arr[$i+3][0] == $arr[$i+6][0] && $arr[$i+3][0] == $hod_now ) {
                $arr[$i] = $hod;
                $arrs = $arr;
                return $i;
            }
            if( $arr[$i][0] != '-1' && $arr[$i+3][0] == '-1' && $arr[$i][0] == $arr[$i+6][0] && $arr[$i][0] == $hod_now ) {
                $arr[$i+3] = $hod;
                $arrs = $arr;
                return $i+3;
            }
        }
        if( $arr[1][0] != '-1' && $arr[9][0] == '-1' && $arr[1][0] == $arr[5][0] && $arr[1][0] == $hod_now ) {
            $arr[9] = $hod;
            $arrs = $arr;
            return 9;
        }
        if( $arr[5][0] != '-1' && $arr[1][0] == '-1' && $arr[5][0] == $arr[9][0] && $arr[5][0] == $hod_now ) {
            $arr[1] = $hod;
            $arrs = $arr;
            return 1;
        } 
        if( ( $arr[1][0] != '-1' && $arr[5][0] == '-1' && $arr[1][0] == $arr[9][0] && $arr[1][0] == $hod_now ) || 
        ( $arr[3][0] != '-1' && $arr[5][0] == '-1' && $arr[3][0] == $arr[7][0] && $arr[3][0] == $hod_now ) ) {
            $arr[5] = $hod;
            $arrs = $arr;
            return 5;
        }
        if( $arr[3][0] != '-1' && $arr[7][0] == '-1' && $arr[3][0] == $arr[5][0] && $arr[3][0] == $hod_now ) {
            $arr[7] = $hod;
            $arrs = $arr;
            return 7;
        } 
        if( $arr[5][0] != '-1' && $arr[3][0] == '-1' && $arr[5][0] == $arr[7][0] && $arr[5][0] == $hod_now ) {
            $arr[3] = $hod;
            $arrs = $arr;
            return 3;
        }
        $count = randhod($arr);
        $arr[$count][0] = $hod;
        return $count;
    } else {
        return 1000;
    }
    return -1;
}

function randhod( $arr ) {
    $rand_arr[] = array();
    for( $i = 1 ; $i < count( $arr ) ; $i++ ){
        if($arr[$i][0] == '-1' ) {
            array_push( $rand_arr, $i);
        }
    }
    if( count( $rand_arr ) > 1 ) {
        $rand = mt_rand(1, count( $rand_arr )-1 );
    } else {
        return -2;
    }
    return $rand_arr[$rand];
}

if( $_REQUEST['bot_game'] == 'true' ) {
    $_REQUEST['bots'] = robot($_REQUEST['arr'], $_REQUEST['bot_hod'], $_REQUEST['hod_now']);
    if( $arrs != null )
        $_REQUEST['arr'] = $arrs;
} else {
    $_REQUEST['bots'] = 9999;
}

$_REQUEST['res'] = proverka( $_REQUEST['arr'] );
echo json_encode($_REQUEST);

?>