<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );

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
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <title>게시판</title>
    <style>
    *
    {
        text-align: center;
        margin: 0;
        padding: 0;
        font-family: 'Times New Roman', Times, serif;
    }  
    a
    {
        text-decoration: none;
        color: #333;
    }
    h1
    {
        font-size: 70px;
    }
    .main
    {
        background-image: url(./paper1.jpg);
        /* background-repeat: no-repeat; */
        background-size: cover;
        border: 1px solid #efefef;
        /* width: 100%; */
        height: 100%;
        margin: 10px;
        padding: 20px;
    }
    .search
    {
        position: relative;
        display: inline-block;
        float: right;
        margin: 10px;
    }
    .sear
    {
        display: inline-block;
        width: 100px;
        height: 25px;
    }
    i
    {
        position: absolute;
        right: 20px;
        top: 20px;
    }
    tr:hover {
        opacity: 0.7;
    }
    .btn
    {
        border-radius: 25px;
    }
    .btn_con
    {
        margin: 100px 0 0;
    }

    .btn_con.btn
    {
        margin: 0 10px;
    }
    /* a:hover
    {
        background-color: #d3e7dd;
    } */

    </style>
</head>
<body>
    <div class="main">
        <h1>FREE BOARD</h1>
        <div class="search">
        <i class="gg-search"></i>
        <input type="text" class="sear">
        </div>
        <!-- <table class='table table-striped'> -->
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
                            <td><a href="board_update.php?board_no=<?php echo $recode["board_no"] ?>"><?php echo $recode["board_title"] ?></a></td>
                            <td><?php echo $recode["board_write_date"] ?></td>
                        </tr>
                <?php
                    }
                ?>

            </tbody>
        </table>
        <div class="btn_con">
                <a href='board_list.php?page_num=1'>first</a>
                <div class="btn">
                    <?php
                        for( $i = 1; $i <= $max_page_num; $i++ )
                        {
                    ?>       
                            <a href='board_list.php?page_num=<?php echo $i ?>'><?php echo $i ?></a>
                    <?php
                        }
                    ?>
                </div>
                <a href='board_list.php?max_page_num=<?php echo $i ?>'>end</a>
        </div>
    </div>
</body>
</html>