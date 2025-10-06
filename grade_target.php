<?php $title="Grade Target Planner"; include __DIR__."/../includes/header.php"; ?>
<h1>Grade Target Planner</h1>
<form id="target-form" method="post" class="calc">
  <div class="row">
    <div><label>Desired Course Percentage</label><input id="target-desired" name="desired" type="number" class="input" value="85"/></div>
    <div><label>Midterm Weight (%)</label><input id="target-mid-weight" name="mid_w" type="number" class="input" value="30"/></div>
  </div>
  <div class="row">
    <div><label>Final Exam Weight (%)</label><input id="target-final-weight" name="final_w" type="number" class="input" value="40"/></div>
    <div><label>Midterm Score (%)</label><input id="target-mid" name="mid" type="number" class="input" value="70"/></div>
  </div>
  <div><label>Assignments/Quizzes Score (%)</label><input id="target-assign" name="assign" type="number" class="input" value="90"/></div>
  <button class="btn-primary" type="submit">Calculate Needed Final</button>
</form>
<div class="card" id="target-out"></div>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $desired = floatval($_POST['desired'] ?? 0);
  $wMid = floatval($_POST['mid_w'] ?? 0);
  $wFinal = floatval($_POST['final_w'] ?? 0);
  $mid = floatval($_POST['mid'] ?? 0);
  $assign = floatval($_POST['assign'] ?? 0);
  $wAssign = 100 - $wMid - $wFinal;
  $current = ($mid*$wMid + $assign*$wAssign)/100;
  $neededFinal = max(0, (($desired - $current)*100)/max(1,$wFinal));
  echo '<div class="note">Server result (PHP): Needed in Final = '.number_format($neededFinal,1).'%</div>';
}
?>
<?php include __DIR__."/../includes/footer.php"; ?>
