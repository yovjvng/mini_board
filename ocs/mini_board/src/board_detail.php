<?php
// 절대 주소 넣는 대신 define 
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
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
    <link rel="stylesheet" href="./board.css">
    <title>Detail</title>

</head>
<body>
    <div class="wrap">
        <div class="content_1">
            <h2>free board</h2>
            <h3>detail page</h3>
            <div class="contents">
                <p>NO. <?php echo $result_info["board_no"] ?></p>
                <p>작성일 : <?php echo $result_info["board_write_date"] ?></p>
                <p>게시글 번호 : <?php echo $result_info["board_title"] ?></p>
                <p>게시글 내용 : <?php echo $result_info["board_contents"] ?></p>
            </div>
            <button type="button"><a href="board_update.php?board_no=<?php echo $result_info["board_no"] ?> ">
            수정 
            </a></button>
            <a href='board_list.php'> <button class="btn_fix" type="button"> LIST</button></a>
            <button type="button">
                <a href="board_delete.php?board_no=<?php echo $result_info["board_no"] ?>">    
                삭제
                </a>
            </button>
        </div>
    </div>
</body>

</html>