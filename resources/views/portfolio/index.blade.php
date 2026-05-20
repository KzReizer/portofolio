@extends('layouts.app')

@section('title', ($profile->name ?: 'Portfolio').' | Portfolio')

@section('content')
    @php
        $name = $profile->name ?: 'Nama Kamu';
        $initials = collect(preg_split('/\s+/', trim($name)))
            ->filter()
            ->take(2)
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->implode('') ?: 'NK';
    @endphp

    <div class="site-shell">
        <header class="site-header">
            <nav class="nav">
                <a class="brand" href="{{ route('portfolio.index') }}">
                    <span class="brand-mark">{{ substr($initials, 0, 2) }}</span>
                    <span>{{ $name }}</span>
                </a>

                <div class="nav-links">
                    <a href="#about">Tentang</a>
                    <a href="#skills">Skill</a>
                    <a href="#experience">Pengalaman</a>
                    <a href="#education">Pendidikan</a>
                    <a href="#projects">Project</a>
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </div>
            </nav>
        </header>

        <main>
            <section class="container hero">
                <div>
                    <p class="eyebrow">Portfolio</p>
                    <h1>{{ $name }}</h1>
                    <p class="lead">{{ $profile->headline ?: 'Web Developer yang membangun pengalaman digital yang rapi, cepat, dan mudah digunakan.' }}</p>

                    <div class="hero-meta">
                        @if ($profile->address)
                            <span class="pill">{{ $profile->address }}</span>
                        @endif
                        @if ($profile->email)
                            <span class="pill">{{ $profile->email }}</span>
                        @endif
                        @if ($profile->phone)
                            <span class="pill">{{ $profile->phone }}</span>
                        @endif
                    </div>

                    <div class="hero-actions">
                        <a class="button" href="#projects">Lihat Project</a>
                        <a class="button button-secondary" href="{{ route('dashboard.index') }}">Edit Portfolio</a>
                    </div>
                </div>

                <div class="portrait-frame">
                    <div class="portrait">
                        @if ($profile->photo_url)
                            <img src="{{ $profile->photo_url }}" alt="Foto profil {{ $name }}">
                        @else
                            <span class="portrait-placeholder">{{ substr($initials, 0, 2) }}</span>
                        @endif
                    </div>
                </div>
            </section>

            <section class="section" id="about">
                <div class="container">
                    <div class="section-header">
                        <p class="section-kicker">Tentang Saya</p>
                        <div>
                            <h2 class="section-title">Profil singkat</h2>
                            <p class="section-copy">{{ $profile->about ?: 'Ceritakan tentang diri kamu, fokus kerja, gaya belajar, dan jenis project yang paling kamu suka lewat dashboard.' }}</p>
                        </div>
                    </div>

                    <div class="split-grid">
                        <ul class="info-list">
                            <li><span>Nama</span><strong>{{ $name }}</strong></li>
                            <li><span>Alamat</span><strong>{{ $profile->address ?: '-' }}</strong></li>
                            <li><span>Email</span><strong>{{ $profile->email ?: '-' }}</strong></li>
                            <li><span>Telepon</span><strong>{{ $profile->phone ?: '-' }}</strong></li>
                        </ul>

                        <div class="card timeline-card">
                            <p class="period">Fokus</p>
                            <h3>{{ $profile->headline ?: 'Web Developer' }}</h3>
                            <p>{{ $profile->about ?: 'Portfolio ini sudah terhubung database, jadi semua konten dapat kamu ubah dari dashboard.' }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section" id="skills">
                <div class="container">
                    <div class="section-header">
                        <p class="section-kicker">Skill</p>
                        <div>
                            <h2 class="section-title">Kemampuan utama</h2>
                            <p class="section-copy">Kumpulan skill yang paling sering kamu gunakan dalam pekerjaan dan project.</p>
                        </div>
                    </div>

                    <div class="skill-grid">
                        @forelse ($skills as $skill)
                            <article class="card skill-card">
                                <h3>{{ $skill->name }}</h3>
                                <p>{{ $skill->category ?: 'Skill' }} - {{ $skill->level }}%</p>
                                <div class="meter" aria-label="Level {{ $skill->level }} persen">
                                    <span style="width: {{ $skill->level }}%"></span>
                                </div>
                            </article>
                        @empty
                            <div class="empty-state">Belum ada skill.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="section" id="experience">
                <div class="container">
                    <div class="section-header">
                        <p class="section-kicker">Pengalaman</p>
                        <div>
                            <h2 class="section-title">Riwayat pengalaman</h2>
                            <p class="section-copy">Pengalaman kerja, organisasi, freelance, magang, atau project kolaborasi.</p>
                        </div>
                    </div>

                    <div class="timeline-grid">
                        @forelse ($experiences as $experience)
                            <article class="card timeline-card">
                                <p class="period">{{ $experience->period ?: 'Periode' }}</p>
                                <h3>{{ $experience->role }}</h3>
                                <p><strong>{{ $experience->company }}</strong>{{ $experience->location ? ' - '.$experience->location : '' }}</p>
                                <p>{{ $experience->description }}</p>
                            </article>
                        @empty
                            <div class="empty-state">Belum ada pengalaman.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="section" id="education">
                <div class="container">
                    <div class="section-header">
                        <p class="section-kicker">Pendidikan</p>
                        <div>
                            <h2 class="section-title">Latar pendidikan</h2>
                            <p class="section-copy">Sekolah, kampus, kursus, bootcamp, atau sertifikasi yang relevan.</p>
                        </div>
                    </div>

                    <div class="timeline-grid">
                        @forelse ($educations as $education)
                            <article class="card timeline-card">
                                <p class="period">{{ $education->period ?: 'Periode' }}</p>
                                <h3>{{ $education->institution }}</h3>
                                <p><strong>{{ $education->degree ?: 'Pendidikan' }}</strong>{{ $education->field ? ' - '.$education->field : '' }}</p>
                                <p>{{ $education->description }}</p>
                            </article>
                        @empty
                            <div class="empty-state">Belum ada pendidikan.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="section" id="projects">
                <div class="container">
                    <div class="section-header">
                        <p class="section-kicker">Project Saya</p>
                        <div>
                            <h2 class="section-title">Karya pilihan</h2>
                            <p class="section-copy">Project yang bisa ditampilkan sebagai bukti kemampuan dan proses belajar.</p>
                        </div>
                    </div>

                    <div class="project-grid">
                        @forelse ($projects as $project)
                            <article class="card project-card">
                                <div class="project-image">
                                    @if ($project->image_url)
                                        <img src="{{ $project->image_url }}" alt="Gambar project {{ $project->name }}">
                                    @else
                                        <span>{{ $project->name }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h3>{{ $project->name }}</h3>
                                    @if ($project->tech_stack)
                                        <p class="tech">{{ $project->tech_stack }}</p>
                                    @endif
                                    <p>{{ $project->description }}</p>
                                    @if ($project->link)
                                        <a class="button button-secondary" href="{{ $project->link }}" target="_blank" rel="noreferrer">Buka Project</a>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="empty-state">Belum ada project.</div>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>

        <footer class="footer">
            <div class="container">
                <span>{{ $name }} - Portfolio</span>
            </div>
        </footer>
    </div>
@endsection
