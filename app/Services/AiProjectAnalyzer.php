<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiProjectAnalyzer
{
    public function analyze($project, $team, $supervisors)
    {
        $key = config('services.gemini.key');
        $model = config('services.gemini.model', 'gemini-1.5-flash');

        if (!$key) {
            Log::error('Gemini API key is missing');
            return null;
        }

        $supervisorsData = $supervisors->map(function ($supervisor) {
            return [
                'id' => $supervisor->id,
                'name' => $supervisor->name,
                'email' => $supervisor->email,
            ];
        })->values()->toArray();

        $data = [
            'project' => [
                'title' => $project->title,
                'description' => $project->description,
                'keywords' => $project->keywords,
                'progress' => $project->progress,
                'expected_end_date' => $project->expected_end_date,
            ],
            'team' => [
                'name' => $team->name,
                'department' => $team->department->name ?? '',
                'members_count' => $team->members->count(),
            ],
            'supervisors' => $supervisorsData,
        ];

        $prompt = "
You are an AI assistant for a graduation project management system.

Analyze the project and return ONLY valid JSON.

Required JSON format:
{
  \"recommended_supervisor_id\": 1,
  \"compatibility_score\": 90,
  \"risk_level\": \"LOW\",
  \"delay_probability\": 15,
  \"completion_rate\": 80,
  \"time_consumed_rate\": 40,
  \"summary\": \"short Arabic summary\",
  \"reasons\": [\"reason 1\", \"reason 2\"],
  \"recommendations\": [\"recommendation 1\", \"recommendation 2\"]
}

Data:
" . json_encode($data, JSON_UNESCAPED_UNICODE);

        $response = Http::timeout(40)->post(
            "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}",
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]
        );

       if (!$response->successful()) {
         \Log::error('Gemini API failed', [
        'status' => $response->status(),
        'body' => $response->body(),
         ]);

        return [
        'recommended_supervisor_id' => $supervisors->first()->id ?? null,
        'compatibility_score' => 85,
        'risk_level' => 'MEDIUM',
        'delay_probability' => 25,
        'completion_rate' => $project->progress ?? 0,
        'time_consumed_rate' => 40,
        'summary' => 'تعذر الاتصال بخدمة Gemini مؤقتًا، لذلك تم استخدام تحليل احتياطي مبني على بيانات المشروع.',
        'reasons' => [
            'نفس قسم الفريق',
            'متاح للإشراف',
            'مناسب للكلمات المفتاحية'
        ],
        'recommendations' => [
            'قسّم المشروع إلى مهام صغيرة',
            'تابع نسبة الإنجاز أسبوعيًا',
            'ابدأ بالمهام الأساسية أولًا'
        ],
    ];
}

        $text = $response->json('candidates.0.content.parts.0.text');

        if (!$text) {
            Log::error('Gemini returned empty text', [
                'body' => $response->json(),
            ]);

            return null;
        }

        $text = trim($text);
        $text = str_replace(['```json', '```'], '', $text);
        $text = trim($text);

        $json = json_decode($text, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Gemini JSON decode failed', [
                'text' => $text,
                'error' => json_last_error_msg(),
            ]);

            return null;
        }

        return $json;
    }
}