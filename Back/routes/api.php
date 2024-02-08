<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Cors;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SemesterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// some additional comments

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Routes that require authentication
 */
Route::middleware('auth:sanctum')->group(function () {
    /**
     * Users related routes
     */
    Route::post("/edit-user/{id}", [UserController::class, 'edit']);
    Route::get('/approve-user/{id}', [UserController::class, 'approveUser']);

    /**
     * course related routes
     */
    Route::post('/create-new-course', [CourseController::class, 'store']);
    Route::post('/edit-course/{id}', [CourseController::class, 'edit']);
    Route::get('/delete-course/{id}', [CourseController::class, 'delete']);
    Route::get('/attatch-courses-to-student/{studentId}/{courseId}/{courseType}', [CourseController::class, 'addStudent']);
    Route::get('/detach-courses-to-student/{studentId}/{courseId}', [CourseController::class, 'detatchStudent']);
    Route::post('/edit-course-student/{studentId}/{courseId}', [CourseController::class, 'editCourseStudent']);

    /**
     * program related routes
     */
    Route::post('/create-new-program', [ProgramController::class, 'store']);
    Route::post('/edit-program/{id}', [ProgramController::class, 'edit']);
    Route::get('/delete-program/{id}', [ProgramController::class, 'delete']);

    /**
     * department related routes
     */
    Route::post('/create-new-department', [DepartmentController::class, 'store']);
    Route::post('/edit-department/{id}', [DepartmentController::class, 'edit']);
    Route::get('/delete-department/{id}', [DepartmentController::class, 'delete']);

    /**
     * semester related routes
     */
    Route::post('/create-new-semester', [SemesterController::class, 'store']);
    Route::post('/edit-semester', [SemesterController::class, 'edit']);
    Route::get('/delete-semester/{id}', [SemesterController::class, 'delete']);

    /**
     * exam related routes
     */
    Route::post('/create-new-exam', [ExamController::class, 'store']);
    Route::post('/edit-exam/{id}', [ExamController::class, 'edit']);
    Route::get('/delete-exam/{id}', [ExamController::class, 'delete']);
});

/**
 * User authentication
 * User search and verification
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post("/register", [AuthController::class, 'signup']);
Route::get('/student/{key}', [UserController::class, 'searchStudent']);
Route::get('/teacher/{key}', [UserController::class, 'searchTeacher']);
Route::get('/verify-user/{id}/{token}', [AuthController::class, 'verifyEmail']);
Route::get('/resend-verify-email/{id}', [AuthController::class, 'resendEmail']);
Route::get('/get-all-users', [UserController::class, 'getAllUser']);

/**
 * course related routes
 */
Route::get('/semester/{semesterId}/courses', [CourseController::class, 'getCourses']);



/**
 * department related routes
 */
Route::get('/get-all-departments', [DepartmentController::class, 'getDepartments']);
Route::get('/get-programs-with-departments', [DepartmentController::class, 'getProgramsWithDepartments']);
Route::get('/get-all-stages', [DepartmentController::class, 'getAllStages']);

/**
 * semester related routes
 */
Route::get('/get-all-semesters/{dept_id}/{program_id}', [SemesterController::class, 'getSemesters']);

/**
 * exam related routes
 */
Route::get('/get-exam/{course_id}/{student_id}', [ExamController::class, 'getExams']);
