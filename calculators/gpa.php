<?php $title="Semester GPA Calculator"; include __DIR__."/../includes/header.php"; ?>
<h1>Semester GPA Calculator</h1>
<form id="gpa-form" method="post" class="calc">
  <table class="table" id="gpa-rows">
    <thead><tr><th>Course</th><th>Credit Hours</th><th>Grade</th></tr></thead>
    <tbody>
      <?php for ($i=1;$i<=6;$i++): ?>
      <tr data-row>
        <td><input class="input" name="course[]" placeholder="Course <?= $i ?>" /></td>
        <td><input class="input" name="ch[]" type="number" step="0.5" min="0" value="3" /></td>
        <td>
          <select class="input" name="grade[]">
            <?php foreach(["A+","A","A-","B+","B","B-","C+","C","C-","D","F"] as $g): ?>
              <option value="<?= $g ?>"><?= $g ?></option>
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <?php endfor; ?>
    </tbody>
  </table>
  <button class="btn-primary" type="submit">Calculate GPA</button>
</form>
<div class="card" id="gpa-out"></div>
<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $grades = ["A+"=>4,"A"=>4,"A-"=>3.7,"B+"=>3.3,"B"=>3,"B-"=>2.7,"C+"=>2.3,"C"=>2,"C-"=>1.7,"D"=>1,"F"=>0];
  $totalQP=0; $totalCH=0;
  foreach($_POST['grade'] ?? [] as $idx=>$g){
    $ch = floatval($_POST['ch'][$idx] ?? 0);
    $gp = $grades[$g] ?? 0;
    $totalQP += $gp * $ch;
    $totalCH += $ch;
  }
  $gpa = $totalCH ? $totalQP/$totalCH : 0;
  echo '<div class="note">Server result (PHP): GPA = '.number_format($gpa,2).'</div>';
}
?>
<?php include __DIR__."/../includes/footer.php"; ?>
