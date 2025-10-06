<?php $title="CGPA Calculator"; include __DIR__."/../includes/header.php"; ?>
<h1>CGPA Calculator</h1>
<form id="cgpa-form" method="post" class="calc">
  <div class="row">
    <div>
      <label>Previous Credit Hours</label>
      <input id="prevCH" name="prevCH" type="number" min="0" value="60" class="input"/>
    </div>
    <div>
      <label>Previous CGPA</label>
      <input id="prevCGPA" name="prevCGPA" type="number" min="0" step="0.01" value="3.20" class="input"/>
    </div>
  </div>
  <div class="row">
    <div>
      <label>Current Semester Credit Hours</label>
      <input id="currCH" name="currCH" type="number" min="0" value="15" class="input"/>
    </div>
    <div>
      <label>Current Semester GPA</label>
      <input id="currGPA" name="currGPA" type="number" min="0" max="4" step="0.01" value="3.60" class="input"/>
    </div>
  </div>
  <button class="btn-primary" type="submit">Calculate CGPA</button>
</form>
<div class="card" id="cgpa-out"></div>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $prevCH = floatval($_POST['prevCH'] ?? 0);
  $prevCG = floatval($_POST['prevCGPA'] ?? 0);
  $currCH = floatval($_POST['currCH'] ?? 0);
  $currGP = floatval($_POST['currGPA'] ?? 0);
  $totalQP = $prevCH*$prevCG + $currCH*$currGP;
  $totalCH = $prevCH + $currCH;
  $cgpa = $totalCH ? $totalQP/$totalCH : 0;
  echo '<div class="note">Server result (PHP): CGPA = '.number_format($cgpa,2).'</div>';
}
?>
<?php include __DIR__."/../includes/footer.php"; ?>
