<?php $title="Merit Estimator"; include __DIR__."/../includes/header.php"; ?>
<h1>Merit Estimator (Generic)</h1>
<form id="merit-form" method="post" class="calc">
  <div class="row">
    <div><label>Matriculation (%)</label><input id="m-matric" name="matric" type="number" class="input" value="85"/></div>
    <div><label>Intermediate (%)</label><input id="m-inter" name="inter" type="number" class="input" value="80"/></div>
  </div>
  <div class="row">
    <div><label>Entry Test (%)</label><input id="m-test" name="test" type="number" class="input" value="70"/></div>
    <div><label>Weights: Matric / Inter / Test</label>
      <div class="row">
        <input id="w-matric" name="w_matric" type="number" class="input" value="10"/>
        <input id="w-inter"  name="w_inter"  type="number" class="input" value="40"/>
        <input id="w-test"   name="w_test"   type="number" class="input" value="50"/>
      </div>
    </div>
  </div>
  <button class="btn-primary" type="submit">Estimate Aggregate</button>
</form>
<div class="card" id="merit-out"></div>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $matric = floatval($_POST['matric'] ?? 0);
  $inter  = floatval($_POST['inter'] ?? 0);
  $test   = floatval($_POST['test'] ?? 0);
  $w1 = floatval($_POST['w_matric'] ?? 10);
  $w2 = floatval($_POST['w_inter']  ?? 40);
  $w3 = floatval($_POST['w_test']   ?? 50);
  $agg = ($matric*$w1 + $inter*$w2 + $test*$w3)/100;
  echo '<div class="note">Server result (PHP): Estimated Aggregate = '.number_format($agg,2).'%</div>';
}
?>
<?php include __DIR__."/../includes/footer.php"; ?>
