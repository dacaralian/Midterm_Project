<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Schedule;
use Carbon\Carbon;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $rawMessage = $request->input('message', '');
        $userMessage = trim(strtolower($rawMessage));

        // Subject name abbreviations
        $subjectAliases = [
            'adet' => 'Application Development and Emerging Technologies',
            'sia' => 'Systems Integration and Architecture',
            'ias' => 'Information Assurance and Security',
            'aa' => 'Art Appreciation',
            'epp' => 'English Proficiency Program',
            'elect1' => 'Elective 1',
            'mrc' => 'Methods of Research in Computing',
            'elect2' => 'Elective 2',
            'qm' => 'Quantitative Methods',
        ];

        foreach ($subjectAliases as $abbr => $fullName) {
            if (preg_match('/\b' . preg_quote($abbr, '/') . '\b/i', $userMessage)) {
                $userMessage = preg_replace('/\b' . preg_quote($abbr, '/') . '\b/i', $fullName, $userMessage);
            } else {
                $shortCode = explode(' ', $abbr)[0];
                if (preg_match('/\b' . preg_quote($shortCode, '/') . '\b/i', $userMessage)) {
                    $userMessage = preg_replace('/\b' . preg_quote($shortCode, '/') . '\b/i', $fullName, $userMessage);
                }
            }
        }

        // Timezone handling
        $clientTz = $request->input('tz') ?: config('app.timezone', 'Asia/Manila');
        date_default_timezone_set($clientTz);

        $now = Carbon::now($clientTz);
        $currentDay = $now->format('l');
        $currentDate = $now->format('F j, Y');

        $daysOfWeek = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

        $dayQueryPatterns = [
            '/\bwhat\s+day\s+is\s+today\??\b/i',
            '/\bwhat(\'s| is)\s+the\s+date\s+today\??\b/i',
            '/\bwhat(\'s| is)\s+the\s+day\s+today\??\b/i',
            '/\bwhat\s+date\s+is\s+today\??\b/i'
        ];

        foreach ($dayQueryPatterns as $pattern) {
            if (preg_match($pattern, $rawMessage)) {
                return response()->json([
                    'reply' => "Today is {$currentDay}, {$currentDate}."
                ]);
            }
        }

        // Classes order
        if (
            preg_match('/\b(first|1st|second|2nd|third|3rd|fourth|4th|fifth|5th|last)\b/i', $userMessage, $match)
            && (str_contains($userMessage, 'class') || str_contains($userMessage, 'subject'))
        ) {
            $orderWord = strtolower($match[1]);
            $targetDay = $currentDay;

            foreach ($daysOfWeek as $day) {
                if (preg_match('/\b' . $day . '\b/i', $userMessage)) {
                    $targetDay = ucfirst($day);
                    break;
                }
            }

            $schedule = Schedule::where('day', $targetDay)->get();

            if ($schedule->isEmpty()) {
                return response()->json([
                    'reply' => "You don't have any classes on {$targetDay}."
                ]);
            }

            $sorted = $schedule->sortBy(function ($class) {
                if (preg_match('/(\d{1,2}:\d{2}\s?[APMapm]{2})/', $class->time, $match)) {
                    return Carbon::parse($match[1])->timestamp;
                }
                return INF;
            })->values();

            $index = null;
            switch ($orderWord) {
                case 'first':
                case '1st': $index = 0; break;
                case 'second':
                case '2nd': $index = 1; break;
                case 'third':
                case '3rd': $index = 2; break;
                case 'fourth':
                case '4th': $index = 3; break;
                case 'fifth':
                case '5th': $index = 4; break;
                case 'last': $index = $sorted->count() - 1; break;
            }

            if ($index === null || $index >= $sorted->count() || $index < 0) {
                return response()->json([
                    'reply' => "I couldn't find that class order for {$targetDay}."
                ]);
            }

            $class = $sorted[$index];
            return response()->json([
                'reply' => "Your {$orderWord} class on {$targetDay} is **{$class->course_code} ({$class->course_name})** with **{$class->instructor}** at **{$class->time}**, located in {$class->building} - Room {$class->room}."
            ]);
        }

        // Next class
        if (
            str_contains($userMessage, 'next class') ||
            str_contains($userMessage, 'next subject') ||
            str_contains($userMessage, 'class later') ||
            str_contains($userMessage, 'another class')
        ) {
            $schedule = Schedule::where('day', $currentDay)->get();

            if ($schedule->isEmpty()) {
                return response()->json([
                    'reply' => "You don't have any classes today."
                ]);
            }

            $nextClass = null;
            foreach ($schedule as $class) {
                if (preg_match('/(\d{1,2}:\d{2}\s?[APMapm]{2})\s*-\s*(\d{1,2}:\d{2}\s?[APMapm]{2})/', $class->time, $match)) {
                    $start = Carbon::parse($match[1], $clientTz);
                    if ($start->greaterThan($now)) {
                        $nextClass = $class;
                        break;
                    }
                }
            }

            if ($nextClass) {
                return response()->json([
                    'reply' => "Your next class today is **{$nextClass->course_code} ({$nextClass->course_name})** with **{$nextClass->instructor}** at **{$nextClass->time}**, located in {$nextClass->building} - Room {$nextClass->room}."
                ]);
            } else {
                return response()->json([
                    'reply' => "You don't have any more classes today."
                ]);
            }
        }

        // Specific day schedule
        $matchedDay = null;
        if (preg_match('/\btoday\b/i', $rawMessage)) {
            $matchedDay = $currentDay;
        } elseif (preg_match('/\btomorrow\b/i', $rawMessage)) {
            $matchedDay = $now->copy()->addDay()->format('l');
        } elseif (preg_match('/next\s+(monday|tuesday|wednesday|thursday|friday|saturday|sunday)/i', $rawMessage, $match)) {
            $matchedDay = ucfirst(strtolower($match[1]));
        } else {
            foreach ($daysOfWeek as $day) {
                if (preg_match('/\b' . $day . '\b/i', $rawMessage)) {
                    $matchedDay = ucfirst($day);
                    break;
                }
            }
        }

        if ($matchedDay) {
            $schedule = Schedule::where('day', $matchedDay)->get();

            if ($schedule->isEmpty()) {
                return response()->json([
                    'reply' => "You don't have any classes on {$matchedDay}."
                ]);
            }

            $response = "Here’s your schedule for {$matchedDay}:\n";
            foreach ($schedule as $class) {
                $response .= "- {$class->course_code} ({$class->course_name}) with {$class->instructor} at {$class->time}, {$class->building} - Room {$class->room}\n";
            }

            return response()->json(['reply' => $response]);
        }

        // General chat to Gemini
        $apiKey = env('GEMINI_API_KEY');
        $model = 'gemini-2.5-flash';

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent?key={$apiKey}", [
                'contents' => [[
                    'parts' => [[
                        'text' => "You are Buzzee, the friendly campus AI assistant. 
                        If the user asks about their class schedule, use the context provided. 
                        Otherwise, answer conversationally and helpfully.
                        User: {$userMessage}"
                    ]]
                ]]
            ]);

            $data = $response->json();

            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                return response()->json([
                    'reply' => $data['candidates'][0]['content']['parts'][0]['text']
                ]);
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
