<?php  
/**
* générateur de uuid
*/
class momo_uuid
{
	function genere(){
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', 
        mt_rand( 0, 0xffff), mt_rand( 0, 0xffff),

        mt_rand( 0, 0xffff),

        mt_rand( 0, 0x4fff) | 0x4000,

        mt_rand( 0, 0x3fff) | 0x8000,
        
        mt_rand( 0, 0xffff), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff)

        );
    }
}

?>