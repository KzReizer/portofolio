<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Nova Astra | Creative Developer & Designer</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #FCF9F4;
      color: #1A1E24;
      line-height: 1.5;
      scroll-behavior: smooth;
    }

    /* toggle between views */
    .view {
      display: none;
    }
    .view.active {
      display: block;
    }

    /* dashboard specific styles */
    .dashboard-container {
      display: flex;
      min-height: 100vh;
      background: #F4F1E9;
    }
    .dashboard-sidebar {
      width: 280px;
      background: #1A2C2E;
      color: #E9E0D3;
      padding: 2rem 1.5rem;
      position: sticky;
      top: 0;
      height: 100vh;
    }
    .dashboard-sidebar .logo-small {
      font-size: 1.8rem;
      font-weight: 800;
      margin-bottom: 2rem;
      color: white;
    }
    .dashboard-sidebar nav a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 0.8rem 1rem;
      border-radius: 1rem;
      color: #CFDCD9;
      margin-bottom: 0.5rem;
      transition: 0.2s;
    }
    .dashboard-sidebar nav a:hover, .dashboard-sidebar nav a.active {
      background: rgba(230,177,126,0.15);
      color: #E6B17E;
    }
    .dashboard-main {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
    }
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4,1fr);
      gap: 1.2rem;
      margin-bottom: 2rem;
    }
    .stat-card {
      background: white;
      padding: 1.5rem;
      border-radius: 1.2rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.03);
      border: 1px solid #EFE8DE;
    }
    .stat-card h3 { font-size: 1.8rem; font-weight: 800; color: #1E6F5C; }
    .admin-panel {
      background: white;
      border-radius: 1.5rem;
      margin-bottom: 2rem;
      border: 1px solid #EFE8DE;
      overflow: hidden;
    }
    .admin-panel-head {
      padding: 1.2rem 1.5rem;
      background: #F9F6F0;
      border-bottom: 1px solid #EFE8DE;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .admin-panel-body { padding: 1.5rem; }
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2,1fr);
      gap: 1rem;
    }
    .full-width { grid-column: span 2; }
    input, textarea, select {
      width: 100%;
      padding: 0.7rem 1rem;
      border: 1px solid #E0D6CB;
      border-radius: 1rem;
      font-family: inherit;
    }
    button {
      cursor: pointer;
    }
    .btn-sm {
      padding: 0.4rem 1rem;
      border-radius: 2rem;
      border: none;
      font-weight: 600;
    }
    .btn-success { background: #1E6F5C; color: white; }
    .btn-warning { background: #E6B17E; color: #1A2C2E; }
    .btn-danger { background: #C85C5C; color: white; }
    .record-list {
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
      margin-top: 1rem;
    }
    .record-item {
      background: #FCF9F4;
      border-radius: 1rem;
      padding: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border: 1px solid #EFE8DE;
    }
    @media (max-width: 800px) {
      .dashboard-container { flex-direction: column; }
      .dashboard-sidebar { width: 100%; height: auto; position: relative; }
      .stats-grid { grid-template-columns: repeat(2,1fr); }
      .form-grid { grid-template-columns: 1fr; }
      .full-width { grid-column: span 1; }
    }
  </style>
</head>
<body>

<!-- PORTFOLIO VIEW (PUBLIC) -->
<div id="portfolioView" class="view active">
  <!-- same modern header & hero from before (compact version) -->
  <div class="glass-nav">
    <div class="container nav-wrapper" style="max-width:1280px; margin:0 auto; padding:0 2rem;">
      <div class="logo"><i class="fas fa-code"></i> NovaAstra</div>
      <div class="nav-links">
        <a href="#home">Home</a><a href="#skills">Skills</a><a href="#work">Work</a><a href="#experience">Experience</a><a href="#contact">Contact</a>
        <button class="btn-primary" id="goToDashboardBtn"><i class="fas fa-lock"></i> Admin</button>
      </div>
    </div>
  </div>
  <main>
    <section id="home"><div class="container hero" style="max-width:1280px; margin:0 auto; padding:5rem 2rem;">
      <div><div class="hero-badge"><i class="fas fa-sparkle"></i> creative + code</div>
      <h1>Crafting digital <span class="hero-gradient-text">experiences</span> with soul</h1>
      <p>Hi, I'm Nova Astra — creative developer & UI/UX architect. I transform complex ideas into elegant interfaces.</p>
      <div class="hero-actions"><a href="#work" class="btn-primary">See Projects</a><a href="#contact" class="btn-outline">Let's talk</a></div>
    </div>
    <div class="avatar-card"><div class="avatar-image"><i class="fas fa-crown"></i><i class="fas fa-laptop-code"></i></div></div></div></section>

    <section id="skills"><div class="container"><div class="section-header"><div class="tag">expertise</div><h2>Technologies I master</h2></div>
    <div class="skills-grid" id="skillsListPortfolio"><!-- dynamic from localStorage or default --></div></div></section>

    <section id="work" style="background:#F9F6F0;"><div class="container"><div class="section-header"><div class="tag">selected work</div><h2>Digital creations</h2></div>
    <div class="projects-grid" id="projectsListPortfolio"></div></div></section>

    <section id="experience"><div class="container"><div class="section-header"><div class="tag">journey</div><h2>Experience</h2></div>
    <div class="timeline" id="timelinePortfolio"></div></div></section>

    <section id="contact" style="background:#F9F6F0;"><div class="container"><div class="section-header"><div class="tag">connect</div><h2>Let's create</h2></div>
    <div class="contact-grid"><div><div class="contact-info-item"><div class="contact-icon"><i class="fas fa-envelope"></i></div><div><strong>hello@novaastra.dev</strong></div></div><div class="social-links"><div class="social-icon"><i class="fab fa-github"></i></div><div class="social-icon"><i class="fab fa-linkedin"></i></div></div></div>
    <form id="contactForm"><input type="text" placeholder="Name"><input type="email" placeholder="Email"><textarea rows="2" placeholder="Message"></textarea><button type="submit" class="btn-primary">Send</button></form></div></div></section>
  </main>
  <footer class="footer"><div class="container"><p>© 2025 Nova Astra — modern portfolio</p></div></footer>
</div>

<!-- DASHBOARD VIEW (ADMIN) -->
<div id="dashboardView" class="view">
  <div class="dashboard-container">
    <aside class="dashboard-sidebar">
      <div class="logo-small"><i class="fas fa-crown"></i> AstraCMS</div>
      <nav>
        <a href="#" class="dashboard-nav-link" data-section="skills-section"><i class="fas fa-code"></i> Skills</a>
        <a href="#" class="dashboard-nav-link" data-section="projects-section"><i class="fas fa-folder"></i> Projects</a>
        <a href="#" class="dashboard-nav-link" data-section="experience-section"><i class="fas fa-briefcase"></i> Experience</a>
        <a href="#" id="logoutDashboardBtn" style="margin-top:2rem;"><i class="fas fa-sign-out-alt"></i> Back to site</a>
      </nav>
    </aside>
    <main class="dashboard-main">
      <div class="stats-grid">
        <div class="stat-card"><h3 id="statSkills">0</h3><span>Skills</span></div>
        <div class="stat-card"><h3 id="statProjects">0</h3><span>Projects</span></div>
        <div class="stat-card"><h3 id="statExp">0</h3><span>Experiences</span></div>
      </div>

      <!-- Skills CRUD -->
      <div id="skills-section" class="admin-panel">
        <div class="admin-panel-head"><h3><i class="fas fa-microchip"></i> Manage Skills</h3><button class="btn-sm btn-success" id="openSkillFormBtn">+ Add Skill</button></div>
        <div class="admin-panel-body">
          <div id="skillFormContainer" style="display:none; margin-bottom:1rem; background:#F9F6F0; padding:1rem; border-radius:1rem;">
            <input type="text" id="skillName" placeholder="Skill name (e.g. React)">
            <input type="number" id="skillPercent" placeholder="Proficiency %" min="0" max="100">
            <div style="margin-top:0.5rem;"><button id="saveSkillBtn" class="btn-sm btn-success">Save</button> <button id="cancelSkillBtn" class="btn-sm">Cancel</button></div>
            <input type="hidden" id="editSkillId" value="">
          </div>
          <div id="skillsListAdmin" class="record-list"></div>
        </div>
      </div>

      <!-- Projects CRUD -->
      <div id="projects-section" class="admin-panel" style="margin-top:1.5rem;">
        <div class="admin-panel-head"><h3><i class="fas fa-project-diagram"></i> Manage Projects</h3><button class="btn-sm btn-success" id="openProjectFormBtn">+ Add Project</button></div>
        <div class="admin-panel-body">
          <div id="projectFormContainer" style="display:none; margin-bottom:1rem; background:#F9F6F0; padding:1rem; border-radius:1rem;">
            <input type="text" id="projectTitle" placeholder="Project title">
            <textarea id="projectDesc" placeholder="Short description"></textarea>
            <input type="text" id="projectTech" placeholder="Tech stack (comma separated)">
            <div><button id="saveProjectBtn" class="btn-sm btn-success">Save</button> <button id="cancelProjectBtn" class="btn-sm">Cancel</button></div>
            <input type="hidden" id="editProjectId" value="">
          </div>
          <div id="projectsListAdmin" class="record-list"></div>
        </div>
      </div>

      <!-- Experience CRUD -->
      <div id="experience-section" class="admin-panel" style="margin-top:1.5rem;">
        <div class="admin-panel-head"><h3><i class="fas fa-timeline"></i> Manage Experience</h3><button class="btn-sm btn-success" id="openExpFormBtn">+ Add Experience</button></div>
        <div class="admin-panel-body">
          <div id="expFormContainer" style="display:none; margin-bottom:1rem; background:#F9F6F0; padding:1rem; border-radius:1rem;">
            <input type="text" id="expTitle" placeholder="Job title / Role">
            <input type="text" id="expCompany" placeholder="Company / Organization">
            <input type="text" id="expPeriod" placeholder="e.g. 2022 — Present">
            <textarea id="expDesc" placeholder="Description"></textarea>
            <div><button id="saveExpBtn" class="btn-sm btn-success">Save</button> <button id="cancelExpBtn" class="btn-sm">Cancel</button></div>
            <input type="hidden" id="editExpId" value="">
          </div>
          <div id="expListAdmin" class="record-list"></div>
        </div>
      </div>
    </main>
  </div>
</div>

<script>
  // ---------- DATA MODELS ----------
  let skills = [
    { id: "s1", name: "React.js", percent: 92 },
    { id: "s2", name: "Vue.js", percent: 85 },
    { id: "s3", name: "UI/UX Design", percent: 88 }
  ];
  let projects = [
    { id: "p1", title: "Finwise AI", desc: "AI financial dashboard", tech: "React, D3, FastAPI" },
    { id: "p2", title: "ArtisanMarket", desc: "Eco marketplace", tech: "Vue, Laravel" }
  ];
  let experiences = [
    { id: "e1", title: "Lead Frontend Architect", company: "Lumen Studio", period: "2022 — Present", desc: "Design systems, performance optimization." },
    { id: "e2", title: "Creative UI Developer", company: "Orbit Digital", period: "2020 — 2022", desc: "Built interactive components." }
  ];

  function saveDataToLocal() {
    localStorage.setItem('astra_skills', JSON.stringify(skills));
    localStorage.setItem('astra_projects', JSON.stringify(projects));
    localStorage.setItem('astra_experiences', JSON.stringify(experiences));
  }

  function loadDataFromLocal() {
    const localSkills = localStorage.getItem('astra_skills');
    const localProjects = localStorage.getItem('astra_projects');
    const localExps = localStorage.getItem('astra_experiences');
    if(localSkills) skills = JSON.parse(localSkills);
    if(localProjects) projects = JSON.parse(localProjects);
    if(localExps) experiences = JSON.parse(localExps);
  }
  loadDataFromLocal();

  // Helper render functions
  function renderAll() {
    renderSkillsAdmin(); renderProjectsAdmin(); renderExpAdmin();
    renderPortfolioSkills(); renderPortfolioProjects(); renderPortfolioTimeline();
    updateStats();
  }

  function updateStats() {
    document.getElementById('statSkills').innerText = skills.length;
    document.getElementById('statProjects').innerText = projects.length;
    document.getElementById('statExp').innerText = experiences.length;
  }

  // Portfolio renderers
  function renderPortfolioSkills() {
    const container = document.getElementById('skillsListPortfolio');
    if(container) container.innerHTML = skills.map(s => `<div class="skill-card-modern"><div class="skill-icon"><i class="fab fa-react"></i></div><h3>${escapeHtml(s.name)}</h3><div class="skill-level"><div class="skill-level-fill" style="width: ${s.percent}%"></div></div><small>${s.percent}% mastery</small></div>`).join('');
  }
  function renderPortfolioProjects() {
    const container = document.getElementById('projectsListPortfolio');
    if(container) container.innerHTML = projects.map(p => `<div class="project-card-modern"><div class="project-img"><i class="fas fa-layer-group"></i></div><div class="project-info"><h3>${escapeHtml(p.title)}</h3><p>${escapeHtml(p.desc)}</p><div class="tech-stack">${p.tech.split(',').map(t => `<span class="tech-badge">${escapeHtml(t.trim())}</span>`).join('')}</div></div></div>`).join('');
  }
  function renderPortfolioTimeline() {
    const container = document.getElementById('timelinePortfolio');
    if(container) container.innerHTML = experiences.map(e => `<div class="timeline-item"><div class="timeline-year">${escapeHtml(e.period)}</div><div class="timeline-content"><h4>${escapeHtml(e.title)} · ${escapeHtml(e.company)}</h4><p>${escapeHtml(e.desc)}</p></div></div>`).join('');
  }

  // Admin renders
  function renderSkillsAdmin() {
    const container = document.getElementById('skillsListAdmin');
    container.innerHTML = skills.map(s => `<div class="record-item"><div><strong>${escapeHtml(s.name)}</strong> (${s.percent}%)</div><div><button class="btn-sm btn-warning edit-skill" data-id="${s.id}">Edit</button> <button class="btn-sm btn-danger delete-skill" data-id="${s.id}">Del</button></div></div>`).join('');
    document.querySelectorAll('.edit-skill').forEach(btn => btn.addEventListener('click', (e) => { let id=btn.dataset.id; openSkillEdit(id); }));
    document.querySelectorAll('.delete-skill').forEach(btn => btn.addEventListener('click', (e) => { let id=btn.dataset.id; skills = skills.filter(s=>s.id!==id); saveDataToLocal(); renderAll(); }));
  }
  function renderProjectsAdmin() {
    const container = document.getElementById('projectsListAdmin');
    container.innerHTML = projects.map(p => `<div class="record-item"><div><strong>${escapeHtml(p.title)}</strong><br><small>${escapeHtml(p.tech)}</small></div><div><button class="btn-sm btn-warning edit-project" data-id="${p.id}">Edit</button> <button class="btn-sm btn-danger delete-project" data-id="${p.id}">Del</button></div></div>`).join('');
    document.querySelectorAll('.edit-project').forEach(btn => btn.addEventListener('click', (e) => { let id=btn.dataset.id; openProjectEdit(id); }));
    document.querySelectorAll('.delete-project').forEach(btn => btn.addEventListener('click', (e) => { let id=btn.dataset.id; projects = projects.filter(p=>p.id!==id); saveDataToLocal(); renderAll(); }));
  }
  function renderExpAdmin() {
    const container = document.getElementById('expListAdmin');
    container.innerHTML = experiences.map(e => `<div class="record-item"><div><strong>${escapeHtml(e.title)}</strong> at ${escapeHtml(e.company)}<br><small>${escapeHtml(e.period)}</small></div><div><button class="btn-sm btn-warning edit-exp" data-id="${e.id}">Edit</button> <button class="btn-sm btn-danger delete-exp" data-id="${e.id}">Del</button></div></div>`).join('');
    document.querySelectorAll('.edit-exp').forEach(btn => btn.addEventListener('click', (e) => { let id=btn.dataset.id; openExpEdit(id); }));
    document.querySelectorAll('.delete-exp').forEach(btn => btn.addEventListener('click', (e) => { let id=btn.dataset.id; experiences = experiences.filter(e=>e.id!==id); saveDataToLocal(); renderAll(); }));
  }

  function openSkillEdit(id) { let skill = skills.find(s=>s.id===id); if(skill){ document.getElementById('skillName').value=skill.name; document.getElementById('skillPercent').value=skill.percent; document.getElementById('editSkillId').value=skill.id; document.getElementById('skillFormContainer').style.display='block'; } }
  function openProjectEdit(id) { let proj = projects.find(p=>p.id===id); if(proj){ document.getElementById('projectTitle').value=proj.title; document.getElementById('projectDesc').value=proj.desc; document.getElementById('projectTech').value=proj.tech; document.getElementById('editProjectId').value=proj.id; document.getElementById('projectFormContainer').style.display='block'; } }
  function openExpEdit(id) { let exp = experiences.find(e=>e.id===id); if(exp){ document.getElementById('expTitle').value=exp.title; document.getElementById('expCompany').value=exp.company; document.getElementById('expPeriod').value=exp.period; document.getElementById('expDesc').value=exp.desc; document.getElementById('editExpId').value=exp.id; document.getElementById('expFormContainer').style.display='block'; } }

  // Save handlers
  document.getElementById('saveSkillBtn')?.addEventListener('click',()=>{
    let name=document.getElementById('skillName').value, percent=parseInt(document.getElementById('skillPercent').value);
    let id=document.getElementById('editSkillId').value;
    if(id){ let idx=skills.findIndex(s=>s.id===id); if(idx!==-1){ skills[idx]={...skills[idx],name,percent}; } } 
    else { skills.push({id:Date.now()+''+Math.random(),name,percent}); }
    saveDataToLocal(); renderAll(); document.getElementById('skillFormContainer').style.display='none'; document.getElementById('editSkillId').value=''; document.getElementById('skillName').value=''; document.getElementById('skillPercent').value='';
  });
  document.getElementById('saveProjectBtn')?.addEventListener('click',()=>{
    let title=document.getElementById('projectTitle').value, desc=document.getElementById('projectDesc').value, tech=document.getElementById('projectTech').value;
    let id=document.getElementById('editProjectId').value;
    if(id){ let idx=projects.findIndex(p=>p.id===id); if(idx!==-1){ projects[idx]={...projects[idx],title,desc,tech}; } } 
    else { projects.push({id:Date.now()+''+Math.random(),title,desc,tech}); }
    saveDataToLocal(); renderAll(); document.getElementById('projectFormContainer').style.display='none'; document.getElementById('editProjectId').value='';
  });
  document.getElementById('saveExpBtn')?.addEventListener('click',()=>{
    let title=document.getElementById('expTitle').value, company=document.getElementById('expCompany').value, period=document.getElementById('expPeriod').value, desc=document.getElementById('expDesc').value;
    let id=document.getElementById('editExpId').value;
    if(id){ let idx=experiences.findIndex(e=>e.id===id); if(idx!==-1){ experiences[idx]={...experiences[idx],title,company,period,desc}; } }
    else { experiences.push({id:Date.now()+''+Math.random(),title,company,period,desc}); }
    saveDataToLocal(); renderAll(); document.getElementById('expFormContainer').style.display='none'; document.getElementById('editExpId').value='';
  });
  document.getElementById('cancelSkillBtn')?.addEventListener('click',()=>{ document.getElementById('skillFormContainer').style.display='none'; });
  document.getElementById('cancelProjectBtn')?.addEventListener('click',()=>{ document.getElementById('projectFormContainer').style.display='none'; });
  document.getElementById('cancelExpBtn')?.addEventListener('click',()=>{ document.getElementById('expFormContainer').style.display='none'; });
  document.getElementById('openSkillFormBtn')?.addEventListener('click',()=>{ document.getElementById('skillFormContainer').style.display='block'; document.getElementById('editSkillId').value=''; document.getElementById('skillName').value=''; document.getElementById('skillPercent').value=''; });
  document.getElementById('openProjectFormBtn')?.addEventListener('click',()=>{ document.getElementById('projectFormContainer').style.display='block'; document.getElementById('editProjectId').value=''; document.getElementById('projectTitle').value=''; document.getElementById('projectDesc').value=''; document.getElementById('projectTech').value=''; });
  document.getElementById('openExpFormBtn')?.addEventListener('click',()=>{ document.getElementById('expFormContainer').style.display='block'; document.getElementById('editExpId').value=''; document.getElementById('expTitle').value=''; document.getElementById('expCompany').value=''; document.getElementById('expPeriod').value=''; document.getElementById('expDesc').value=''; });

  // VIEW toggling
  document.getElementById('goToDashboardBtn')?.addEventListener('click',()=>{
    document.getElementById('portfolioView').classList.remove('active');
    document.getElementById('dashboardView').classList.add('active');
    renderAll();
  });
  document.getElementById('logoutDashboardBtn')?.addEventListener('click',()=>{
    document.getElementById('dashboardView').classList.remove('active');
    document.getElementById('portfolioView').classList.add('active');
  });
  function escapeHtml(str){ if(!str) return ''; return str.replace(/[&<>]/g, function(m){ if(m==='&') return '&amp;'; if(m==='<') return '&lt;'; if(m==='>') return '&gt;'; return m;}); }

  // nav highlight
  document.querySelectorAll('.dashboard-nav-link').forEach(link=>{
    link.addEventListener('click',(e)=>{ e.preventDefault(); const section=link.dataset.section; document.getElementById(section).scrollIntoView({behavior:'smooth'}); });
  });
  // initial render portfolio data
  renderPortfolioSkills(); renderPortfolioProjects(); renderPortfolioTimeline();
  // default dashboard stats update when opened
</script>
</body>
</html>