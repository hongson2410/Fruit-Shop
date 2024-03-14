<?php
require_once '../../db/dbhelper.php';

$id = $title = $price = $thumbnail = $content = '';
$sql = 'select * from category';
$categoryList = executeResult($sql);

if (isset($_POST)) {
    if (isset($_POST['title'])) {
        $title = $_POST['title'];
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    if (!empty($title)) {
        $created_at = $updated_at = date('Y-m-d H:s:i');
        //Thêm Sản Phẩm và sửa Sản Phẩm
        if ($id == '') {
            $category= $_POST['category'];
            $categoryId = $category['id'];
            $sql = 'insert into product(title, price, thumbnail, content, id_category, created_at, updated_at)
        values ("' . $title . '","' . $_POST['price'] . '","' . $_POST['thumbnail'] . '","' . $_POST['content'] . '",
        "' . $categoryId . '", "' . $created_at . '","' . $updated_at . '")';
        } else {
            $sql = 'update product set title = "' . $title . '",price = "' . $$_POST['price'] . '",
            thumbnail = "' . $_POST['thumbnail'] . '",content = "' . $_POST['content'] . '", updated_at = "' . $updated_at . '" 
            where id = "' . $id . '"';
        }
        execute($sql);
        header('location:index.php');
        die();
    }
}

//Nhận id từ url và hiển thị sản phẩm được chọn
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'select * from product where id=' . $id;
    $product = executeSingleResult($sql);
    if ($product != null) {
        $title = $product['title'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm/Sửa Sản Phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/product.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="../category/">Quản Lý Danh Mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Quản Lý Sản Phẩm</a>
        </li>
    </ul>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm/Sửa Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label for="title">Tên Sản Phẩm</label>
                        <input type="text" name="id" value="<?= $id ?>" hidden="true">
                        <input required="true" type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="price">Giá Bán</label>
                        <input required="true" type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="custom-file mb-3 mt-3">
                        <input required="true" type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                        <label class="custom-file-label" for="thumbnail">Chọn Hình Ảnh</label>
                    </div>
                    <div class="preview"></div>
                    <div class="form-group">
                        <label for="content">Mô Tả</label>
                        <input required="true" type="text" class="form-control" id="content" name="content">
                    </div>
                    <div class="form-group">
                        <label for="category">Chọn Danh Mục</label>
                        <select class="form-control" id="category" name="category">
                        <?php
                        foreach ($categoryList as $item) {
                            echo '
                            <option>'.$item['name'].'</option>
                            ';
                        }
                        ?>
                            </select>
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        //Hiển thị ảnh đã chọn trước khi lưu
        const ipnFileElement = document.querySelector('.custom-file-input')
        const resultElement = document.querySelector('.preview')
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']

        ipnFileElement.addEventListener('change', function(e) {
            const files = e.target.files
            const file = files[0]
            const fileType = file['type']

            if (!validImageTypes.includes(fileType)) {
                var option = confirm('Không phải file hình ảnh!!')
                return
            }

            const fileReader = new FileReader()
            fileReader.readAsDataURL(file)

            fileReader.onload = function() {
                const url = fileReader.result
                resultElement.insertAdjacentHTML(
                    'beforeend',
                    `<img src="${url}" alt="${file.name}" class="preview-img" />`
                )
            }
        })
    </script>
</body>

</html>