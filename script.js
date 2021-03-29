$(document).ready( function(){

    var glob_hod = 0;
    var arr = [];
    for( var i = 1; i < 10; i++ )
        arr[i] = ['-1'];
    var result = null;
    var count = arr.length-1;


    $( '.kletka' ).on( 'click', function() {
        
        var key = $( this ).attr( 'data-kletka' );
        
        /* Записываем в массив чей был ход, при помощи поиска номера поля в массиве */
        if( $( '.cirkl-' + key ).css( 'display' ) == 'none' && $( '.line-' + key ).css( 'display' ) == 'none' && result === null ) {
        
            count -=1;
            console.log( count );
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
                },
                dataType: 'json',
                success: function( data ) {
                    /* проверка на ( занята ли клетка )? */
                    /* Кто то победил ????? */
                    result = data.res;
                    if( data.res === true ) {
                        $('h2').text( 'Победа крестов' );
                        $('h2').fadeIn( 'slow' );
                        return false;
                    } else if( data.res === false ) {
                        $('h2').text( 'Победа нулей' );
                        $('h2').fadeIn( 'slow' );
                        return false;
                    } 
                    /* смена хода */  
                    glob_hod == 0 ? glob_hod = 1 : glob_hod = 0;
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