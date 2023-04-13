<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", SRC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER","board_header.php" );
    include_once( URL_DB );

    $http_method = $_SERVER["REQUEST_METHOD"];

    // GET 체크
    if ( array_key_exists( "page_num", $_GET ) ) 
    {
        $page_num = $_GET["page_num"];
    }
    else
    {
        $page_num = 1; // 첫번째 화면
    }


    // $arr_get = $_GET;

    $limit_num = 5;

    // $page_num = $arr_get["page_num"];
    // 게시판 정보 테이블 전체 카운트 획득
    $result_cnt = select_board_info_cnt();

    // max page number
    $max_page_num = ceil( (int)$result_cnt[0]["cnt"] / $limit_num );

    // offset
    $offset = ( $page_num * $limit_num ) - $limit_num;

    $arr_prepare = 
        array(
            "limit_num" => $limit_num
            ,"offset"   => $offset
        );
    $result_paging = select_board_info_paging( $arr_prepare );
    
    // print_r( $result_cnt );
    // print_r( $max_page_num );
    // var_dump( $max_page_num );
    // var_dump( $result_cnt );


?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/board.css">
    <link rel="stylesheet" href="./css/board_list.css">
    <title>게시판</title>
</head>
<body>
    <div class="wrap">
        <div class="main">
        <?php include_once( URL_HEADER ); ?>
            <h1>FREE BOARD</h1>
            <div class="insert">
                <button calss="insert_btn" type="button"><a href="board_insert.php">게시글 작성</a></button>
            </div>
            <table class='table table-hover'>
                <thead>
                    <tr>
                        <th>게시물 번호</th>
                        <th>게시물 제목</th>
                        <th>작성일자</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach( $result_paging as $recode )
                        {
                    ?>
                            <tr>
                                <td><?php echo $recode["board_no"] ?></td>
                                <td><a href="board_detail.php?board_no=<?php echo $recode["board_no"] ?>"><?php echo $recode["board_title"] ?></a></td>
                                <td><?php echo $recode["board_write_date"] ?></td>
                            </tr>
                    <?php
                        }
                    ?>

                </tbody>
            </table>
            <div class="nav-form">
                <form action="search"><i class="fas fa-search"></i>
                    <input class="sear_put" type="text" placeholder="검색">
                </form>
            </div>
            <div class="btn_con">
                    <a href='board_list.php?page_num=1'>first</a>   
                    <div class="btn_con_num">
                        <?php
                            for( $i = 1; $i <= $max_page_num; $i++ )
                            {
                        ?>       
                                <a href='board_list.php?page_num=<?php echo $i ?>'><?php echo $i ?></a>
                        <?php
                            }
                        ?>
                    </div>
                    <a href='board_list.php?page_num=<?php echo $max_page_num ?>'>end</a>
            </div>
        </div>
    </div>
</body>
</html>