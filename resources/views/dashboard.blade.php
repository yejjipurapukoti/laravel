@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1 class="mb-3">Admin Dashboard — Students & Courses Analytics</h1>

  <div style="display:flex;gap:20px;flex-wrap:wrap;">
    <!-- Left column: summary cards -->
    <div style="flex:1;min-width:300px;max-width:420px;">
      <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px;">
        <div class="card" style="padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.06);">
          <h3 id="totalStudents">Students<br><small style="color:#666">Total</small></h3>
          <p id="totalStudentsVal" style="font-size:24px;font-weight:600;margin-top:6px"></p>
        </div>

        <div class="card" style="padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.06);">
          <h3>Courses<br><small style="color:#666">Active</small></h3>
          <p id="totalCoursesVal" style="font-size:24px;font-weight:600;margin-top:6px"></p>
        </div>

        <div class="card" style="padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.06);">
          <h3>Avg. Grade<br><small style="color:#666">Across Students</small></h3>
          <p id="avgGrade" style="font-size:24px;font-weight:600;margin-top:6px"></p>
        </div>

        <div class="card" style="padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.06);">
          <h3>Completion Rate<br><small style="color:#666">All Courses</small></h3>
          <p id="completionRate" style="font-size:24px;font-weight:600;margin-top:6px"></p>
        </div>
      </div>

      <div style="margin-top:18px;padding:14px;border-radius:8px;background:#fff;box-shadow:0 6px 18px rgba(0,0,0,0.04);">
        <h4 style="margin-bottom:12px">Filters</h4>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
          <select id="courseFilter" style="padding:8px;border-radius:6px;border:1px solid #ddd;">
            <option value="all">All courses</option>
          </select>
          <select id="genderFilter" style="padding:8px;border-radius:6px;border:1px solid #ddd;">
            <option value="all">All genders</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
          <button id="applyFilter" class="btn" style="padding:8px 12px;background:#6f63f8;color:#fff;border-radius:6px;border:none;cursor:pointer">Apply</button>
          <button id="resetFilter" class="btn" style="padding:8px 12px;background:#eee;color:#333;border-radius:6px;border:none;cursor:pointer">Reset</button>
        </div>
      </div>

      <div style="margin-top:18px;padding:14px;border-radius:8px;background:#fff;box-shadow:0 6px 18px rgba(0,0,0,0.04);">
        <h4 style="margin-bottom:12px">Export</h4>
        <button id="exportCSV" style="padding:8px 12px;background:#0b7285;color:#fff;border-radius:6px;border:none;cursor:pointer">Export Students CSV</button>
      </div>
    </div>

    <!-- Right column: charts -->
    <div style="flex:2;min-width:420px;">
      <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:18px;">
        <div style="background:#fff;padding:12px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.04);">
          <h4 style="margin-bottom:8px">Enrollment by Course</h4>
          <canvas id="enrollmentChart" height="200"></canvas>
        </div>

        <div style="background:#fff;padding:12px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.04);">
          <h4 style="margin-bottom:8px">Gender Split (selected course)</h4>
          <canvas id="genderChart" height="200"></canvas>
        </div>

        <div style="background:#fff;padding:12px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.04);">
          <h4 style="margin-bottom:8px">Average Grade per Course</h4>
          <canvas id="gradeChart" height="200"></canvas>
        </div>

        <div style="background:#fff;padding:12px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.04);">
          <h4 style="margin-bottom:8px">Attendance Trend (last 12 weeks)</h4>
          <canvas id="attendanceChart" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Students table -->
  <div style="margin-top:22px;background:#fff;padding:14px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.04);">
    <h3>Students — Sample Data</h3>
    <div style="overflow:auto;">
      <table id="studentsTable" style="width:100%;border-collapse:collapse;font-family:inherit">
        <thead>
          <tr style="background:#f6f6f8">
            <th style="padding:8px;border-bottom:1px solid #eee">ID</th>
            <th style="padding:8px;border-bottom:1px solid #eee">Name</th>
            <th style="padding:8px;border-bottom:1px solid #eee">Gender</th>
            <th style="padding:8px;border-bottom:1px solid #eee">Course</th>
            <th style="padding:8px;border-bottom:1px solid #eee">Grade</th>
            <th style="padding:8px;border-bottom:1px solid #eee">Attendance %</th>
            <th style="padding:8px;border-bottom:1px solid #eee">Status</th>
          </tr>
        </thead>
        <tbody id="studentsBody"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/*
  Dummy analytics dashboard:
  - Generates mock students & courses data
  - Renders charts: enrollment, gender split, avg grade, attendance trend
  - Table & CSV export
  - Filters by course & gender
*/

