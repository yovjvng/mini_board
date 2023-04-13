<?php
    // 절대 주소 넣는 대신 define 
    define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
    define( "URL_DB", SRC_ROOT."common/db_common.php" );
    include_once( URL_DB );

    // Request Method를 획득
    $http_method = $_SERVER["REQUEST_METHOD"];

    // GET 일때
    if( $http_method === "GET")
    {
        $board_no = 1;
        if ( array_key_exists( "board_no", $_GET ) ) 
        {
            $board_no = $_GET["board_no"];
        }

        $result_info = select_board_info_no( $board_no );
    }
    // POST 일때
    else
    {
        $arr_post = $_POST;
        $arr_info = 
            array(
                "board_no" => $arr_post["board_no"]
                ,"board_title" => $arr_post["board_title"]
                ,"board_contents" => $arr_post["board_contents"]
            );

        // update
        $result_cnt = update_board_info_no( $arr_info );

        // select
        // $result_info = select_board_info_no( $arr_post["board_no"] ); // 0412 del

        // 수정 후 detail 페이지로 redirect
        header( "Location: board_detail.php?board_no=".$arr_post["board_no"] );
        exit(); // 바로 위 39행에서 redirect 했기 때문에 이후의 소스코드는 실행할 필요가 없다.
    }


 ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="./board.css">
    <title>게시판</title>
</head>
<body>
    <div class="wrap">
        <div class="content_1">
            <h2>free board</h2>
            <h3>edit post</h3>
            <form method="post" action="board_update.php">
                <label for="bno">NO. </label>
                <input type="text" name="board_no" id="bno" value="<?php echo $result_info['board_no'] ?>" readonly>
                <br>
                <br>
                <label for="title">TITLE : </label>
                <input type="text" name="board_title"  id="title" value="<?php echo $result_info['board_title'] ?>">
                <br>
                <br>
                <label for="contents">내용 : </label>
                <textarea class="input_contents" name="board_contents" id="contents" spellcheck="false" cols="48" rows="15" ><?php echo $result_info['board_contents'] ?>
                </textarea>
                <br>
                <br>
                <div class="btn_wrap">
                    <button class="btn_fix" type="submit">
                    <!-- <i class="fa-sharp fa-light fa-wrench"></i> -->수정
                    </button>
                    <a class="trash" href='board_detail.php?board_no=<?php echo $result_info["board_no"] ?>'>
                    <i class="fa-solid fa-trash-can"></i>
                    </a>
                    <a href='board_list.php'> <button class="btn_fix" type="button"> LIST</button></a>
                </div>
            </form>
            <!-- <a href='board_list.php'> <button class="btn_fix" type="button"> LIST</button></a> -->
        </div>
    </div>
</body>
</html>