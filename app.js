document.addEventListener('DOMContentLoaded', () => {
  const year = document.getElementById('year');
  if (year) year.textContent = new Date().getFullYear();

  // Attach calculator handlers if present
  const attach = (id, fn) => {
    const form = document.getElementById(id);
    if (!form) return;
    form.addEventListener('input', fn);
    form.addEventListener('submit', e => { e.preventDefault(); fn(); });
    fn();
  };

  // GPA calculator
  attach('gpa-form', () => {
    const rows = document.querySelectorAll('#gpa-rows tr[data-row]');
    let totalQP = 0, totalCH = 0;
    rows.forEach(r => {
      const ch = parseFloat(r.querySelector('input[name="ch[]"]').value) || 0;
      const grade = r.querySelector('select[name="grade[]"]').value;
      const gp = {'A+':4,'A':4,'A-':3.7,'B+':3.3,'B':3,'B-':2.7,'C+':2.3,'C':2,'C-':1.7,'D':1,'F':0}[grade] || 0;
      totalQP += gp * ch;
      totalCH += ch;
    });
    const gpa = totalCH ? (totalQP / totalCH) : 0;
    const out = document.getElementById('gpa-out');
    if (out) out.innerHTML = `<div class="kpi"><div class="value">${gpa.toFixed(2)}</div><div class="badge">Current GPA</div></div><div class="muted">Total Credit Hours: ${totalCH}</div>`;
  });

  // CGPA calculator
  attach('cgpa-form', () => {
    const prevCH = parseFloat(document.getElementById('prevCH')?.value) || 0;
    const prevCGPA = parseFloat(document.getElementById('prevCGPA')?.value) || 0;
    const currGPA = parseFloat(document.getElementById('currGPA')?.value) || 0;
    const currCH  = parseFloat(document.getElementById('currCH')?.value) || 0;
    const totalQP = prevCGPA * prevCH + currGPA * currCH;
    const totalCH = prevCH + currCH;
    const cgpa = totalCH ? (totalQP / totalCH) : 0;
    const out = document.getElementById('cgpa-out');
    if (out) out.innerHTML = `<div class="kpi"><div class="value">${cgpa.toFixed(2)}</div><div class="badge">New CGPA</div></div><div class="muted">Total Credit Hours: ${totalCH}</div>`;
  });

  // Zakat calculator (2.5% on zakatable wealth)
  attach('zakat-form', () => {
    const cash = parseFloat(document.getElementById('z-cash')?.value) || 0;
    const gold = parseFloat(document.getElementById('z-gold')?.value) || 0;
    const silver = parseFloat(document.getElementById('z-silver')?.value) || 0;
    const invest = parseFloat(document.getElementById('z-invest')?.value) || 0;
    const debts = parseFloat(document.getElementById('z-debts')?.value) || 0;
    const total = Math.max(0, cash + gold + silver + invest - debts);
    const zakat = total * 0.025;
    const out = document.getElementById('zakat-out');
    if (out) out.innerHTML = `<div class="kpi"><div class="value">PKR ${zakat.toFixed(0)}</div><div class="badge">Zakat (2.5%)</div></div><div class="muted">Zakatable wealth: PKR ${total.toFixed(0)}</div>`;
  });

  // Fee/EMI split (simple equal installment + optional mark-up)
  attach('fee-form', () => {
    const principal = parseFloat(document.getElementById('fee-principal')?.value) || 0;
    const months = parseInt(document.getElementById('fee-months')?.value) || 1;
    const rate = parseFloat(document.getElementById('fee-rate')?.value) || 0; // monthly %
    const r = rate/100;
    let monthly = 0, totalPay = 0;
    if (r > 0) {
      monthly = principal * (r * Math.pow(1+r, months)) / (Math.pow(1+r, months) - 1);
      totalPay = monthly * months;
    } else {
      monthly = principal / months;
      totalPay = principal;
    }
    const out = document.getElementById('fee-out');
    if (out) out.innerHTML = `<div class="kpi"><div class="value">PKR ${monthly.toFixed(0)}</div><div class="badge">Monthly Installment</div></div><div class="muted">Total Payable: PKR ${totalPay.toFixed(0)}</div>`;
  });

  // Percentage to CGPA (simple linear map: 85%->4, 0%->0, adjustable slope)
  attach('pct-form', () => {
    const pct = parseFloat(document.getElementById('pct')?.value) || 0;
    const top = parseFloat(document.getElementById('pct-top')?.value) || 85;
    const cgpa = Math.max(0, Math.min(4, (pct/top)*4));
    const out = document.getElementById('pct-out');
    if (out) out.innerHTML = `<div class="kpi"><div class="value">${cgpa.toFixed(2)}</div><div class="badge">Approx CGPA</div></div><div class="muted">Assuming ${top}% ≈ 4.0</div>`;
  });

  // Grade target planner
  attach('target-form', () => {
    const desired = parseFloat(document.getElementById('target-desired')?.value) || 0;
    const weightMid = parseFloat(document.getElementById('target-mid-weight')?.value) || 0;
    const weightFinal = parseFloat(document.getElementById('target-final-weight')?.value) || 0;
    const scoreMid = parseFloat(document.getElementById('target-mid')?.value) || 0;
    const scoreAssign = parseFloat(document.getElementById('target-assign')?.value) || 0;
    const weightAssign = 100 - weightMid - weightFinal;
    const current = (scoreMid*weightMid + scoreAssign*weightAssign)/100;
    const neededFinal = Math.max(0, ((desired - current)*100)/Math.max(1, weightFinal));
    const out = document.getElementById('target-out');
    if (out) out.innerHTML = `<div class="kpi"><div class="value">${neededFinal.toFixed(1)}%</div><div class="badge">Needed in Final</div></div><div class="muted">Current weighted score: ${current.toFixed(1)}%</div>`;
  });

  // Merit estimator (generic): marks -> aggregate with weights
  attach('merit-form', () => {
    const matric = parseFloat(document.getElementById('m-matric')?.value) || 0;
    const inter = parseFloat(document.getElementById('m-inter')?.value) || 0;
    const test  = parseFloat(document.getElementById('m-test')?.value) || 0;
    const w1 = parseFloat(document.getElementById('w-matric')?.value) || 10;
    const w2 = parseFloat(document.getElementById('w-inter')?.value) || 40;
    const w3 = parseFloat(document.getElementById('w-test')?.value) || 50;
    const agg = (matric*w1 + inter*w2 + test*w3) / 100;
    const out = document.getElementById('merit-out');
    if (out) out.innerHTML = `<div class="kpi"><div class="value">${agg.toFixed(2)}%</div><div class="badge">Estimated Aggregate</div></div><div class="muted">Weights: ${w1}/${w2}/${w3}</div>`;
  });
});
