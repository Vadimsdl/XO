$(document).ready( function(){

    var glob_hod = 0;
    var arr = [];
    for( var i = 1; i < 10; i++ )
        arr[i] = [];
    var count = 0;
    var p = undefined;

    $( '.kletka' ).on( 'click', function() {
        
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: { hod: glob_hod, key: $( this ).attr( 'data-kletka' ) },
            dataType: 'json',
            success: function( data ) {
                //console.log( data.key % 3 );
                if( p === undefined ) {
                    if( $( '.cirkl-'+data.key ).css( 'display' ) == 'none' && $( '.line-'+data.key ).css( 'display' ) == 'none' ) {
                
                        if( glob_hod == 0 )
                            glob_hod = 1;
                        else glob_hod = 0;
                        count +=1;
                        if( data.hod == 0 ) {
                            $( '.cirkl-'+data.key ).fadeIn( 'slow' );
                            arr[data.key].push( data.hod );
                        } else {
                            $( '.line-'+data.key ).fadeIn( 'slow' );
                            arr[data.key].push( data.hod );
                    
                        }
                    }
                 
                    if( count > 3 )
                    p = proverka( arr );
                    if( p === true ) {
                        $('h2').text( 'Победа крестов' );
                        $('h2').fadeIn( 'slow' );
                    } else if( p === false ) {
                        $('h2').text( 'Победа нулей' );
                        $('h2').fadeIn( 'slow' );
                    }
                } else {
                    return false;
                }

            }, 
            error: function() {
                console.log( 'error' );
            }
        });
    });

    function proverka( arr ) {
        for( var i = 1; i < 9; i+=3 ){
            if( arr[i][0] == '1' && arr[i+1][0] == '1' && arr[i+2][0] == '1' ) {
                return true;
            }
            if( arr[i][0] == '0' && arr[i+1][0] == '0' && arr[i+2][0] == '0' ) {
                return false;            }
        }
        for( var i = 1; i < 4; i++ ) {
            if( arr[i][0] == '1' && arr[i+3][0] == '1' && arr[i+6][0] == '1' ) {
                return true;
            }
            if( arr[i][0] == '0' && arr[i+3][0] == '0' && arr[i+6][0] == '0' ) {
                return false;
            }
        }
        if( ( arr[1][0] == '1' && arr[5][0] == '1' && arr[9][0] == '1' ) || 
            ( arr[3][0] == '1' && arr[5][0] == '1' && arr[7][0] == '1' ) ) {
            return true;
        }
        if( ( arr[1][0] == '0' && arr[5][0] == '0' && arr[9][0] == '0' ) || 
            ( arr[3][0] == '0' && arr[5][0] == '0' && arr[7][0] == '0' ) ) {
            return false;
        }
    }


});