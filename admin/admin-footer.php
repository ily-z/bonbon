<?php include "../conf/connection.php"; ?>
<style>
  body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  main {
    flex: 1;
  }
  footer {
    background: url('../images/content/dark-texture.jpg') center/cover no-repeat;
    color: white;
    padding: 40px 0;
    margin-top: auto;
  }
  footer h5 {
    color: #f4ae44;
  }
  footer a {
    color: white;
    text-decoration: none;
  }
  footer a:hover {
    text-decoration: underline;
  }
  .new-product-footer {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
  }
  .new-product-footer img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 10px;
  }
  .new-product-footer small {
    display: block;
    font-size: 0.8rem;
    color: #ddd;
  }
</style>

<footer>
  <hr class="bg-light">
  <div class="text-center mt-4">
    <small>© 2025 Bonbon Bakery and Cake. Hak Cipta Dilindungi</small>
  </div>
</footer>
