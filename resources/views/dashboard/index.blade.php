@extends('layouts.app')

@section('title', 'Dashboard Portfolio')

@section('content')
    @php
        $name = $profile->name ?: 'Nama Kamu';
        $initials = collect(preg_split('/\s+/', trim($name)))
            ->filter()
            ->take(2)
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->implode('') ?: 'NK';
    @endphp

    <div class="dashboard-shell">
        <aside class="dashboard-sidebar">
            <div class="sidebar-brand">
                <span class="sidebar-mark">{{ substr($initials, 0, 2) }}</span>
                <div>
                    <strong>Portfolio Admin</strong>
                    <span>{{ $name }}</span>
                </div>
            </div>

            <nav class="dashboard-nav">
                <a href="#profile">
                    <span style="display: inline-flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Profil
                    </span>
                    <span>01</span>
                </a>
                <a href="#skills">
                    <span style="display: inline-flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.45 1-1 1H4v2h16v-2h-5c-.55 0-1-.45-1-1v-2.34"/><path d="M12 2a6 6 0 0 0-6 6v3.5c0 1.63 1.22 3.03 2.83 3.32a3 3 0 0 0 6.34 0c1.61-.29 2.83-1.69 2.83-3.32V8a6 6 0 0 0-6-6Z"/></svg>
                        Skill
                    </span>
                    <span>02</span>
                </a>
                <a href="#experiences">
                    <span style="display: inline-flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
                        Pengalaman
                    </span>
                    <span>03</span>
                </a>
                <a href="#education">
                    <span style="display: inline-flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M6 18.8v-4L2 13"/><path d="M21.4 12v6c0 .5-.4 1-1 1H12"/></svg>
                        Pendidikan
                    </span>
                    <span>04</span>
                </a>
                <a href="#projects">
                    <span style="display: inline-flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg>
                        Project
                    </span>
                    <span>05</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <strong>{{ auth()->user()->name }}</strong>
                    {{ auth()->user()->email }}
                </div>
                <a class="button button-secondary" href="{{ route('portfolio.index') }}">Preview Portfolio</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="button logout-button" type="submit">Logout</button>
                </form>
            </div>
        </aside>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <p class="eyebrow">Dashboard</p>
                    <h1 class="dashboard-title">Kelola Portfolio</h1>
                    <p class="dashboard-subtitle">Semua konten halaman portfolio tersimpan di database dan hanya admin yang bisa mengubahnya.</p>
                </div>
                <div class="dashboard-actions">
                    <a class="button button-secondary" href="{{ route('projects.index') }}">Lihat Project</a>
                    <a class="button" href="{{ route('portfolio.index') }}">Buka Website</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Input belum valid.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="metric-grid">
                <div class="metric-card">
                    <strong>{{ $skills->count() }}</strong>
                    <span>Skill aktif</span>
                </div>
                <div class="metric-card">
                    <strong>{{ $experiences->count() }}</strong>
                    <span>Pengalaman</span>
                </div>
                <div class="metric-card">
                    <strong>{{ $educations->count() }}</strong>
                    <span>Pendidikan</span>
                </div>
                <div class="metric-card">
                    <strong>{{ $projects->count() }}</strong>
                    <span>Project</span>
                </div>
            </div>

            <section class="admin-section" id="profile">
                <div class="admin-panel alt-green">
                    <div class="admin-panel-head">
                        <div>
                            <p class="section-kicker">Profil</p>
                            <h2>Identitas utama</h2>
                            <p>Nama, foto, alamat, dan ringkasan yang tampil di halaman depan.</p>
                        </div>
                        <span class="pill">Hero portfolio</span>
                    </div>

                    <div class="admin-panel-body">
                        <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-grid">
                                <div class="field">
                                    <label>Nama</label>
                                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" required>
                                </div>
                                <div class="field">
                                    <label>Headline</label>
                                    <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}" placeholder="Web Developer">
                                </div>
                                <div class="field">
                                    <label>Alamat</label>
                                    <input type="text" name="address" value="{{ old('address', $profile->address) }}">
                                </div>
                                <div class="field">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ old('email', $profile->email) }}">
                                </div>
                                <div class="field">
                                    <label>Telepon</label>
                                    <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}">
                                </div>
                                <div class="field">
                                    <label>Link Foto</label>
                                    <input type="url" name="photo_url" value="{{ old('photo_url') }}" placeholder="https://...">
                                </div>
                                <div class="field">
                                    <label>Upload Foto</label>
                                    <input type="file" name="photo" accept="image/*">
                                </div>
                                <div class="field">
                                    <span class="field-label">Foto Saat Ini</span>
                                    <div class="thumb">
                                        @if ($profile->photo_url)
                                            <img src="{{ $profile->photo_url }}" alt="Foto profil">
                                        @else
                                            Belum ada
                                        @endif
                                    </div>
                                </div>
                                <div class="field full">
                                    <label>Tentang Saya</label>
                                    <textarea name="about" rows="5">{{ old('about', $profile->about) }}</textarea>
                                </div>
                                <label class="check-field full">
                                    <input type="checkbox" name="remove_photo" value="1">
                                    Hapus foto profil
                                </label>
                            </div>

                            <div class="form-actions">
                                <button class="button" type="submit">Simpan Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="admin-section" id="skills">
                <div class="admin-panel alt-amber">
                    <div class="admin-panel-head">
                        <div>
                            <p class="section-kicker">Skill</p>
                            <h2>Kemampuan</h2>
                            <p>Atur skill, kategori, level, dan urutan tampilnya.</p>
                        </div>
                        <span class="pill">{{ $skills->count() }} data</span>
                    </div>

                    <div class="admin-panel-body">
                        <form action="{{ route('dashboard.skills.store') }}" method="POST">
                            @csrf
                            <div class="form-grid compact">
                                <div class="field">
                                    <label>Nama Skill</label>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="field">
                                    <label>Kategori</label>
                                    <input type="text" name="category">
                                </div>
                                <div class="field">
                                    <label>Level</label>
                                    <input type="number" name="level" min="0" max="100" value="80" required>
                                </div>
                                <div class="field">
                                    <label>Urutan</label>
                                    <input type="number" name="sort_order" min="0" value="0">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="button" type="submit">Tambah Skill</button>
                            </div>
                        </form>

                        <div class="records">
                            @forelse ($skills as $skill)
                                <article class="record">
                                    <div class="record-header">
                                        <strong>{{ $skill->name }}</strong>
                                        <span class="pill">{{ $skill->level }}%</span>
                                    </div>
                                    <form action="{{ route('dashboard.skills.update', $skill) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-grid compact">
                                            <div class="field">
                                                <label>Nama Skill</label>
                                                <input type="text" name="name" value="{{ $skill->name }}" required>
                                            </div>
                                            <div class="field">
                                                <label>Kategori</label>
                                                <input type="text" name="category" value="{{ $skill->category }}">
                                            </div>
                                            <div class="field">
                                                <label>Level</label>
                                                <input type="number" name="level" min="0" max="100" value="{{ $skill->level }}" required>
                                            </div>
                                            <div class="field">
                                                <label>Urutan</label>
                                                <input type="number" name="sort_order" min="0" value="{{ $skill->sort_order }}">
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button class="button button-secondary" type="submit">Update Skill</button>
                                        </div>
                                    </form>
                                    <form class="delete-form" action="{{ route('dashboard.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Hapus skill ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-danger" type="submit">Hapus Skill</button>
                                    </form>
                                </article>
                            @empty
                                <div class="empty-state">Belum ada skill.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <section class="admin-section" id="experiences">
                <div class="admin-panel alt-blue">
                    <div class="admin-panel-head">
                        <div>
                            <p class="section-kicker">Pengalaman</p>
                            <h2>Riwayat kerja</h2>
                            <p>Masukkan pengalaman kerja, magang, organisasi, freelance, atau project kolaborasi.</p>
                        </div>
                        <span class="pill">{{ $experiences->count() }} data</span>
                    </div>

                    <div class="admin-panel-body">
                        <form action="{{ route('dashboard.experiences.store') }}" method="POST">
                            @csrf
                            <div class="form-grid">
                                <div class="field">
                                    <label>Posisi</label>
                                    <input type="text" name="role" required>
                                </div>
                                <div class="field">
                                    <label>Perusahaan/Tempat</label>
                                    <input type="text" name="company" required>
                                </div>
                                <div class="field">
                                    <label>Lokasi</label>
                                    <input type="text" name="location">
                                </div>
                                <div class="field">
                                    <label>Periode</label>
                                    <input type="text" name="period" placeholder="2024 - Sekarang">
                                </div>
                                <div class="field">
                                    <label>Urutan</label>
                                    <input type="number" name="sort_order" min="0" value="0">
                                </div>
                                <div class="field full">
                                    <label>Deskripsi</label>
                                    <textarea name="description" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="button" type="submit">Tambah Pengalaman</button>
                            </div>
                        </form>

                        <div class="records">
                            @forelse ($experiences as $experience)
                                <article class="record">
                                    <div class="record-header">
                                        <strong>{{ $experience->role }}</strong>
                                        <span class="pill">{{ $experience->period ?: 'Periode' }}</span>
                                    </div>
                                    <form action="{{ route('dashboard.experiences.update', $experience) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-grid">
                                            <div class="field">
                                                <label>Posisi</label>
                                                <input type="text" name="role" value="{{ $experience->role }}" required>
                                            </div>
                                            <div class="field">
                                                <label>Perusahaan/Tempat</label>
                                                <input type="text" name="company" value="{{ $experience->company }}" required>
                                            </div>
                                            <div class="field">
                                                <label>Lokasi</label>
                                                <input type="text" name="location" value="{{ $experience->location }}">
                                            </div>
                                            <div class="field">
                                                <label>Periode</label>
                                                <input type="text" name="period" value="{{ $experience->period }}">
                                            </div>
                                            <div class="field">
                                                <label>Urutan</label>
                                                <input type="number" name="sort_order" min="0" value="{{ $experience->sort_order }}">
                                            </div>
                                            <div class="field full">
                                                <label>Deskripsi</label>
                                                <textarea name="description" rows="4">{{ $experience->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button class="button button-secondary" type="submit">Update Pengalaman</button>
                                        </div>
                                    </form>
                                    <form class="delete-form" action="{{ route('dashboard.experiences.destroy', $experience) }}" method="POST" onsubmit="return confirm('Hapus pengalaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-danger" type="submit">Hapus Pengalaman</button>
                                    </form>
                                </article>
                            @empty
                                <div class="empty-state">Belum ada pengalaman.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <section class="admin-section" id="education">
                <div class="admin-panel alt-green">
                    <div class="admin-panel-head">
                        <div>
                            <p class="section-kicker">Pendidikan</p>
                            <h2>Latar pendidikan</h2>
                            <p>Kelola sekolah, kampus, kursus, bootcamp, atau sertifikasi yang relevan.</p>
                        </div>
                        <span class="pill">{{ $educations->count() }} data</span>
                    </div>

                    <div class="admin-panel-body">
                        <form action="{{ route('dashboard.educations.store') }}" method="POST">
                            @csrf
                            <div class="form-grid">
                                <div class="field">
                                    <label>Institusi</label>
                                    <input type="text" name="institution" required>
                                </div>
                                <div class="field">
                                    <label>Jenjang</label>
                                    <input type="text" name="degree">
                                </div>
                                <div class="field">
                                    <label>Bidang</label>
                                    <input type="text" name="field">
                                </div>
                                <div class="field">
                                    <label>Periode</label>
                                    <input type="text" name="period" placeholder="2021 - 2025">
                                </div>
                                <div class="field">
                                    <label>Urutan</label>
                                    <input type="number" name="sort_order" min="0" value="0">
                                </div>
                                <div class="field full">
                                    <label>Deskripsi</label>
                                    <textarea name="description" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="button" type="submit">Tambah Pendidikan</button>
                            </div>
                        </form>

                        <div class="records">
                            @forelse ($educations as $education)
                                <article class="record">
                                    <div class="record-header">
                                        <strong>{{ $education->institution }}</strong>
                                        <span class="pill">{{ $education->period ?: 'Periode' }}</span>
                                    </div>
                                    <form action="{{ route('dashboard.educations.update', $education) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-grid">
                                            <div class="field">
                                                <label>Institusi</label>
                                                <input type="text" name="institution" value="{{ $education->institution }}" required>
                                            </div>
                                            <div class="field">
                                                <label>Jenjang</label>
                                                <input type="text" name="degree" value="{{ $education->degree }}">
                                            </div>
                                            <div class="field">
                                                <label>Bidang</label>
                                                <input type="text" name="field" value="{{ $education->field }}">
                                            </div>
                                            <div class="field">
                                                <label>Periode</label>
                                                <input type="text" name="period" value="{{ $education->period }}">
                                            </div>
                                            <div class="field">
                                                <label>Urutan</label>
                                                <input type="number" name="sort_order" min="0" value="{{ $education->sort_order }}">
                                            </div>
                                            <div class="field full">
                                                <label>Deskripsi</label>
                                                <textarea name="description" rows="4">{{ $education->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button class="button button-secondary" type="submit">Update Pendidikan</button>
                                        </div>
                                    </form>
                                    <form class="delete-form" action="{{ route('dashboard.educations.destroy', $education) }}" method="POST" onsubmit="return confirm('Hapus pendidikan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-danger" type="submit">Hapus Pendidikan</button>
                                    </form>
                                </article>
                            @empty
                                <div class="empty-state">Belum ada pendidikan.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <section class="admin-section" id="projects">
                <div class="admin-panel alt-rose">
                    <div class="admin-panel-head">
                        <div>
                            <p class="section-kicker">Project</p>
                            <h2>Project saya</h2>
                            <p>Tambah project yang ingin kamu tampilkan sebagai karya pilihan.</p>
                        </div>
                        <span class="pill">{{ $projects->count() }} data</span>
                    </div>

                    <div class="admin-panel-body">
                        <form action="{{ route('dashboard.projects.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-grid">
                                <div class="field">
                                    <label>Nama Project</label>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="field">
                                    <label>Tech Stack</label>
                                    <input type="text" name="tech_stack" placeholder="Laravel, MySQL, Tailwind">
                                </div>
                                <div class="field">
                                    <label>Link Project</label>
                                    <input type="url" name="link" placeholder="https://...">
                                </div>
                                <div class="field">
                                    <label>Link Gambar</label>
                                    <input type="url" name="image_url" placeholder="https://...">
                                </div>
                                <div class="field">
                                    <label>Upload Gambar</label>
                                    <input type="file" name="image" accept="image/*">
                                </div>
                                <div class="field">
                                    <label>Urutan</label>
                                    <input type="number" name="sort_order" min="0" value="0">
                                </div>
                                <div class="field full">
                                    <label>Deskripsi</label>
                                    <textarea name="description" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="button" type="submit">Tambah Project</button>
                            </div>
                        </form>

                        <div class="records">
                            @forelse ($projects as $project)
                                <article class="record">
                                    <div class="record-header">
                                        <strong>{{ $project->name }}</strong>
                                        <span class="pill">{{ $project->tech_stack ?: 'Project' }}</span>
                                    </div>
                                    <form action="{{ route('dashboard.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-grid">
                                            <div class="field">
                                                <label>Nama Project</label>
                                                <input type="text" name="name" value="{{ $project->name }}" required>
                                            </div>
                                            <div class="field">
                                                <label>Tech Stack</label>
                                                <input type="text" name="tech_stack" value="{{ $project->tech_stack }}">
                                            </div>
                                            <div class="field">
                                                <label>Link Project</label>
                                                <input type="url" name="link" value="{{ $project->link }}">
                                            </div>
                                            <div class="field">
                                                <label>Link Gambar Baru</label>
                                                <input type="url" name="image_url" placeholder="https://...">
                                            </div>
                                            <div class="field">
                                                <label>Upload Gambar Baru</label>
                                                <input type="file" name="image" accept="image/*">
                                            </div>
                                            <div class="field">
                                                <label>Urutan</label>
                                                <input type="number" name="sort_order" min="0" value="{{ $project->sort_order }}">
                                            </div>
                                            <div class="field full">
                                                <label>Deskripsi</label>
                                                <textarea name="description" rows="4">{{ $project->description }}</textarea>
                                            </div>
                                            <label class="check-field full">
                                                <input type="checkbox" name="remove_image" value="1">
                                                Hapus gambar
                                            </label>
                                        </div>
                                        <div class="form-actions">
                                            <button class="button button-secondary" type="submit">Update Project</button>
                                        </div>
                                    </form>
                                    <form class="delete-form" action="{{ route('dashboard.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Hapus project ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-danger" type="submit">Hapus Project</button>
                                    </form>
                                </article>
                            @empty
                                <div class="empty-state">Belum ada project.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection
