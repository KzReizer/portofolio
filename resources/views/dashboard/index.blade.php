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

    <div class="site-shell">
        <header class="site-header">
            <nav class="nav">
                <a class="brand" href="{{ route('portfolio.index') }}">
                    <span class="brand-mark">{{ substr($initials, 0, 2) }}</span>
                    <span>Portfolio</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('portfolio.index') }}">Preview</a>
                    <a href="#profile">Profil</a>
                    <a href="#skills">Skill</a>
                    <a href="#experiences">Pengalaman</a>
                    <a href="#education">Pendidikan</a>
                    <a href="#projects">Project</a>
                </div>
            </nav>
        </header>

        <main class="container admin-page">
            <div class="admin-hero">
                <div>
                    <p class="eyebrow">Dashboard</p>
                    <h1>Kelola Portfolio</h1>
                    <p>{{ $name }} - {{ $profile->headline ?: 'Web Developer' }}</p>
                </div>
                <a class="button button-secondary" href="{{ route('portfolio.index') }}">Lihat Halaman</a>
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

            <div class="stats">
                <div class="stat">
                    <strong>{{ $skills->count() }}</strong>
                    <span>Skill</span>
                </div>
                <div class="stat">
                    <strong>{{ $experiences->count() }}</strong>
                    <span>Pengalaman</span>
                </div>
                <div class="stat">
                    <strong>{{ $educations->count() }}</strong>
                    <span>Pendidikan</span>
                </div>
                <div class="stat">
                    <strong>{{ $projects->count() }}</strong>
                    <span>Project</span>
                </div>
            </div>

            <section class="admin-section" id="profile">
                <h2>Profil</h2>
                <div class="admin-surface">
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
                                <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}">
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
                                    @endif
                                </div>
                            </div>
                            <div class="field full">
                                <label>Tentang Saya</label>
                                <textarea name="about" rows="5">{{ old('about', $profile->about) }}</textarea>
                            </div>
                            <label class="check-field full">
                                <input type="checkbox" name="remove_photo" value="1">
                                Hapus foto
                            </label>
                        </div>

                        <div class="form-actions">
                            <button class="button" type="submit">Simpan Profil</button>
                        </div>
                    </form>
                </div>
            </section>

            <section class="admin-section" id="skills">
                <h2>Skill</h2>
                <div class="admin-surface">
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
            </section>

            <section class="admin-section" id="experiences">
                <h2>Pengalaman</h2>
                <div class="admin-surface">
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
            </section>

            <section class="admin-section" id="education">
                <h2>Pendidikan</h2>
                <div class="admin-surface">
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
            </section>

            <section class="admin-section" id="projects">
                <h2>Project</h2>
                <div class="admin-surface">
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
            </section>
        </main>
    </div>
@endsection
