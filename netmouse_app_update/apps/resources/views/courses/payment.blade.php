<h1>Payment for {{ $course->title }}</h1>

<form method="POST" action="{{ route('courses.processPayment', $course->id) }}">
    @csrf
    <p>Course Price: ${{ $course->price }}</p>
    <button type="submit" class="btn btn-primary">Complete Payment</button>
</form>
