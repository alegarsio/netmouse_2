<!-- resources/views/acad.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Judul Halaman -->
        <div class="text-center mb-5">
            <h1 class="display-4 text-primary">Our Academy Courses</h1>
            <p class="lead text-muted">Master the fundamentals of programming, algorithms, and software engineering.</p>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search courses..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>

        <!-- Daftar Kursus -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($courses as $course)
                <div class="col">
                    <div class="card shadow-lg rounded-3 border-light">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Course Image">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $course['title'] }}</h5>
                            <p class="card-text text-muted">{{ $course['description'] }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-info">{{ $course['difficulty'] }}</span>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal{{ $loop->index }}">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Course Details -->
                <div class="modal fade" id="courseModal{{ $loop->index }}" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="courseModalLabel">{{ $course['title'] }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Description</h6>
                                <p>{{ $course['description'] }}</p>
                                <h6>Difficulty</h6>
                                <p>{{ $course['difficulty'] }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="#" class="btn btn-primary">Enroll Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
