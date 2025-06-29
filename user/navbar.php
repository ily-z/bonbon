<?php
// Pastikan session sudah dimulai sebelum include file ini
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include_once __DIR__ . '/../conf/connection.php';
$id_user_sidebar = $_SESSION['id'] ?? null;
$cart_items = [];
$cart_total = 0;
$cart_count = 0;
if ($id_user_sidebar) {
  $qcart = mysqli_query($connect, "SELECT k.id_keranjang, k.jumlah_beli, k.total, b.nama_barang, b.gambar, b.harga FROM keranjang k JOIN barang b ON k.id_barang = b.id_barang WHERE k.id_pengguna='$id_user_sidebar' AND k.status='belum bayar'");
  while($row = mysqli_fetch_assoc($qcart)) {
    $cart_items[] = $row;
    $cart_total += $row['total'];
    $cart_count += $row['jumlah_beli'];
  }
}
$cart_item_unique = count($cart_items);
?>
<style>
  body {
    padding-top: 76px; /* Menambahkan padding-top untuk mengkompensasi fixed navbar */
  }
  .navbar {
    background-color: #C9AA7B;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1030;
  }
  .navbar-brand,
  .nav-link,
  .navbar-text {
    color: white !important;
    font-weight: bold;
  }
  .navbar-brand {
    font-family: 'Sansita Swashed', cursive;
    font-size: 1.5rem;
  }
  .navbar-brand img {
    margin-right: 10px;
  }
  .navbar-nav .nav-link:hover {
    text-decoration: underline;
    color: #fff !important;
  }
  .profile-icon {
    font-size: 1.5rem;
    display: flex;
    align-items: center;
  }
  .profile-icon:hover {
    text-decoration: none !important;
  }
  .nav-icons {
    display: flex;
    align-items: center;
    gap: 15px;
  }
  .nav-icons .nav-link {
    padding: 0.5rem;
  }
  .nav-icons .nav-link:hover {
    background-color: rgba(255,255,255,0.1);
    border-radius: 50%;
  }
  .cart-sidebar {
    position: fixed;
    top: 0;
    right: 0;
    width: 350px;
    max-width: 95vw;
    height: 100vh;
    background: #fff3e0;
    box-shadow: -2px 0 16px rgba(0,0,0,0.30);
    z-index: 2000;
    transform: translateX(100%);
    transition: transform 0.3s cubic-bezier(.4,0,.2,1);
    display: flex;
    flex-direction: column;
    border-top-left-radius: 18px;
    border-bottom-left-radius: 18px;
  }
  .cart-sidebar.open { 
    transform: translateX(0); 
 
  }

  body:has(.cart-sidebar.open) .coba-blur {
    filter: blur(7px);
    transition: filter 0.3s ease;
  
 
  }
  .cart-sidebar-header {
    padding: 18px 20px 12px 20px;
    border-bottom: 1px solid #e0c9a6;
    font-size: 1.1rem;
    background: #c9aa7b;
    color: #fff;
    border-top-left-radius: 18px;
  }
  .cart-sidebar-body {
    flex: 1;
    overflow-y: auto;
    padding: 16px 12px 8px 12px;
  }
  .cart-sidebar-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.97rem;
    background: #fff;
    border-radius: 10px;
    padding: 8px 8px 8px 8px;
    margin-bottom: 10px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    min-width: 0;
  }
  .cart-sidebar-item img {
    width: 44px;
    height: 44px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink: 0;
  }
  .cart-sidebar-item .ms-2.flex-grow-1 {
    min-width: 0;
    flex: 1 1 0%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
  }
  .cart-sidebar-item .fw-bold.small {
    font-size: 0.98rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 140px;
  }
  .cart-sidebar-item .text-muted.small {
    font-size: 0.93rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .cart-sidebar-item .qty-text {
    font-size: 1rem;
    font-weight: 600;
    min-width: 22px;
    text-align: center;
    display: inline-block;
  }
  .cart-sidebar-item .btn {
    padding: 2px 8px;
    font-size: 1rem;
    border-radius: 6px;
    min-width: 28px;
    min-height: 28px;
    line-height: 1.1;
  }
  .cart-sidebar-item .btn-hapus {
    background: #ff6b6b;
    color: #fff;
    border: none;
    font-size: 1.1rem;
    padding: 2px 8px;
    border-radius: 6px;
    min-width: 28px;
    min-height: 28px;
    margin-left: 4px;
  }
  .cart-sidebar-item .btn-hapus:hover {
    background: #c82333;
    color: #fff;
  }

  .form-check-input {
    accent-color: #e0c9a6;
  }
  .cart-sidebar-item .fw-bold.small.ms-2 {
    font-size: 0.98rem;
    min-width: 70px;
    text-align: right;
    color: #ad8d5c;
    margin-left: 8px !important;
  }
  .cart-sidebar-footer {
    border-top: 1px solid #e0c9a6;
    background: #fff3e0;
    padding: 16px 20px 12px 20px;
    border-bottom-left-radius: 18px;
  }
  .cart-sidebar-footer .fw-bold {
    font-size: 1.08rem;
  }
  .cart-sidebar-footer .btn-main {
    background: linear-gradient(135deg, #C9AA7B, #AD8D5C);
    color: #fff;
    border: none;
    border-radius: 25px;
    font-weight: bold;
    font-size: 1rem;
    padding: 10px 28px;
    margin-top: 10px;
    width: 100%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.2s;
  }
  .cart-sidebar-footer .btn-main:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
  @media (max-width: 500px) {
    .cart-sidebar {
      width: 98vw;
      min-width: 0;
      border-radius: 0;
    }
    .cart-sidebar-header, .cart-sidebar-footer {
      border-radius: 0;
    }
    .cart-sidebar-item .fw-bold.small {
      max-width: 80px;
    }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="home.php">
      <img src="../assets/ico/barley.png" width="40" class="me-2"> Bombon Bakery
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="home.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="pengiriman.php">Pengiriman</a></li>
        <li class="nav-item"><a class="nav-link" href="riwayat.php">Riwayat</a></li>
      </ul>
      <ul class="navbar-nav nav-icons">
        <li class="nav-item position-relative">
          <a class="nav-link" href="#" id="cartSidebarBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Keranjang">
            <i class="bi bi-cart3" style="font-size: 1.5rem;"></i>
            <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.8rem;display:none;">0</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link profile-icon" href="profil.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo ucwords($_SESSION['nama'] ?? 'Pengguna'); ?>">
            <i class="bi bi-person-circle"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Keluar">
            <i class="bi bi-box-arrow-right" style="font-size: 1.5rem;"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<<!-- Sidebar Keranjang (Mini Cart) -->
<div id="cartSidebar" class="cart-sidebar">
  <div class="cart-sidebar-header d-flex justify-content-between align-items-center">
    <span class="fw-bold">Keranjang</span>
    <button class="btn-close" id="closeCartSidebar" aria-label="Tutup"></button>
  </div>
  <div class="cart-sidebar-body" id="cartSidebarBody">
    <?php if (count($cart_items) > 0): ?>
      <?php foreach($cart_items as $item): ?>
        <div class="d-flex align-items-center mb-3 border-bottom pb-2 cart-sidebar-item" data-id="<?php echo $item['id_keranjang']; ?>">
          <input type="checkbox" class="form-check-input me-2 item-checkbox" data-id="<?php echo $item['id_keranjang']; ?>" data-total="<?php echo $item['total']; ?>">
          <img src="../images/product/<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['nama_barang']); ?>" width="48" height="48" style="object-fit:cover;border-radius:8px;">
          <div class="ms-2 flex-grow-1">
            <div class="fw-bold small"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
            <div class="text-muted small d-flex align-items-center gap-1">
              <button class="btn btn-sm btn-light btn-minus p-0 px-2" data-id="<?php echo $item['id_keranjang']; ?>" style="font-size:1.1rem;">-</button>
              <span class="mx-1 qty-text"><?php echo $item['jumlah_beli']; ?></span>
              <button class="btn btn-sm btn-light btn-plus p-0 px-2" data-id="<?php echo $item['id_keranjang']; ?>" style="font-size:1.1rem;">+</button>
              <span class="ms-2">x Rp<?php echo number_format($item['harga']); ?></span>
            </div>
          </div>
          <div class="fw-bold small ms-2">Rp<?php echo number_format($item['total']); ?></div>
          <button class="btn btn-sm btn-danger btn-hapus ms-2" data-id="<?php echo $item['id_keranjang']; ?>"><i class="bi bi-trash"></i></button>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="text-center text-muted mt-4">Keranjang kosong</div>
    <?php endif; ?>
  </div>
  <div class="cart-sidebar-footer p-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <span class="fw-bold">Total</span>
      <span class="fw-bold" id="selectedTotal">Rp0</span>
    </div>
    <form id="checkoutForm" method="POST" action="checkout.php">
      <input type="hidden" name="selected_items" id="selectedItemsInput">
      <button type="submit" id="checkoutBtn" class="btn btn-main w-100" disabled>Bayar</button>
    </form>
  </div>
</div>


<!-- Toast/Notifikasi -->
<div id="toastNotif" style="position:fixed;top:24px;right:24px;z-index:3000;min-width:220px;display:none;"></div>

<script>
function showToast(msg, type = 'success') {
  const toast = document.getElementById('toastNotif');
  toast.innerHTML = `<div style="background:rgba(40,40,40,0.92);color:#fff;padding:10px 18px;border-radius:7px;box-shadow:0 2px 12px rgba(0,0,0,0.10);font-weight:400;font-size:0.98rem;letter-spacing:0.01em;display:flex;align-items:center;gap:8px;min-width:160px;max-width:320px;">${type==='success'?'&#10003;':'&#10007;'} <span>${msg}</span></div>`;
  toast.style.display = 'block';
  setTimeout(() => { toast.style.display = 'none'; }, 1800);
}

function refreshSidebarCart(showMsg) {
  fetch('navbar.php?ajax_cart=1')
    .then(res => res.text())
    .then(html => {
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const newBody = doc.getElementById('cartSidebarBody');
      const newFooter = doc.querySelector('.cart-sidebar-footer');
      if(newBody) document.getElementById('cartSidebarBody').innerHTML = newBody.innerHTML;
      if(newFooter) document.querySelector('.cart-sidebar-footer').innerHTML = newFooter.innerHTML;
      updateSidebarCartEvents();
      updateSelectedTotal(); // <- update total saat cart di-refresh
      const badge = document.getElementById('cart-badge');
      const newBadge = doc.getElementById('cart-badge');
      if(badge && newBadge) {
        badge.textContent = newBadge.textContent;
        badge.style.display = newBadge.style.display;
      }
      if(showMsg) showToast(showMsg);
    });
}

function updateSidebarCartEvents() {
  document.querySelectorAll('.btn-plus').forEach(btn => {
    btn.onclick = function() {
      const id = this.getAttribute('data-id');
      fetch('update-keranjang.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id='+id+'&aksi=plus'
      })
      .then(res => res.json())
      .then(data => {
        if(data.status==='ok') refreshSidebarCart('Jumlah barang bertambah');
        else showToast(data.msg||'Gagal menambah', 'error');
      })
      .catch(()=>showToast('Gagal menambah', 'error'));
    };
  });

  document.querySelectorAll('.btn-minus').forEach(btn => {
    btn.onclick = function() {
      const id = this.getAttribute('data-id');
      fetch('update-keranjang.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id='+id+'&aksi=minus'
      })
      .then(res => res.json())
      .then(data => {
        if(data.status==='ok') refreshSidebarCart('Jumlah barang berkurang');
        else showToast(data.msg||'Gagal mengurangi', 'error');
      })
      .catch(()=>showToast('Gagal mengurangi', 'error'));
    };
  });

  document.querySelectorAll('.btn-hapus').forEach(btn => {
    btn.onclick = function() {
      const id = this.getAttribute('data-id');
      if(confirm('Hapus barang dari keranjang?')) {
        fetch('hapus-keranjang.php?id='+id)
          .then(()=>refreshSidebarCart('Barang dihapus'))
          .catch(()=>showToast('Gagal menghapus', 'error'));
      }
    };
  });

  // Tambahan: checkbox per item
  document.querySelectorAll('.item-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedTotal);
  });
}

