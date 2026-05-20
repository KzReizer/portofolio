@extends('layouts.app')

@section('title', 'Project Saya')

@section('content')
    @php
        $displayName = optional($profile)->name ?: 'Portfolio';
    @endphp

    <div class="site-shell">
        <header class="site-header">
            <nav class="nav">
                <a class="brand" href="{{ route('portfolio.index') }}">
                    <span class="brand-mark">PF</span>
                    <span>{{ $displayName }}</span>
                </a>

                <div class="nav-links">
                    <a href="{{ route('portfolio.index') }}">Home</a>
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </div>
            </nav>
        </header>

        <main>
            <section class="section">
                <div class="container">
                    <div class="section-header">
                        <p class="section-kicker">Project Saya</p>
                        <div>
                            <h1 class="section-title">Daftar project</h1>
                            <p class="section-copy">Semua project yang tersimpan di database portfolio.</p>
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
    </div>
@endsection
