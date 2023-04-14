<?php
define( "SRC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/mini_board/src/" );
define( "URL_DB", SRC_ROOT."common/db_common.php" );
define( "URL_HEADER","board_header.php" );
define( "URL_LIST","board_list.php" );
include_once( URL_DB );

$http_method = $_SERVER["REQUEST_METHOD"];

if( $http_method === "GET")
{
    $arr_post = $_GET;
    $result_paging = board_search( $arr_post );

}
else
{
    echo "검색어가 없습니다.";
}

var_dump($_GET);

// $result_paging = board_search()
// $search_con = "제목";
// $result = board_search( $search_con );

// if( $http_method === "POST")
// {
//     $arr_post = $_POST;
//     $result_info = board_search( $arr_post );

// }
// else
// {
//     echo "검색어가 없습니다.";
// }



// print_r( $result );

// $searchOption = $dbConnect->real_escape_string($_POST['option']);
// $catagory = $_GET['catgo'];
// $search_con = $_GET['search'];


// if($param_search == '' || $param_search == null) {
//     echo "검색어가 없습니다.";
//     exit;
//   }

//   switch($searchOption) {
//     case 'title':
//     case 'content':
//     case 'tandc':
//     case 'torc':
//       break;
//     default :
//       echo "검색 옵션이 없습니다.";
//       exit;
//       break;
//   }


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
    <title>Document</title>
</head>
<body>
<div class="wrap">
        <div class="main">
        <?php include_once( URL_HEADER ); ?>
            <h1>fREE BOARD</h1>
            <div class="result">
                <!-- <p><?php echo $search_con; ?> 검색결과</p> -->
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
            <!-- <div class="nav-form">
                <form method="get" action="board_search.php"><i class="fas fa-search"></i>
                    <input class="sear_put" type="text" placeholder="검색">
                </form>
            </div> -->
            <div class="btn_con">
                    <a href='board_list.php?page_num=1'>first</a>   
                    <div class="btn_con_num">
                        <?php
                        if( $result > 0 )
                        {
                            for( $i = 1; $i <= $max_page_num; $i++ )
                            {
                        ?>       
                                <a href='board_list.php?page_num=<?php echo $i ?>'><?php echo $i ?></a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <a href='board_list.php?page_num=<?php echo $max_page_num ?>'>end</a>
            </div>
        </div>
    </div>
</body>
</html>