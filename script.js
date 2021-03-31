$(document).ready( function(){
    var glob_hod = 1;
    var arr = [];
    for( var i = 1; i < 10; i++ )
        arr[i] = ['-1'];
    var result = null;
    var count = arr.length-1;
    var next_pos = -1;
    var type_of_game = false;

    $( '.game_who > h4' ).on( 'click', function() {

        if( type_of_game ) {
            type_of_game = false;
        } else {
            type_of_game = true;
        }

        if( type_of_game ) {
            $( this ).text( 'против компуктера' );
            $( '.title-hod' ).fadeOut( 'slow' );
        } else {
            $( this ).text( '1 на 1' );
            $( '.title-hod' ).fadeIn( 'slow' );
        }
        console.log( type_of_game );
    });
    
    $( '.reload' ).on( 'click', function() {

        glob_hod = 1;
        arr = [];
        for( var i = 1; i < 10; i++ )
            arr[i] = ['-1'];
        result = null;
        count = arr.length-1;
        next_pos = -1;

        $('h2').fadeOut( 'slow' );
        $( '.line' ).fadeOut( 'slow' );
        $( '.cirkl' ).fadeOut( 'slow' );

    });
    
    $( '.kletka' ).on( 'click', function() {
        var key = $( this ).attr( 'data-kletka' );
        
        /* Записываем в массив чей был ход, при помощи поиска номера поля в массиве */
        if( $( '.cirkl-' + key ).css( 'display' ) == 'none' && $( '.line-' + key ).css( 'display' ) == 'none' && result === null ) {
        
            count -=1;
            arr[key][0] = glob_hod;
            
            /* ставим соответствующий знак о или х */
            if( glob_hod == 0 )
                $( '.cirkl-' + key ).fadeIn( 'slow' );
            else
                $( '.line-' + key ).fadeIn( 'slow' );
            
            if( count == 0 ) {
                $('h2').text( 'Ничья' );
                $('h2').fadeIn( 'slow' );
            }
        
            $.ajax({
                url: 'ajax.php',
                method: 'POST',
                data: { 
                    arr: arr,
                    bot_hod: 0,
                    hod_now: glob_hod,
                    bot_game: type_of_game,
                },
                dataType: 'json',
                success: function( data ) {
                    /* проверка на ( занята ли клетка )? */
               
                 /* смена хода */  
                    glob_hod == 0 ? glob_hod = 1 : glob_hod = 0;
                    if( glob_hod == 0 )
                        $( '.title-hod > span' ).text( ' O ' );
                    else $( '.title-hod > span' ).text( ' X ' );
                    
                    if( data.bots != -1 && glob_hod == 0 && data.bots != -2 && data.bot_game == 'true' ) {
                        arr[data.bots][0] = glob_hod;
                        if( data.res === null || data.res === false ) {
                            if( glob_hod == 0 )
                                $( '.cirkl-' + data.bots ).fadeIn( 'slow' );
                            else
                                $( '.line-' + data.bots ).fadeIn( 'slow' ); 
                        }
                        glob_hod == 0 ? glob_hod = 1 : glob_hod = 0;
                        
                    }
                    
                    /* Кто то победил ????? */
                    result = data.res;
                    if( data.res === true ) {
                        $('h2').text( 'Победа крестов' );
                        $('h2').fadeIn( 'slow' );
                        $( '.people' ).text( parseInt( $( '.people' ).text( ) )+1 )
                        return false;
                    } else if( data.res === false ) {
                        $('h2').text( 'Победа нулей' );
                        $('h2').fadeIn( 'slow' );
                        $( '.bot' ).text( parseInt( $( '.bot' ).text( ) )+1 )
                        return false;
                    } else if( data.bots == -2 ) {
                        $('h2').text( 'Ничья' );
                        $('h2').fadeIn( 'slow' );
                        return false;
                    }
                     
                }, 
                error: function() {
                    console.log( 'error' );
                }
            });
        } else if ( count == 0 ) {
            $('h2').text( 'Ничья' );
            $('h2').fadeIn( 'slow' );
            return false;
        } else {
            return false;
        }
    });
});