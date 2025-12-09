<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Course;
use App\Models\Activity;
use App\Models\Schedule;
use Carbon\Carbon;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = trim($request->message);
        $lowerMessage = strtolower($message);
        $now = Carbon::now();

        // --- 1. Dynamic Responses ---

        // Courses
        if (str_contains($lowerMessage, 'list courses') || str_contains($lowerMessage, 'all courses')) {
            $courses = Course::all();
            if ($courses->isEmpty()) return response()->json(['reply' => 'There are no courses added yet.']);

            $reply = "Here are your courses:\n";
            foreach ($courses as $course) {
                $reply .= "- **{$course->code} ({$course->title})** by {$course->instructor}\n";
            }
            return response()->json(['reply' => $reply]);
        }

        // Activities
        if (str_contains($lowerMessage, 'activities') || str_contains($lowerMessage, 'tasks')) {
            $activities = Activity::orderBy('due_date')->get();
            if ($activities->isEmpty()) return response()->json(['reply' => 'No activities found.']);

            $reply = "Here are your activities:\n";
            foreach ($activities as $act) {
                $due = $act->due_date ? Carbon::parse($act->due_date)->format('M j, Y') : 'No due date';
                $reply .= "- **{$act->title} ({$act->category})** - Due: {$due}\n";
            }
            return response()->json(['reply' => $reply]);
        }

        // Schedules
        $day = null;
        if (str_contains($lowerMessage, 'today')) $day = $now->format('l');
        elseif (str_contains($lowerMessage, 'tomorrow')) $day = $now->copy()->addDay()->format('l');
        else {
            $daysOfWeek = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            foreach ($daysOfWeek as $d) {
                if (str_contains($lowerMessage, $d)) { $day = ucfirst($d); break; }
            }
        }

        if ($day) {
            $schedules = Schedule::where('day', $day)->orderBy('time')->get();
            if ($schedules->isEmpty()) return response()->json(['reply' => "You have no classes on {$day}."]);

            $reply = "Here’s your schedule for {$day}:\n";
            foreach ($schedules as $sch) {
                $reply .= "- **{$sch->course_code} ({$sch->course_name})** with {$sch->instructor} at {$sch->time}, {$sch->building} - Room {$sch->room}\n";
            }
            return response()->json(['reply' => $reply]);
        }

        // --- 2. Fallback to General AI ---

        $apiKey = env('GEMINI_API_KEY');
        $model = 'gemini-2.5-flash';

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent?key={$apiKey}", [
                'contents' => [[
                    'parts' => [[
                        'text' => "You are Buzzee, the friendly campus AI assistant. You know about courses, activities, and schedules from the dashboard. 
                        Answer any question conversationally and helpfully. User: {$message}"
                    ]]
                ]]
            ]);

            $data = $response->json();

            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return response()->json(['reply' => $data['candidates'][0]['content']['parts'][0]['text']]);
            } else {
                Log::error('Gemini API Error: ' . json_encode($data));
                return response()->json(['reply' => 'Sorry, I could not get a response from the AI.']);
            }
        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());
            return response()->json(['reply' => 'Failed to connect to AI server.']);
        }
    }
}

