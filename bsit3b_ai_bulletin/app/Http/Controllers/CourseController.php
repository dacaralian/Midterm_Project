<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
    $courses = [
        [
            'id' => 1,
            'code' => 'ADET',
            'title' => 'Application Development & Emerging Technologies',
            'instructor' => 'Richard Nonato',
            'image' => 'adet.png',
        ],
        [
            'id' => 2,
            'code' => 'AA',
            'title' => 'Art Appreciation',
            'instructor' => 'Marian Beatrize Olaguer',
            'image' => 'aa.png',
        ],
        [
            'id' => 3,
            'code' => 'DF',
            'title' => 'Digital Forensics',
            'instructor' => 'Noel Paguio',
            'image' => 'df.png',
        ],
        [
            'id' => 4,
            'code' => 'EPP',
            'title' => 'English Proficiency Program',
            'instructor' => 'Ma. Allaine Agua',
            'image' => 'epp.png',
        ],
        [
            'id' => 5,
            'code' => 'IAS',
            'title' => 'Information Assurance & Security',
            'instructor' => 'Tikin Hermogeno Llagas',
            'image' => 'ias.png',
        ],
        [
            'id' => 6,
            'code' => 'MRC',
            'title' => 'Methods of Research in Computing',
            'instructor' => 'Ian Benitez',
            'image' => 'mrc.png',
        ],
        [
            'id' => 7,
            'code' => 'QM',
            'title' => 'Quantitative Methods',
            'instructor' => 'Kathleen May Corbito',
            'image' => 'qm.png',
        ],
        [
            'id' => 8,
            'code' => 'SIA',
            'title' => 'Systems Integration and Architecture',
            'instructor' => 'Mark Joseph Narvadez',
            'image' => 'sia.png',
        ],
        [
            'id' => 9,
            'code' => 'WST2',
            'title' => 'Web Systems and Technologies 2',
            'instructor' => 'Aljohn Marilag',
            'image' => 'wst2.png',
        ],
    ];
    return view('courses', compact('courses'));
    }


    
    public function show($id)
    {
        $courseDetails = [
        1 => [
            'id' => 1,
            'code' => 'ADET',
            'title' => 'Application Development & Emerging Technologies',
            'instructor' => 'Richard F. Nonato',
            'schedule' => [
                ['day' => 'Wed', 'time' => '7:00 AM - 10:00 AM', 'room' => 'CS Laboratory'],
                ['day' => 'Fri', 'time' => '8:00 AM - 10:00 AM', 'room' => 'AB4 Room 5'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
                ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'adet.png',
        ],

        2 => [
            'id' => 2,
            'code' => 'AA',
            'title' => 'Art Appreciation',
            'instructor' => 'Marian Beatrize Olaguer',
            'schedule' => [
                ['day' => 'Sat', 'time' => '2:00 PM - 5:00 PM', 'room' => 'Online'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
                ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'aa.png',
        ],

        3 => [
            'id' => 3,
            'code' => 'DF',
            'title' => 'Elective 1 - Digital Forensics',
            'instructor' => 'Noel Paguio',
            'schedule' => [
                ['day' => 'Wed', 'time' => '1:00 PM - 3:00 PM', 'room' => 'AB1 Room 4'],
                ['day' => 'Thu', 'time' => '7:00 AM - 10:00 AM', 'room' => 'IT Lab 1'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
                ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'df.png',
        ],

        4 => [
            'id' => 4,
            'code' => 'EPP',
            'title' => 'English Proficiency Program',
            'instructor' => 'Ma. Allaine Agua',
            'schedule' => [
                ['day' => 'Tue', 'time' => '3:00 PM - 4:00 PM', 'room' => 'Online'],
                ['day' => 'Sat', 'time' => '8:00 AM - 10:00 AM', 'room' => 'AB4 Room 5'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
                ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'epp.png',
        ],

        5 => [
            'id' => 5,
            'code' => 'IAS',
            'title' => 'Information Assurance and Security',
            'instructor' => 'Tikin Hermogeno Llagas',
            'schedule' => [
                ['day' => 'Thu', 'time' => '10:00 AM - 12:00 PM', 'room' => 'AB4 Room 2'],
                ['day' => 'Thu', 'time' => '1:00 PM - 4:00 PM', 'room' => 'IT Lab 2'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
                ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'ias.png',
        ],

        6 => [
            'id' => 6,
            'code' => 'MRC',
            'title' => 'Methods of Research in Computing',
            'instructor' => 'Ian Benitez',
            'schedule' => [
                ['day' => 'Tue', 'time' => '10:00 AM - 11:00 AM', 'room' => 'Online'],
                ['day' => 'Fri', 'time' => '1:00 PM - 3:00 PM', 'room' => 'AB4 Room 1'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
                ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'mrc.png',
        ],

        7 => [
            'id' => 7,
            'code' => 'QM',
            'title' => 'Quantitative Methods',
            'instructor' => 'Kathleen May Corbito',
            'schedule' => [
                ['day' => 'Tue', 'time' => '4:00 PM - 5:00 PM', 'room' => 'Online'],
                ['day' => 'Sat', 'time' => '10:00 AM - 12:00 PM', 'room' => 'AB4 Room 3'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
            ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
            ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'qm.png',
        ],

        8 => [
            'id' => 8,
            'code' => 'SIA',
            'title' => 'Systems Integration and Architecture 1',
            'instructor' => 'Mark Joseph Narvadez',
            'schedule' => [
                ['day' => 'Mon', 'time' => '1:00 PM - 4:00 PM', 'room' => 'IT Lab 2'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
                ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'sia.png',
        ],

        9 => [
            'id' => 9,
            'code' => 'WST2',
            'title' => 'Elective 2 - Web Systems and Technologies 2',
            'instructor' => 'Aljohn Marilag',
            'schedule' => [
                ['day' => 'Mon', 'time' => '7:00 AM - 10:00 AM', 'room' => 'IT Lab 2'],
                ['day' => 'Mon', 'time' => '10:00 AM - 12:00 PM', 'room' => 'AB4 Room 2'],
            ],
            'activities' => [
                ['title' => 'Activity 1', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Activity 2', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'projects' => [
                ['title' => 'Midterm Project', 'due' => 'Jan 1, 11:59 PM'],
                ['title' => 'Final Project', 'due' => 'Jan 15, 11:59 PM'],
            ],
            'image' => 'wst2.png',
        ],
        ];

        if (!isset($courseDetails[$id])) {
            abort(404);
        }
        $course = $courseDetails[$id];
        return view('show', compact('course'));
    }
}

