<?php
    include_once '../controller/CategoryController.php';
    $p=new CategoryController();
    $categories = $p->Show_category();
    // Lấy kết quả từ Controller
    $pagination = $p->Show_pagination();
    $categories = $pagination['categories'];
    $totalPages = $pagination['totalPages'];
    $currentPage = $pagination['currentPage'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Quản lý danh mục</title>
    <style>
        .add-category-button{
            float: right;
        }
    </style>
</head>
<body>
    <?php
        include_once('../include/navbar.php');
    ?>
    <!-- Nội dung trong phần thân -->
    <div class="container mt-4">
        <h2 style="text-align: center;">Danh sách danh mục</h2><br>

        <!-- Thanh tìm kiếm -->

        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="searchInput" placeholder="Tìm kiếm danh mục...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" name="searchButton" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>
            <?php
                if(isset($_POST['searchButton']))
                {
                    $searchResult = $p->Show_category_list();
                    foreach ($searchResult as $category){
                        ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Category Name</th>
                                                    <th scope="col">Edit</th>
                                                    <th scope="col">Copy</th>
                                                    <th scope="col">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $category['id']; ?></td>
                                                    <td><?php echo $category['name']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-<?php echo $category['id']; ?>">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                    </td>
                                                    <td><button type="button" class="btn btn-secondary btn-sm"><i class="fa-regular fa-clipboard"></i></button></td>
                                                    <td>
                                                        <button type="submit" name="delete-<?php echo $category['id']; ?>" id="delete" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục <?php echo $category['name']; ?>')"><i class="fa-solid fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>
            
        
        <div class="add-category-button">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModal">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Thêm danh mục mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <form action="" method="post">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="category_name">Tên danh mục</label>
                                <input type="text" class="form-control" name="category_name" id="category_name" aria-describedby="name_help">
                                <small id="name_help" class="form-text text-muted">ví dụ: Nhạc cụ</small>
                            </div>
                            <div class="form-group">
                                <label for="category_select">Danh mục cha</label>
                                <select class="form-control" name="category_select" id="category_select">
                                    <option value="">...</option>
                                    <?php
                                        $show = $p->Show_category();
                                        
                                        if(is_array($show) && count($show) > 0) 
                                        {
                                            foreach($show as $category) 
                                            {
                                                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" name="add" id="add" class="btn btn-primary">Thêm danh mục</button>
                        <?php
                            if(isset($_POST['add']))
                            {
                                $p->Add_category();
                            }
                        ?>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        
        <br><br><br>
        <table class="table">
            <thead>
                <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Copy</th>
                <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($categories as $category):
                    ?>
                        <tr>
                            <td><?php echo $category['id']; ?></td>
                            <td><?php echo $category['name']; ?></td>
                            <!---- Nút mở modal cập nhật ---->
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-<?php echo $category['id']; ?>">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </td>
                                <!-- Modal -->
                            <div class="modal fade" id="editModal-<?php echo $category['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Cập nhật danh mục</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="category_name">Tên danh mục</label>
                                                <input type="text" class="form-control" name="category_name" id="category_name" value="<?php echo $category['name']; ?>" >
                                            </div>

                                            <!--- category_id và parent_id được ẩn để tiện cho việc đối chiếu --->
                                            <input type="hidden" name="category_id" id="category_id" value="<?php echo $category['id']; ?>">
                                            <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $category['parent_id']; ?>">

                                            <div class="form-group">
                                                <label for="category_select">Danh mục cha</label>
                                                <select class="form-control" name="category_select" id="category_select">
                                                    <option value="">...</option>
                                                    <?php
                                                        $allCategories = $p->Show_category();
                                                        foreach($allCategories as $allCate) 
                                                        {
                                                            /* Nếu id của danh mục trong danh sách tất cả các danh mục ($allCate['id']) 
                                                            bằng với parent_id của danh mục đang được cập nhật ($category['parent_id']), 
                                                            thì gán giá trị 'selected' cho biến $selected */
                                                            $selected = ($allCate['id'] == $category['parent_id']) ? 'selected' : ''; // sử dụng toán tử ba ngôi

                                                            // tiến hành hiển thị danh mục cha ( nếu có )
                                                            echo '<option value="' . $allCate['id'] . '" ' . $selected . '>' . $allCate['name'] . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="submit" name="edit" id="edit" class="btn btn-primary">Lưu thay đổi</button>
                                        <?php
                                            if(isset($_POST['edit']))
                                            {
                                                $p->Edit_category();
                                            }
                                        ?>
                                    </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                <!----nút copy ----->
                            <td>
                                <button type="button" class="btn btn-secondary btn-sm"><i class="fa-regular fa-clipboard"></i></button>
                            </td>
                                <!----- nút xóa ----->
                            <td>
                                <form action="" method="post">
                                    <button type="submit" name="delete-<?php echo $category['id']; ?>" id="delete" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục <?php echo $category['name']; ?>')"><i class="fa-solid fa-trash"></i></button>
                                    <?php
                                        if(isset($_POST['delete-' . $category['id']]))
                                        {
                                            //$category_id = $category['id'];
                                            $p->Delete_category();
                                        }
                                    ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; 
                ?>
            </tbody>
        </table>
    </div><br>
    <!-- Hiển thị phân trang -->
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="pagination justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination d-flex justify-content-center">
                            <!-- Nếu trang hiện tại lớn hơn 1, hiển thị nút "Previous" cho trang trước đó. -->
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <!-- Sử dụng vòng lặp for để hiển thị các số trang. -->
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <!-- Đối với từng trang, tiến hành tạo một phần tử li trong danh sách. 
                                Nếu trang hiện tại bằng với số trang hiện đang xét ($i == $currentPage), thì thêm lớp "active" vào phần tử để làm nổi bật. -->
                                <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                                    <!-- Liên kết đến trang tương ứng sử dụng tham số trang -->
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Nếu trang hiện tại nhỏ hơn tổng số trang, hiển thị nút "Next" cho trang kế tiếp. -->
                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>   
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>