function updateSelectedTotal() {
  const checkboxes = document.querySelectorAll('.item-checkbox');
  const totalDisplay = document.getElementById('selectedTotal');
  const checkoutBtn = document.getElementById('checkoutBtn');
  const selectedItemsInput = document.getElementById('selectedItemsInput');
  let total = 0;
  let selectedIds = [];

  checkboxes.forEach(checkbox => {
    if (checkbox.checked) {
      total += parseInt(checkbox.dataset.total);
      selectedIds.push(checkbox.dataset.id);
    }
  });

  if(totalDisplay) totalDisplay.textContent = 'Rp' + total.toLocaleString('id-ID');
  if(checkoutBtn) checkoutBtn.disabled = selectedIds.length === 0;
  if(selectedItemsInput) selectedItemsInput.value = selectedIds.join(',');
}

document.addEventListener('DOMContentLoaded', function() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });
  var sidebar = document.getElementById('cartSidebar');
  var openBtn = document.getElementById('cartSidebarBtn');
  var closeBtn = document.getElementById('closeCartSidebar');
  if(openBtn && sidebar) {
    openBtn.addEventListener('click', function(e) {
      e.preventDefault();
      sidebar.classList.add('open');
    });
  }
  if(closeBtn && sidebar) {
    closeBtn.addEventListener('click', function() {
      sidebar.classList.remove('open');
    });
  }
  document.addEventListener('mousedown', function(e) {
    if (sidebar.classList.contains('open') && !sidebar.contains(e.target) && !openBtn.contains(e.target)) {
      sidebar.classList.remove('open');
    }
  });
  var badge = document.getElementById('cart-badge');
  if(badge) {
    var count = <?php echo (int)$cart_item_unique; ?>;
    badge.textContent = count;
    badge.style.display = count > 0 ? 'inline-block' : 'none';
  }

  updateSidebarCartEvents();
  updateSelectedTotal(); // <- Jalankan awal
});
</script>

<?php include_once "toast.php"; ?>
</body>
</html>
