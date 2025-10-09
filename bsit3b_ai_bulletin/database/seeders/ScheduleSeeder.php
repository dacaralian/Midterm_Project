<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        Schedule::insert([
            ['day' => 'Monday', 'time' => '7am - 10am', 'course_code' => 'ELECT 1B Laboratory', 'course_name' => 'Web Systems and Technologies 2', 'instructor' => 'Aljohn Marilag', 'building' => 'Acad. Building 4', 'room' => 'IT Lab 2'],
            ['day' => 'Monday', 'time' => '10am - 12pm', 'course_code' => 'ELECT 1B Lecture', 'course_name' => 'Web Systems and Technologies 2', 'instructor' => 'Aljohn Marilag', 'building' => 'Acad. Building 4', 'room' => 'Room 2'],
            ['day' => 'Monday', 'time' => '1pm - 4pm', 'course_code' => 'IT 317 A Laboratory', 'course_name' => 'Systems Integration and Architecture 1', 'instructor' => 'Mark Joseph Narvadez', 'building' => 'Acad. Building 4', 'room' => 'IT Lab 2'],
            ['day' => 'Tuesday', 'time' => '10am - 11am', 'course_code' => 'ITA 315', 'course_name' => 'Methods of Research in Computing', 'instructor' => 'Ian Benitez', 'building' => 'N/A', 'room' => 'N/A'],
            ['day' => 'Tuesday', 'time' => '3pm - 4pm', 'course_code' => 'ITA 3110', 'course_name' => 'English Proficiency Program', 'instructor' => 'Ma. Allaine Agua', 'building' => 'N/A', 'room' => 'N/A'],
            ['day' => 'Tuesday', 'time' => '4pm - 5pm', 'course_code' => 'IT 3110', 'course_name' => 'Quantitative Methods', 'instructor' => 'Kathleen May Corbito', 'building' => 'N/A', 'room' => 'N/A'],
            ['day' => 'Wednesday', 'time' => '7am - 10am', 'course_code' => 'CCIT 106 Laboratory', 'course_name' => 'Application Development and Emerging Technologies', 'instructor' => 'Richard Nonato', 'building' => 'Acad. Building 4', 'room' => 'IT Lab 1'],
            ['day' => 'Wednesday', 'time' => '10am - 12pm', 'course_code' => 'IT 317 A Lecture', 'course_name' => 'Systems Integration and Architecture 1', 'instructor' => 'Mark Joseph Narvadez', 'building' => 'Acad. Building 4', 'room' => 'Room 5'],
            ['day' => 'Thursday', 'time' => '7am - 10am', 'course_code' => 'ELECT 2B', 'course_name' => 'Digital Forensics', 'instructor' => 'Noel Paguio', 'building' => 'Acad. Building 4', 'room' => 'IT Lab 1'],
            ['day' => 'Thursday', 'time' => '10am - 12pm', 'course_code' => 'IT 3111 Lecture', 'course_name' => 'Information Assurance and Security', 'instructor' => 'Tikin Llagas', 'building' => 'Acad. Building 4', 'room' => 'Room 2'],
            ['day' => 'Thursday', 'time' => '1pm - 4pm', 'course_code' => 'IT 3111 Laboratory', 'course_name' => 'Information Assurance and Security', 'instructor' => 'Tikin Llagas', 'building' => 'Acad. Building 4', 'room' => 'IT Lab 2'],
            ['day' => 'Friday', 'time' => '8am - 10am', 'course_code' => 'CCIT 106 Lecture', 'course_name' => 'Application Development and Emerging Technologies', 'instructor' => 'Richard Nonato', 'building' => 'Acad. Building 4', 'room' => 'Room 5'],
            ['day' => 'Friday', 'time' => '1pm - 3pm', 'course_code' => 'ITA 315', 'course_name' => 'Methods of Research in Computing', 'instructor' => 'Ian Benitez', 'building' => 'Acad. Building 4', 'room' => 'Room 1'],
            ['day' => 'Saturday', 'time' => '8am - 10am', 'course_code' => 'ITA 3110', 'course_name' => 'English Proficiency Program', 'instructor' => 'Ma. Allaine Agua', 'building' => 'Acad. Building 4', 'room' => 'Room 5'],
            ['day' => 'Saturday', 'time' => '10am - 12pm', 'course_code' => 'IT 3110', 'course_name' => 'Quantitative Methods', 'instructor' => 'Kathleen May Corbito', 'building' => 'Acad. Building 4', 'room' => 'Room 3'],
            ['day' => 'Saturday', 'time' => '2pm - 5pm', 'course_code' => 'GE 6', 'course_name' => 'Art Appreciation', 'instructor' => 'Marian Beatrize Olaguer', 'building' => 'N/A', 'room' => 'N/A'],
        ]);
    }
}
