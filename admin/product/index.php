<?php
require_once '../../db/dbhelper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quản Lý Sản Phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="../category/">Quản Lý Danh Mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Quản Lý Sản Phẩm</a>
        </li>
    </ul>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Quản Lý Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <a href="add.php"><button type="button" class="btn btn-success" style="margin-bottom: 15px">Thêm Sản Phẩm</button></a>
                <table class="table table-bordered table-hover">
                <thead>
                        <tr>
                            <th width=50px>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá bán (kg)</th>
                            <th>Nội dung</th>
                            <th>Hình ảnh</th>
                            <th width = 50px></th>
                            <th width = 50px></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Lấy danh sách sản phẩm từ database
                        $sql = 'select * from product';
                        $productList = executeResult($sql);
                        $index = 1; 
                        foreach ($productList as $item) {
                            echo '    <tr>
                                        <td>' . ($index++) . '</td>
                                        <td>' . $item['title'] . '</td>
                                        <td>'.$item['price'].'</td>
                                        <td>'.$item['content'].'</td>
                                        <td><img src="'.$item['thumbnail'].'" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt=""></td>
                                        <td>
                                        <a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
                                        </td>
                                        <td>
                                        <button class="btn btn-danger" onclick= deleteProduct('.$item['id'].')>Xóa</button>
                                        </td>
                                    </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function deleteProduct(id) {
            console.log(id);
            var option = confirm('Bạn có chắc muốn xóa sản phẩm này không!!')
            if (!option) {
                return;
            }
            //ajax lệnh post    
            $.post('ajax.php', {
                'id': id,
                'action': 'deleteproduct'
            }, function(data) {
                location.reload()
            })
        }
    </script>

</body>

</html>