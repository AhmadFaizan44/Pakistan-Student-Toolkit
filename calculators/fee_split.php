<?php $title="Fee Installment Calculator"; include __DIR__."/../includes/header.php"; ?>
<h1>Fee Installment (EMI) Calculator</h1>
<form id="fee-form" method="post" class="calc">
  <div class="row">
    <div><label>Total Fee / Principal (PKR)</label><input id="fee-principal" name="principal" type="number" class="input" value="120000"/></div>
    <div><label>Months</label><input id="fee-months" name="months" type="number" class="input" value="12"/></div>
  </div>
  <div><label>Monthly Mark-up Rate (%)</label><input id="fee-rate" name="rate" type="number" step="0.01" class="input" value="0"/></div>
  <button class="btn-primary" type="submit">Calculate</button>
</form>
<div class="card" id="fee-out"></div>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $P = floatval($_POST['principal'] ?? 0);
  $n = max(1,intval($_POST['months'] ?? 1));
  $r = floatval($_POST['rate'] ?? 0)/100; // monthly
  if ($r>0) {
    $monthly = $P * ($r * pow(1+$r, $n)) / (pow(1+$r, $n) - 1);
    $total = $monthly * $n;
  } else {
    $monthly = $P / $n;
    $total = $P;
  }
  echo '<div class="note">Server result (PHP): Monthly = PKR '.number_format($monthly,0).' | Total = PKR '.number_format($total,0).'</div>';
}
?>
<?php include __DIR__."/../includes/footer.php"; ?>
