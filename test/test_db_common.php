<?php
function db_conn( &$param_conn )
{
    $host = "localhost";
    $user = "root";
    $pass = "root506";
    $charset = "utf8mb4";
    $db_name = "board";
    $dns = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
    $pdo_option = 
        array(
            PDO::ATTR_EMULATE_PREPARES      => false
            ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
            ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
        );

    try
    {
        $param_conn = new PDO( $dns, $user, $pass, $pdo_option );
    }
    catch( Exception $e)
    {
        $e->getMessage();
    }
}

//------------------------------------------------
// 함수명   : board_list
// 기능     : 게시판 리스트
// 파라미터 : Array     &$param_arr
// 리턴값   : INT/STFING       $result_cnt/ERRMSG
//------------------------------------------------



function board_list( &$param_arr )
{
    $sql =
        " SELECT "
        ." board_no " 
        ." , board_title " 
        ." , board_write_date "  
        ." FROM "
        ." board_info "
        ." WHERE "
        ." board_del_flg = '0' "
        ." ORDER BY "
        ." board_no DESC "
        ." LIMIT :limit_num OFFSET :offset "
        ;
    
    $arr_prepare = 
        array(
            ":limit_num" => $param_arr["limit_num"]
            , ":offset"      => $param_arr["offset"]
        );

    $conn = null;
    try
    {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch( Exception $e )
    {
        return $e->getMessage();
    }
    finally
    {
        $conn = null;
    }

    return $result;
    }

    // $arr = 
    //     array(
    //         "limit_num" =>5
    //         , "offset"    =>0
    //     );
    // $result = board_list( $arr );

    // print_r( $result );

?>