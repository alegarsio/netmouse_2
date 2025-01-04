<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\JoinedCourse;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class CourseController extends Controller
{
    /**
     * Tampilkan form untuk membuat kursus baru.
     */
    public function create(Request $request)
    {
        if (!$request->user()->hasRole('mentor') && !$request->user()->hasRole('admin')) {
            abort(403, 'You are not authorized to access this page.');
        }
        
        return view('courses.create');
    }


    public function index(Request $request)
{
    // Validasi role
    if (!$request->user()->hasRole('mentor') && !$request->user()->hasRole('admin')) {
        abort(403, 'You are not authorized to access this page.');
    }

    // Ambil course yang dibuat oleh mentor yang sedang login
    $courses = Course::where('mentor_id', $request->user()->id)->get();

    $gradients = [
        ['#ff7e5f', '#feb47b'],
        ['#6a11cb', '#2575fc'],
        ['#12c2e9', '#c471ed'],
        ['#f64f59', '#c471ed'],
        ['#f093fb', '#f5576c'],
        ['#43cea2', '#185a9d'],
        ['#ff9966', '#ff5e62'],
    ];

    return view('courses.index', compact('courses', 'gradients'));
}

    /**
     * Simpan kursus baru ke database.
     */
    public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'materials' => 'required|array',
            'materials.*.title' => 'required|string|max:255',
            'materials.*.content' => 'required|string',
            'materials.*.image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $mentor = auth()->user();

        DB::beginTransaction();

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'mentor_id' => $mentor->id
        ]);

        foreach ($request->materials as $materialData) {
            $material = Material::create([
                'title' => $materialData['title'],
                'content' => $materialData['content'],
                'course_id' => $course->id,
            ]);

            // Handle upload gambar tanpa storage link
            if (isset($materialData['image']) && $materialData['image']->isValid()) {
                $imageName = time() . '_' . $materialData['image']->getClientOriginalName();
                $destinationPath = public_path('images/materials'); // Path ke direktori public/images/materials
                $materialData['image']->move($destinationPath, $imageName); // Pindahkan gambar ke direktori tujuan

                $material->image_path = 'images/materials/' . $imageName; // Simpan path relatif ke direktori public
                $material->save();
            }
        }

        DB::commit();

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error creating course: ' . $e->getMessage() . "\n" . $e->getTraceAsString());

        return back()->withInput()->with('error', 'Failed to create course. Please try again.');
    }
}
    public function joinCourse(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = Auth::user();
    
        // Logika untuk bergabung ke kursus (misalnya menambahkan ke tabel pivot)
        $user->courses()->attach($courseId);  // Asumsikan ada relasi many-to-many
    
        return redirect()->route('courses.show', $courseId);
    }
    
    public function indexForStudent()
    {
        $courses = Course::all();
        $user = auth()->user();

        return view('courses.student_index', compact('courses', 'user'));
}
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Optional: Add authorization logic to ensure only mentors who created the course can delete it
        if (auth()->user()->id !== $course->mentor_id) {
            return redirect()->route('courses.index')->with('error', 'Unauthorized action.');
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
    public function show($courseId)
{
    
    $course = Course::with(['materials', 'mentor'])->findOrFail($courseId);


    return view('courses.show', compact('course'));
}
    public function showJoinedMaterials()
{
    $studentId = auth()->id();

    // Ambil semua course_id yang diikuti oleh student
    $joinedCourses = DB::table('joined_courses')
        ->where('student_id', $studentId)
        ->pluck('course_id');

    // Ambil materi dari courses yang diikuti
    $materials = DB::table('materials_tables')
        ->whereIn('course_id', $joinedCourses)
        ->get();

    return view('courses.joined_materials', compact('materials'));
}


public function join($courseId)
{
    $user = Auth::user(); // Ambil pengguna yang sedang login
    $course = Course::find($courseId); // Cari kursus berdasarkan ID

    if (!$course) {
        return redirect()->route('courses.index')->with('error', 'Course not found');
    }

    // Cek apakah pengguna sudah mengikuti kursus ini
    $alreadyJoined = JoinedCourse::where('user_id', $user->id)
        ->where('course_id', $courseId)
        ->exists();

    if (!$alreadyJoined) {
        // Tambahkan ke tabel joined_courses
        JoinedCourse::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
        ]);
    }

    return redirect()->route('courses.show', $course->id)->with('success', 'You have joined the course successfully.');
}
    public function myCourses()
    {
        
        $user = Auth::user();

        $courses = Course::where('mentor_id', $user->id)->get();

        return view('courses.my_courses', compact('courses'));
    }
// ...

public function edit(Course $course)
{
    $course->load('materials'); // Load the materials relationship
    return view('courses.edit', compact('course'));
}
public function listJoinedCourses()
{
    $user = Auth::user();

   
    $joinedCourses = JoinedCourse::with('course')
        ->where('user_id', $user->id)
        ->get();

    return view('courses.joined_list', compact('joinedCourses'));
}

public function update(Request $request, Course $course)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'materials' => 'required|array',
        // Validasi untuk ID material diubah agar sesuai dengan nama tabel
        'materials.*.id' => 'nullable|exists:materials_tables,id', // Ganti 'materials' menjadi 'materials_tables'
        'materials.*.title' => 'required|string|max:255',
        'materials.*.content' => 'required|string',
        'materials.*.image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif', // Validasi gambar
    ]);

    DB::beginTransaction();

    try {
        $course->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $existingMaterialIds = [];

        foreach ($request->materials as $materialData) {
            if (isset($materialData['id']) && $material = Material::find($materialData['id'])) {
                // Update materi yang sudah ada
                $material->update([
                    'title' => $materialData['title'],
                    'content' => $materialData['content'],
                ]);

                // Update gambar jika ada
                if (isset($materialData['image']) && $materialData['image']->isValid()) {
                    // Hapus gambar lama jika ada
                    if ($material->image_path && file_exists(public_path($material->image_path))) {
                        unlink(public_path($material->image_path));
                    }

                    // Upload gambar baru
                    $imageName = time() . '_' . $materialData['image']->getClientOriginalName();
                    $destinationPath = public_path('images/materials');
                    $materialData['image']->move($destinationPath, $imageName);
                    $material->image_path = 'images/materials/' . $imageName;
                    $material->save();
                }

                $existingMaterialIds[] = $material->id;
            } else {
                // Buat materi baru jika belum ada
                $material = $course->materials()->create([
                    'title' => $materialData['title'],
                    'content' => $materialData['content'],
                ]);

                // Upload gambar untuk materi baru
                if (isset($materialData['image']) && $materialData['image']->isValid()) {
                    $imageName = time() . '_' . $materialData['image']->getClientOriginalName();
                    $destinationPath = public_path('images/materials');
                    $materialData['image']->move($destinationPath, $imageName);
                    $material->image_path = 'images/materials/' . $imageName;
                    $material->save();
                }
                $existingMaterialIds[] = $material->id;
            }
        }

        // Hapus materi yang tidak ada di request
        $course->materials()->whereNotIn('id', $existingMaterialIds)->delete();

        DB::commit();

        return redirect()->route('courses.show', $course->id)->with('success', 'Course updated successfully.');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Error updating course: ' . $e->getMessage() . "\n" . $e->getTraceAsString());

        return back()->withInput()->with('error', 'Failed to update course. Please try again.');
    }
}

    public function showImage($filename)
    {
        $path = 'public/materials/' . $filename;
        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $type = Storage::mimeType($path);
            return response($file, 200)->header('Content-Type', $type);
        } else {
            abort(404);
        }
    }
}
