<?php
require_once '../../db/dbhelper.php';

$id=$name='';
if (isset($_POST)){
    if(isset($_POST['name'])){
        $name= $_POST['name'];
    }
    if(isset($_POST['id'])){
        $id= $_POST['id'];
    }
    if(!empty($name)){
        $created_at = $updated_at = date('Y-m-d H:s:i');
        //Thêm Danh mục và sửa Danh mục
        if($id == ''){
            $sql='insert into category(name, created_at, updated_at)
        values ("'.$name.'","'.$created_at.'","'.$updated_at.'")';
        } else {
            $sql='update category set name = "'.$name.'", updated_at = "'.$updated_at.'" where id = "'.$id.'"';
        }
        execute($sql);
        header('location:index.php');
        die();
    }
}

//Nhận id từ url và hiển thị danh mục được chọn
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql= 'select * from category where id='.$id;
    $category = executeSingleResult($sql);
    if($category != null){
        $name = $category['name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm/Sửa Danh Mục Sản Phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Quản Lý Danh Mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="../product/">Quản Lý Sản Phẩm</a>
        </li>
    </ul>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm/Sửa Danh Mục Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="name">Tên Danh Mục</label>
                        <input type="text" name="id" value="<?=$id?>" hidden="true">
                        <input required="true" type="text" class="form-control" id="name" name="name"
                            value="<?=$name?>">
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>