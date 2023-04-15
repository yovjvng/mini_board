<?php
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", SRC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER","board_header.php" );
    include_once( URL_DB );

    $http_method = $_SERVER["REQUEST_METHOD"];

    // GET 체크
    // if ( array_key_exists( "page_num", $_GET ) ) 
    // {
    //     $page_num = $_GET["page_num"];
    // }
    // else
    // {
    //     $page_num = 1; // 첫번째 화면
    // }
    // $arr_post = $_GET;



    // $page_num = $arr_get["page_num"];
    // 게시판 정보 테이블 전체 카운트 획득
    // $result_cnt = select_board_info_cnt();


    $search_re =  $_GET['search'];

        $arr_prepare = 
        array(
            "search" => $search_re
        );
        $result_search = board_search( $arr_prepare );

    // var_dump( $search_re );
    
    // $arr_prepare = 
    //     array(
    //         "search" => $search_re
    //     );
    // $result_search = board_search( $arr_prepare );
    
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
            <h1>fREE BOARD</h1>
            <div class="result">
                 <p><?php echo "'".$search_re."'"; ?> 검색결과</p>
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
                        foreach( $result_search as $recode )
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
                <form method="get" action="board_search.php">
                    <input class="sear_put" id="search" name="search" type="text" placeholder="검색" autocomplete="off">
                    <button class="form_ser" type="submit">검색</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>