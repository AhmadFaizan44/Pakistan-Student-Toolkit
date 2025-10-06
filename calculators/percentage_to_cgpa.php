<?php $title="Percentage to CGPA"; include __DIR__."/../includes/header.php"; ?>
<h1>Percentage → CGPA (Approximation)</h1>
<form id="pct-form" method="post" class="calc">
  <div class="row">
    <div><label>Your Percentage (%)</label><input id="pct" name="pct" type="number" class="input" value="75"/></div>
    <div><label>Top % ≈ 4.0 CGPA</label><input id="pct-top" name="top" type="number" class="input" value="85"/></div>
  </div>
  <p class="muted">Note: Universities map percentage to CGPA differently. Adjust the top % slider as per your institute.</p>
  <button class="btn-primary" type="submit">Estimate</button>
</form>
<div class="card" id="pct-out"></div>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $pct = floatval($_POST['pct'] ?? 0);
  $top = max(1,floatval($_POST['top'] ?? 85));
  $cgpa = max(0,min(4, ($pct/$top)*4));
  echo '<div class="note">Server result (PHP): Approx CGPA = '.number_format($cgpa,2).'</div>';
}
?>
<?php include __DIR__."/../includes/footer.php"; ?>
