<style>
    .navbar-brand {
      margin-right: auto;
    }
    .navbar-nav {
      margin-left: auto; 
    }
    .navbar-nav .nav-link {
      color: #333; /* Màu chữ mặc định */
    }
    .navbar-nav .nav-link:hover {
      color: #fff; /* Màu chữ khi hover */
      background-color: #007bff; /* Màu nền khi hover */
      text-decoration: none; /* Loại bỏ gạch chân khi hover */
      border-radius: 4px; /* Bo góc khi hover */
    }
    .input-group {
      border: 2px solid #ced4da; /* Độ rộng và màu viền */
      border-radius: 4px; /* Bo góc viền */
    }
</style>
<!-- Menu và logo -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Logo -->
    <a class="navbar-brand" href="#">
        <img src="path_to_your_logo.png" alt="Logo" height="30">
    </a>

    <!-- Menu chính -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Company</a>
        </li>
        </ul>
    </div>
</nav>