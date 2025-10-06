<?php $title="Zakat Calculator"; include __DIR__."/../includes/header.php"; ?>
<h1>Zakat Calculator (2.5%)</h1>
<form id="zakat-form" method="post" class="calc">
  <div class="row">
    <div><label>Cash & Bank (PKR)</label><input id="z-cash" name="cash" type="number" class="input" value="50000" /></div>
    <div><label>Gold (PKR)</label><input id="z-gold" name="gold" type="number" class="input" value="0" /></div>
  </div>
  <div class="row">
    <div><label>Silver (PKR)</label><input id="z-silver" name="silver" type="number" class="input" value="0" /></div>
    <div><label>Investments (PKR)</label><input id="z-invest" name="invest" type="number" class="input" value="0" /></div>
  </div>
  <div><label>Liabilities/Debts (PKR)</label><input id="z-debts" name="debts" type="number" class="input" value="0" /></div>
  <button class="btn-primary" type="submit">Calculate Zakat</button>
</form>
<div class="card" id="zakat-out"></div>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $cash = floatval($_POST['cash'] ?? 0);
  $gold = floatval($_POST['gold'] ?? 0);
  $silver = floatval($_POST['silver'] ?? 0);
  $invest = floatval($_POST['invest'] ?? 0);
  $debts = floatval($_POST['debts'] ?? 0);
  $total = max(0, $cash+$gold+$silver+$invest-$debts);
  $zakat = $total*0.025;
  echo '<div class="note">Server result (PHP): Zakat = PKR '.number_format($zakat,0).'</div>';
}
?>
<?php include __DIR__."/../includes/footer.php"; ?>
