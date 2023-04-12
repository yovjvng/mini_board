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

        // 다른 화면으로 넘어가는
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
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/search.css' rel='stylesheet'>
    <title>게시판</title>
    <style>
        @font-face {
        font-family: 'S-CoreDream-3Light';
        src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-3Light.woff') format('woff');
        font-weight: normal;
        font-style: normal;
        }
        *
        {
            font-family: 'S-CoreDream-3Light';
            margin: 0;
            padding: 0;
        }
        a
        {
            color: inherit;
            display: inline-block;
            text-decoration: none;
            color: #ffffff;
        }
        a:hover
        {
            color: #333;
        }
        .wrap
        {
            margin: 10px;
        }
        .main
        {
            background-image: url(./paper1.jpg);
            background-size: cover;
            border: 1px solid #333;
            width: 800px;
            height: 100%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h1
        {
            font-size: 50px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            text-transform: uppercase;
        }
        h2
        {
            font-size: 18px;
            font-family: 'Times New Roman', Times, serif;
            border-bottom: 1px solid #333;
            border-top: 1px solid #333;
            width: 300px;
            margin: 0 auto;
            text-transform: uppercase;
            padding: 5px 0;
        }
        form{
            padding: 30px 0;
        }
        form input
        {
            width: 400px;
            background: transparent;
            border: none;
        }
        textarea
        {
            background: transparent;
            color: #333;
        }
        #contents
        {
            /* font-size: 12px; */
            height: 500px;
        }
        label
        {
            vertical-align: top;
        }
        .btn_con
        {
            display: flex;
            width: 500px;
            /* background-color: aquamarine; */
            margin: 0 auto;
        }
        .btn_fix
        {
            width: 70px;
            border-radius: 25px;
            background-color: #333;
            color: #ffffff;
            margin: 0 50px;
            /* justify-content: space-between; */
        }
        .btn_fix:hover
        {
            background-color: #ffffff;
            color: #333;
        }
        
    </style>
</head>
<body>
    <div class="wrap">
        <div class="main">
            <h1>free board</h1>
            <h2>edit post</h2>
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
                <textarea name="board_contents" id="contents" value="<?php echo $result_info['board_contents'] ?>" cols="48" rows="15">
                </textarea>
                <br>
                <br>
                <div class="btn_con">
                    <button class="btn_fix" type="submit">FIX</button>
                    <a href='board_detail.php?board_no=<?php echo $result_info["board_no"] ?>'> <button class="btn_fix" type="button">
                    취소
                    </button></a>
                    <a href='board_list.php'> <button class="btn_fix" type="button"> LIST</button></a>
                </div>
            </form>
            <!-- <a href='board_list.php'> <button class="btn_fix" type="button"> LIST</button></a> -->
        </div>
    </div>
</body>
</html>