function randomInt(min, max) { return Math.floor(Math.random() * (max - min + 1)) + min; }
function randomChoice(arr) { return arr[Math.floor(Math.random() * arr.length)]; }
function mean(arr){ return arr.reduce((a,b)=>a+b,0)/arr.length; }

const COURSES = [
  'Mathematics', 'Physics', 'Computer Science', 'Economics',
  'English', 'Biology', 'History'
];

// generate N students
function generateStudents(n=120) {
  const first = ['Aarav','Ria','Karan','Maya','Ishaan','Sara','Vikram','Neha','Rohit','Priya','Arjun','Tara'];
  const last = ['Sharma','Patel','Gupta','Reddy','Khan','Singh','Verma','Das','Mehta','Nair'];
  const genders = ['male','female','other'];
  const students = [];
  for (let i=1;i<=n;i++){
    const course = randomChoice(COURSES);
    const grade = Math.round((randomInt(50,98) + (COURSES.indexOf(course)*2)) * 10) / 10;
    const attendance = randomInt(60,100);
    const status = grade >= 60 ? (grade >= 85 ? 'Excellent' : 'Pass') : 'Need Attention';
    students.push({
      id: i,
      name: randomChoice(first) + ' ' + randomChoice(last),
      gender: randomChoice(genders),
      course,
      grade,
      attendance,
      status,
      weeks: Array.from({length:12}, ()=> Math.round(60 + Math.random()*40)) // last 12 week attendance %
    });
  }
  return students;
}

let students = generateStudents(140);
let filtered = [...students];

// build filters
const courseFilterEl = document.getElementById('courseFilter');
COURSES.forEach(c=>{
  const opt = document.createElement('option'); opt.value=c; opt.textContent=c; courseFilterEl.appendChild(opt);
});
const genderFilterEl = document.getElementById('genderFilter');

document.getElementById('applyFilter').addEventListener('click', ()=>{
  applyFilters();
});
document.getElementById('resetFilter').addEventListener('click', ()=>{
  courseFilterEl.value='all'; genderFilterEl.value='all'; filtered = [...students]; updateAll(); 
});

// populate cards + table + charts
function updateAll(){
  // Totals
  document.getElementById('totalStudentsVal').textContent = filtered.length;
  const coursesUnique = new Set(students.map(s=>s.course));
  document.getElementById('totalCoursesVal').textContent = coursesUnique.size;
  document.getElementById('avgGrade').textContent = (mean(filtered.map(s=>s.grade)) || 0).toFixed(1);
  const completion = (filtered.filter(s=>s.grade>=60).length / Math.max(1, filtered.length)) * 100;
  document.getElementById('completionRate').textContent = completion.toFixed(1) + '%';

  // table
  const tbody = document.getElementById('studentsBody'); tbody.innerHTML = '';
  filtered.slice(0,200).forEach(s=>{
    const tr = document.createElement('tr');
    tr.innerHTML = `<td style="padding:8px;border-bottom:1px solid #f1f1f1">${s.id}</td>
                    <td style="padding:8px;border-bottom:1px solid #f1f1f1">${s.name}</td>
                    <td style="padding:8px;border-bottom:1px solid #f1f1f1">${s.gender}</td>
                    <td style="padding:8px;border-bottom:1px solid #f1f1f1">${s.course}</td>
                    <td style="padding:8px;border-bottom:1px solid #f1f1f1">${s.grade}</td>
                    <td style="padding:8px;border-bottom:1px solid #f1f1f1">${s.attendance}%</td>
                    <td style="padding:8px;border-bottom:1px solid #f1f1f1">${s.status}</td>`;
    tbody.appendChild(tr);
  });

  // update charts
  updateEnrollmentChart();
  updateGenderChart();
  updateGradeChart();
  updateAttendanceChart();
}

