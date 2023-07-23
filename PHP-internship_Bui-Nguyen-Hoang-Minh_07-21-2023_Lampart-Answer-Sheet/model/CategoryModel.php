<?php
require_once __DIR__ . '/../connect_db.php';
class CategoryModel
{
    private $connection;

    public function __construct()
    {
        global $connection;
        $this->connection = $connection;
    }

    // hàm lấy danh sách tất cả các danh mục
    public function getAllCategories()
    {
        $query = "SELECT *FROM categories WHERE category_status = 'working'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // hàm thực hiện chức năng thêm danh mục mới
    public function addCategories($name, $parent_id)
    {
        if(empty($parent_id))
        {
            // Nếu parent_id rỗng, coi danh mục mới là danh mục cha
            $parent_id = 0;
        }
        
        $query = "INSERT INTO categories (name, parent_id, category_status) VALUES (:name, :parent_id, 'working')";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':parent_id', $parent_id);
        return $stmt->execute();
    }

    // hàm thực hiện chức năng cập nhật
    public function editCategories($category_id, $name, $parent_id)
    {
        $query = "UPDATE categories SET name=:name, parent_id=:parent_id WHERE id=:id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':parent_id', $parent_id);
        return $stmt->execute();
    }

    // hàm thực hiện chức năng xóa danh mục
    public function deleteCategories($category_id)
    {
        $query = "UPDATE categories SET category_status = 'deleted' WHERE id=:id";
        //$query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $category_id);
        return $stmt->execute();
    }

    // hàm thực hiện chức năng hỗ trợ tìm kiếm danh mục
    public function searchCategories($searchInput)
    {
        $query = "SELECT *FROM categories WHERE name LIKE ?";
        $stmt = $this->connection->prepare($query);
        $searchTerm = "%{$searchInput}%";
        $stmt->bindParam(1, $searchTerm);
        $stmt->execute();

        // Trả về danh sách danh mục đã tìm kiếm
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm lấy danh sách danh mục với phân trang
    public function getCategoriesWithPagination($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM categories WHERE category_status = 'working' LIMIT :offset, :perPage";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm lấy tổng số lượng danh mục
    public function getTotalCategories()
    {
        $query = "SELECT COUNT(id) AS total FROM categories";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
?>