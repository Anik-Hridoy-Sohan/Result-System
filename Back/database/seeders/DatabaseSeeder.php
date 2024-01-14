<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * For testing purposes
     */
    public function run(): void
    {
        // works only
        // $this->createRoles();
        $this->createStages();
        // $this->createPrograms();
        // $this->createDepartments();
        // $this->createSemesters();

        // does not work
        // $this->createCourses(); // does not work

        // \App\Models\User::create();

        // \App\Models\User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Anik Saha',
        //     'email' => 'anik@anik.com',
        //     'password' => "1234567890"
        // ]);
    }

    /**
     * createRoles function
     * creates three roles with their respective slugs
     * @return void
     */
    private function createRoles()
    {
        \App\Models\Role::create([
            'slug' => 'master',
        ]);

        \App\Models\Role::create([
            'slug' => 'teacher',
        ]);

        \App\Models\Role::create([
            'slug' => 'staff',
        ]);

        \App\Models\Role::create([
            'slug' => 'student',
        ]);
    }

    /**
     * create stages
     * @return void
     */
    private function createStages(): void
    {
        \App\Models\Stage::create(
            [
                'name' => '1st Term 1st Year',
                'slug' => '1.1',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '2nd Term 1st Year',
                'slug' => '1.2',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '1st Term 2nd Year',
                'slug' => '2.1',
            ]
        );

        \App\Models\Stage::create(
            [
                'name' => '2nd Term 2nd Year',
                'slug' => '2.2',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '1st Term 3nd Year',
                'slug' => '3.1',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '2nd Term 3rd Year',
                'slug' => '3.2',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '1st Term 4th Year',
                'slug' => '4.1',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '2nd Term 4th Year',
                'slug' => '4.2',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '1st Term 5th Year',
                'slug' => '5.1',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '2nd Term 5th Year',
                'slug' => '5.2',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '1st Term 6th Year',
                'slug' => '6.1',
            ]
        );
        \App\Models\Stage::create(
            [
                'name' => '2nd Term 6th Year',
                'slug' => '6.2',
            ]
        );
    }

    /**
     * create programs
     * @return void
     */
    private function createPrograms(): void
    {
        \App\Models\Program::create(
            [
                'name' => 'Bachelor of Science',
                'slug' => 'B.Sc',
                'max_semester' => 8,
            ]
        );
        \App\Models\Program::create(
            [
                'name' => 'Master of Science',
                'slug' => 'M.Sc',
                'max_semester' => 2,
            ]
        );
    }

    /**
     * create departments
     * @return void
     */
    private function createDepartments(): void
    {
        \App\Models\Department::create(
            [
                'name' => 'Computer Science and Engineering',
                'slug' => 'CSE',
                'department_code' => '01',
                'status' => '1',
                'chairman_id' => 1,
            ]
        );
        \App\Models\Department::create(
            [
                'name' => 'Electric and Electronics Engineering',
                'slug' => 'EEE',
                'department_code' => '02',
                'status' => '1',
                'chairman_id' => 1,
            ]
        );
    }

    /**
     * @param none
     * @return void
     * creates semesters for both B.Sc and M.Sc
     */
    private function createSemesters(): void
    {
        \App\Models\Semester::create(
            [
                'dept_id' => 1,
                'stage_id' => 1,
                'year' => '2021',
                'program_id' => 1,
            ]
        );
        \App\Models\Semester::create(
            [
                'dept_id' => 1,
                'stage_id' => 3,
                'year' => '2021',
                'program_id' => 1,
            ]
        );
        \App\Models\Semester::create(
            [
                'dept_id' => 2,
                'stage_id' => 1,
                'year' => '2021',
                'program_id' => 1,
            ]
        );
        \App\Models\Semester::create(
            [
                'dept_id' => 2,
                'stage_id' => 3,
                'year' => '2021',
                'program_id' => 1,
            ]
        );
        \App\Models\Semester::create(
            [
                'dept_id' => 1,
                'stage_id' => 1,
                'year' => '2021',
                'program_id' => 2,
            ]
        );
    }

    /**
     * @param none
     * @return void
     * creates courses for cse,eee B.Sc and M.Sc programs
     */
    private function createCourses(): void
    {
        // 1.1
        \App\Models\Course::create(
            [
                'course_code' => 'CSE-1101',
                'semester_id' => 1,
                'course_teacher_id' => 1,
                'name' => 'Computer Fundamental',
                'credit' => 3.00,
            ]
        );
        \App\Models\Course::create(
            [
                'course_code' => 'CSE-1102',
                'semester_id' => 1,
                'course_teacher_id' => 1,
                'name' => 'Computer Fundamental Sessional',
                'credit' => 1.50,
            ]
        );
        \App\Models\Course::create(
            [
                'course_code' => 'EEE-1101',
                'semester_id' => 3,
                'course_teacher_id' => 1,
                'name' => 'Basic Electical Engineering',
                'credit' => 3.00,
            ]
        );
        \App\Models\Course::create(
            [
                'course_code' => 'EEE-1102',
                'semester_id' => 3,
                'course_teacher_id' => 1,
                'name' => 'Basic Electical Engineering Sessional',
                'credit' => 1.50,
            ]
        );

        // 2.1
        \App\Models\Course::create(
            [
                'course_code' => 'CSE-2101',
                'semester_id' => 2,
                'course_teacher_id' => 1,
                'name' => 'Structured Programming Language',
                'credit' => 3.00,
            ]
        );
        \App\Models\Course::create(
            [
                'course_code' => 'CSE-2102',
                'semester_id' => 2,
                'course_teacher_id' => 1,
                'name' => 'Structured Programming Language Sessional',
                'credit' => 1.50,
            ]
        );
        \App\Models\Course::create(
            [
                'course_code' => 'EEE-2101',
                'semester_id' => 4,
                'course_teacher_id' => 1,
                'name' => 'Advance Electical Engineering',
                'credit' => 3.00,
            ]
        );
        \App\Models\Course::create(
            [
                'course_code' => 'EEE-2102',
                'semester_id' => 4,
                'course_teacher_id' => 1,
                'name' => 'Advance Electical Engineering Sessional',
                'credit' => 1.50,
            ]
        );

        // M.Sc. - 1.1
        \App\Models\Course::create(
            [
                'course_code' => 'CSE-1101',
                'semester_id' => 5,
                'course_teacher_id' => 1,
                'name' => 'Artificial Intelligence',
                'credit' => 4.00,
            ]
        );
    }

    private function createExams(): void
    {
        // cse
        // 1.1
        // student no. 1, id-7
        \App\Models\Exam::create(
            [
                'student_id' => 7,
                'invigilator_id' => 1,
                'course_id' => 1,
                'type' => 'theory',
                'total_mark' => 70,
                'achived_mark' => 40,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 7,
                'invigilator_id' => 1,
                'course_id' => 1,
                'type' => 'class',
                'total_mark' => 30,
                'achived_mark' => 20,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 7,
                'invigilator_id' => 1,
                'course_id' => 2,
                'type' => 'lab exam',
                'total_mark' => 60,
                'achived_mark' => 55,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 7,
                'invigilator_id' => 1,
                'course_id' => 2,
                'type' => 'class',
                'total_mark' => 40,
                'achived_mark' => 30,
            ]
        );
        // student no. 2, id-8
        \App\Models\Exam::create(
            [
                'student_id' => 8,
                'invigilator_id' => 1,
                'course_id' => 1,
                'type' => 'theory',
                'total_mark' => 70,
                'achived_mark' => 40,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 8,
                'invigilator_id' => 1,
                'course_id' => 1,
                'type' => 'class',
                'total_mark' => 30,
                'achived_mark' => 9,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 8,
                'invigilator_id' => 1,
                'course_id' => 2,
                'type' => 'lab exam',
                'total_mark' => 60,
                'achived_mark' => 35,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 8,
                'invigilator_id' => 1,
                'course_id' => 2,
                'type' => 'class',
                'total_mark' => 40,
                'achived_mark' => 30,
            ]
        );

        // 1.2
        // student no. 3, id-9
        \App\Models\Exam::create(
            [
                'student_id' => 9,
                'invigilator_id' => 1,
                'course_id' => 5,
                'type' => 'theory',
                'total_mark' => 70,
                'achived_mark' => 40,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 9,
                'invigilator_id' => 1,
                'course_id' => 5,
                'type' => 'class',
                'total_mark' => 30,
                'achived_mark' => 20,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 9,
                'invigilator_id' => 1,
                'course_id' => 6,
                'type' => 'lab exam',
                'total_mark' => 60,
                'achived_mark' => 55,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 9,
                'invigilator_id' => 1,
                'course_id' => 6,
                'type' => 'class',
                'total_mark' => 40,
                'achived_mark' => 30,
            ]
        );
        // student no. 4, id-10
        \App\Models\Exam::create(
            [
                'student_id' => 10,
                'invigilator_id' => 1,
                'course_id' => 5,
                'type' => 'theory',
                'total_mark' => 70,
                'achived_mark' => 40,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 10,
                'invigilator_id' => 1,
                'course_id' => 5,
                'type' => 'class',
                'total_mark' => 30,
                'achived_mark' => 9,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 10,
                'invigilator_id' => 1,
                'course_id' => 6,
                'type' => 'lab exam',
                'total_mark' => 60,
                'achived_mark' => 35,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 10,
                'invigilator_id' => 1,
                'course_id' => 6,
                'type' => 'class',
                'total_mark' => 40,
                'achived_mark' => 30,
            ]
        );
        // eee
        // 1.1
        // student no. 5, id-11
        \App\Models\Exam::create(
            [
                'student_id' => 11,
                'invigilator_id' => 1,
                'course_id' => 3,
                'type' => 'theory',
                'total_mark' => 70,
                'achived_mark' => 40,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 11,
                'invigilator_id' => 1,
                'course_id' => 3,
                'type' => 'class',
                'total_mark' => 30,
                'achived_mark' => 20,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 11,
                'invigilator_id' => 1,
                'course_id' => 4,
                'type' => 'lab exam',
                'total_mark' => 60,
                'achived_mark' => 55,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 11,
                'invigilator_id' => 1,
                'course_id' => 4,
                'type' => 'class',
                'total_mark' => 40,
                'achived_mark' => 30,
            ]
        );
        // student no. 6, id-12
        \App\Models\Exam::create(
            [
                'student_id' => 12,
                'invigilator_id' => 1,
                'course_id' => 3,
                'type' => 'theory',
                'total_mark' => 70,
                'achived_mark' => 40,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 12,
                'invigilator_id' => 1,
                'course_id' => 3,
                'type' => 'class',
                'total_mark' => 30,
                'achived_mark' => 9,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 12,
                'invigilator_id' => 1,
                'course_id' => 4,
                'type' => 'lab exam',
                'total_mark' => 60,
                'achived_mark' => 35,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 12,
                'invigilator_id' => 1,
                'course_id' => 4,
                'type' => 'class',
                'total_mark' => 40,
                'achived_mark' => 30,
            ]
        );

        // 1.2
        // student no. 7, id-13
        \App\Models\Exam::create(
            [
                'student_id' => 13,
                'invigilator_id' => 1,
                'course_id' => 7,
                'type' => 'theory',
                'total_mark' => 70,
                'achived_mark' => 40,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 13,
                'invigilator_id' => 1,
                'course_id' => 7,
                'type' => 'class',
                'total_mark' => 30,
                'achived_mark' => 20,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 13,
                'invigilator_id' => 1,
                'course_id' => 8,
                'type' => 'lab exam',
                'total_mark' => 60,
                'achived_mark' => 55,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 13,
                'invigilator_id' => 1,
                'course_id' => 8,
                'type' => 'class',
                'total_mark' => 40,
                'achived_mark' => 30,
            ]
        );
        // student no. 8, id-14
        \App\Models\Exam::create(
            [
                'student_id' => 14,
                'invigilator_id' => 1,
                'course_id' => 7,
                'type' => 'theory',
                'total_mark' => 70,
                'achived_mark' => 40,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 14,
                'invigilator_id' => 1,
                'course_id' => 7,
                'type' => 'class',
                'total_mark' => 30,
                'achived_mark' => 9,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 14,
                'invigilator_id' => 1,
                'course_id' => 8,
                'type' => 'lab exam',
                'total_mark' => 60,
                'achived_mark' => 35,
            ]
        );
        \App\Models\Exam::create(
            [
                'student_id' => 14,
                'invigilator_id' => 1,
                'course_id' => 8,
                'type' => 'class',
                'total_mark' => 40,
                'achived_mark' => 30,
            ]
        );
    }
}