function applyFilters(){
  const course = courseFilterEl.value;
  const gender = genderFilterEl.value;
  filtered = students.filter(s=>{
    return (course === 'all' || s.course === course) && (gender === 'all' || s.gender === gender);
  });
  updateAll();
}

// ---------- Charts setup ----------
const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
const genderCtx = document.getElementById('genderChart').getContext('2d');
const gradeCtx = document.getElementById('gradeChart').getContext('2d');
const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');

let enrollmentChart = new Chart(enrollmentCtx, {
  type: 'bar',
  data: { labels: [], datasets: [{ label:'Students', data: [], backgroundColor:'#6f63f8' }] },
  options: { responsive:true, plugins:{legend:{display:false}} }
});

let genderChart = new Chart(genderCtx, {
  type: 'doughnut',
  data: { labels: ['Male','Female','Other'], datasets:[ {data:[0,0,0], backgroundColor:['#4b8ef7','#f76c9e','#f7b84b']} ]},
  options: { responsive:true }
});

let gradeChart = new Chart(gradeCtx, {
  type: 'line',
  data: { labels: [], datasets:[ { label:'Avg Grade', data:[], fill:false, borderColor:'#00b894', tension:0.2 } ]},
  options: { responsive:true, scales:{y:{beginAtZero:true, max:100}} }
});

let attendanceChart = new Chart(attendanceCtx, {
  type: 'line',
  data: { labels: Array.from({length:12}, (_,i)=>`W-${11-i}`), datasets: [] },
  options: { responsive:true, scales:{y:{beginAtZero:true, max:100}} }
});

// chart update helpers
function updateEnrollmentChart(){
  const counts = {};
  COURSES.forEach(c=>counts[c]=0);
  filtered.forEach(s=> counts[s.course] = (counts[s.course]||0)+1 );
  enrollmentChart.data.labels = Object.keys(counts);
  enrollmentChart.data.datasets[0].data = Object.values(counts);
  enrollmentChart.update();
}

function updateGenderChart(){
  const counts = {male:0,female:0,other:0};
  // if a course filter selected, show that course only; otherwise overall
  const course = courseFilterEl.value;
  const list = (course === 'all') ? filtered : filtered.filter(s=>s.course===course);
  list.forEach(s=> counts[s.gender] = (counts[s.gender]||0)+1);
  genderChart.data.datasets[0].data = [counts.male, counts.female, counts.other];
  genderChart.update();
}

function updateGradeChart(){
  // avg grade per course
  const avg = COURSES.map(c=> {
    const list = filtered.filter(s=>s.course===c);
    return list.length ? (list.reduce((a,b)=>a+b.grade,0)/list.length).toFixed(1) : 0;
  });
  gradeChart.data.labels = COURSES;
  gradeChart.data.datasets[0].data = avg;
  gradeChart.update();
}

function updateAttendanceChart(){
  // show overall attendance trend (average per week across filtered students)
  const weeks = 12;
  const weeklyAvg = Array.from({length:weeks}, (_,w)=>{
    const vals = filtered.map(s=> s.weeks[w] );
    return vals.length ? Math.round(mean(vals)) : 0;
  });
  attendanceChart.data.datasets = [{
    label:'Avg Attendance %',
    data: weeklyAvg,
    borderColor:'#ff6b6b',
    fill:false,
    tension:0.2
  }];
  attendanceChart.update();
}

// export CSV
document.getElementById('exportCSV').addEventListener('click', ()=>{
  const rows = [
    ['id','name','gender','course','grade','attendance','status']
  ];
  filtered.forEach(s=> rows.push([s.id,s.name,s.gender,s.course,s.grade,s.attendance,s.status]));
  const csv = rows.map(r=> r.map(c=> `"${String(c).replace(/"/g,'""')}"`).join(',')).join('\n');
  const blob = new Blob([csv], {type:'text/csv'});
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a'); a.href = url; a.download = 'students.csv'; a.click();
  URL.revokeObjectURL(url);
});

// initialize
updateAll();

// small responsive tweak: resize charts on container change
window.addEventListener('resize', ()=> {
  enrollmentChart.resize(); genderChart.resize(); gradeChart.resize(); attendanceChart.resize();
});
</script>

<style>
/* minimal button style */
.btn { font-family: inherit; }
</style>
@endsection
