<?php
class AdminController extends Controller
{
  private $Category;

  public function __construct()
  {
    $this->Category = $this->model('CategoryModel');
  }

  // Hiển thị danh sách danh mục với tùy chọn sắp xếp
  public function category()
  {
    $sortOrder = 'ASC';
    if (isset($_GET['sort'])) {
      if ($_GET['sort'] === 'za') $sortOrder = 'DESC';
    }
    $data['ShowCategory'] = $this->Category->ListAllSorted($sortOrder);
    $this->view('admin/category', $data);
  }

  // Xử lý thêm danh mục
  public function addCategory()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'] ?? '';
      if ($name !== '') {
        $this->Category->addCategory($name);
      }
      header("Location: " . BASE_URL . "/Admin/category");
    }
  }

  // Xóa danh mục (có thể gọi qua AJAX)
  public function deleteCategory($id)
  {
    $this->Category->deleteCategory($id);
    header("Location: " . BASE_URL . "/Admin/category");
    // Nếu AJAX, có thể echo kết quả hoặc redirect
  }

  // Hiển thị form sửa danh mục
  public function editCategory($id)
  {
    $data['category'] = $this->Category->ListItem($id);
    $this->view('admin/editCategory', $data);
  }

  // Xử lý sửa danh mục
  public function updateCategory($id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'] ?? '';
      if ($name !== '') {
        $this->Category->editCategory($id, $name);
      }
      header("Location: " . BASE_URL . "/Admin/category");
    }
  }
}

?>
