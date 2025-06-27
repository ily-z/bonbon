<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$toastMsg = '';
$toastType = 'success';
if (!empty($_SESSION['toast'])) {
  $toastMsg = $_SESSION['toast']['msg'] ?? '';
  $toastType = $_SESSION['toast']['type'] ?? 'success';
  unset($_SESSION['toast']);
} elseif (!empty($_GET['toast'])) {
  $toastMsg = htmlspecialchars($_GET['toast']);
  $toastType = $_GET['type'] ?? 'success';
}
if ($toastMsg): ?>
  <div id="toastNotifGlobal" style="position:fixed;top:24px;right:24px;z-index:3000;min-width:180px;display:none;"></div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var toast = document.getElementById('toastNotifGlobal');
      toast.innerHTML = `<div style=\"background:rgba(40,40,40,0.92);color:#fff;padding:10px 18px;border-radius:7px;box-shadow:0 2px 12px rgba(0,0,0,0.10);font-weight:400;font-size:0.98rem;letter-spacing:0.01em;display:flex;align-items:center;gap:8px;min-width:160px;max-width:320px;\"><?php echo $toastType==='success'?'&#10003;':'&#9888;'; ?> <span><?php echo addslashes($toastMsg); ?></span></div>`;
      toast.style.display = 'block';
      setTimeout(function(){ toast.style.display = 'none'; }, 1800);
    });
  </script>
<?php endif; ?>
<script>
// Fungsi JS global agar bisa dipanggil dari JS lain
function showToastGlobal(msg, type = 'success') {
  let toast = document.getElementById('toastNotifGlobal');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'toastNotifGlobal';
    toast.style.position = 'fixed';
    toast.style.top = '24px';
    toast.style.right = '24px';
    toast.style.zIndex = '3000';
    toast.style.minWidth = '180px';
    toast.style.display = 'none';
    document.body.appendChild(toast);
  }
  toast.innerHTML = `<div style="background:rgba(40,40,40,0.92);color:#fff;padding:10px 18px;border-radius:7px;box-shadow:0 2px 12px rgba(0,0,0,0.10);font-weight:400;font-size:0.98rem;letter-spacing:0.01em;display:flex;align-items:center;gap:8px;min-width:160px;max-width:320px;">${type==='success'?'&#10003;':'&#9888;'} <span>${msg}</span></div>`;
  toast.style.display = 'block';
  setTimeout(() => { toast.style.display = 'none'; }, 1800);
}
</script> 