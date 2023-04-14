<?php
// 절대 주소 넣는 대신 define 
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
define( "URL_HEADER","board_header.php" );
include_once( URL_DB );

// Request Parameter 획득(GET)
$arr_get = $_GET;

// DB에서 게시물 정보 획득
$result_info = select_board_info_no( $arr_get["board_no"] );

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="./css/board.css">
    <link rel="stylesheet" href="./css/board_detail.css">
    <title>Detail</title>

</head>
<body>
    <div class="wrap">
        <div class="content_1">
        <?php include_once( URL_HEADER ); ?>
            <h2>free board</h2>
            <h3>detail page</h3>
            <div class="contents">
                <p>NO. <?php echo $result_info["board_no"] ?></p>
                <p>DATE : <?php echo $result_info["board_write_date"] ?></p>
                <p>TITLE : <?php echo $result_info["board_title"] ?></p>
                <p class="con_cons">게시글 내용 : <?php echo $result_info["board_contents"] ?></p>
            </div>
            <div class="btn_wrap">
                <a href="board_update.php?board_no=<?php echo $result_info["board_no"] ?> ">
                    <i class="fa-solid fa-pen fa-2x"></i>
                </a>
                <a class="btn_fix" href='board_list.php'>
                    <i class="fa-sharp fa-solid fa-list fa-2x"></i>
                </a>
                <a href="board_delete.php?board_no=<?php echo $result_info["board_no"] ?>">    
                    <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
</body>

</html>