<?php
require_once __DIR__ . '/../model/CategoryModel.php';
class CategoryController
{
    private $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    // xử lý danh sách các mục
    public function Show_category()
    {
        $categories = $this->model->getAllCategories();
        return $categories;
    }

    // xử lý việc thêm danh mục mới
    public function Add_category()
    {
        // xử lý dữ liệu khi submit form
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $name = $_POST['category_name'];
            //$parent_id = $_POST['category_select'];
            $parent_id = isset($_POST['category_select']) ? $_POST['category_select'] : 0;

            if(empty($name)) // Kiểm tra tên danh mục không được để trống
            {
                echo "<script>alert('tên danh mục không để trống !');</script>";
                echo "<script>window.location='../view/index.php';</script>";
            }
            else
            {
                // xử lý việc lưu vào cơ sở dữ liệu
                $result = $this->model->addCategories($name, $parent_id);

                if($result) 
                {
                    // Thêm danh mục thành công, chuyển hướng về trang danh sách các danh mục
                    echo '<script>window.location="../view/index.php"</script>';
                    exit;
                } 
                else 
                {
                    // Xử lý lỗi nếu có
                    echo "Có lỗi xảy ra khi thêm danh mục!";
                }
            }
            
        }
    }

    // xử lý việc cập nhật danh mục
    public function Edit_category()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $id = $_POST['category_id'];
            $name = $_POST['category_name'];
            $parent_id = $_POST['category_select'];

            // kiểm tra danh mục không được để trống
            if(empty($name))
            {
                echo "<script>alert('tên danh mục không để trống !');</script>";
                echo "<script>window.location='../view/index.php';</script>";
            }
            else
            {
                // xử lý việc lưu vào cơ sở dữ liệu
                $result = $this->model->editCategories($id, $name, $parent_id);

                if($result)
                {
                    echo '<script>window.location="../view/index.php"</script>';
                    exit;
                }
                else
                {
                    echo "Có lỗi xảy ra khi cập nhật danh mục!";
                }
            }
        }
    }

    // xử lý việc xóa danh mục
    public function Delete_category()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            foreach ($_POST as $key => $value) 
            {
                // Tìm các nút xóa bằng cách kiểm tra nút có tên chứa "delete-" trong $key
                if(strpos($key, 'delete-') !== false)
                {
                    // Lấy category_id từ tên nút
                    $category_id = str_replace('delete-', '', $key);
                    // Xóa danh mục dựa trên category_id
                    $delete = $this->model->deleteCategories($category_id);
                    if($delete)
                    {
                        // Chuyển hướng trở lại trang danh sách danh mục sau khi xóa thành công
                        echo '<script>window.location="../view/index.php"</script>';
                        exit;
                    } 
                    else 
                    {
                        echo "Có lỗi xảy ra khi xóa danh mục!";
                    }
                }
            }
        }
    }

    // xử lý tìm kiếm danh mục
    public function Show_category_list()
    {
        $arrangeCategories = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $searchInput = $_POST['searchInput'];

            if(empty($searchInput))
            {
                echo "<script>alert('Hãy nhập tên danh mục cần tìm !');</script>";
                return array();
            }
            else
            {
                // tìm kiếm danh mục dựa trên từ khóa tìm kiếm
                $arrangeCategories = $this->model->searchCategories($searchInput);
                return $arrangeCategories;
            }
        }
    }

    public function Show_pagination()
    {
        // Số lượng danh mục hiển thị trên mỗi trang
        $perPage = 10;

        // Lấy số trang được yêu cầu từ URL (Nếu không có, mặc định là trang 1)
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Lấy danh sách danh mục dựa trên số trang và số lượng danh mục hiển thị trên mỗi trang
        $categories = $this->model->getCategoriesWithPagination($currentPage, $perPage);

        // Lấy tổng số lượng danh mục từ model (dùng để tính số trang)
        $totalCategories = $this->model->getTotalCategories();

        // Tính số lượng trang dựa trên tổng số lượng danh mục và số lượng danh mục hiển thị trên mỗi trang
        $totalPages = ceil($totalCategories / $perPage);

        // Truyền dữ liệu cho view thông qua biến $data
        $data = array(
            'categories' => $categories,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage
        );

        return $data;
    }
}
?>