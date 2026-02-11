<?php

namespace App\Services;

use App\Models\Trend;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private $apiKey;
    private $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent';

    public function __construct()
    {
        $this->apiKey = config('gemini.api_key');
    }

    /**
     * Generate daily outfit recommendation
     */
    public function generateDailyOutfit(Collection $outfits, string $day): array
    {
        $prompt = $this->buildDailyPrompt($outfits, $day);
        
        try {
            Log::info('Calling Gemini API for daily outfit');
            
            $response = Http::timeout(30)
                ->post($this->apiUrl . '?key=' . $this->apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]);

            if (!$response->successful()) {
                throw new \Exception('Gemini API Error: ' . $response->body());
            }

            $data = $response->json();
            $responseText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
            
            Log::info('Gemini Response: ' . $responseText);
            
            $recommendation = $this->parseResponse($responseText);
            
            return $recommendation;
            
        } catch (\Exception $e) {
            Log::error('=== GEMINI API ERROR ===');
            Log::error('Error Message: ' . $e->getMessage());
            
            return $this->fallbackRandomSelection($outfits);
        }
    }

    /**
     * Generate event-based outfit recommendation
     */
    public function generateEventOutfit(Collection $outfits, string $event): array
    {
        $prompt = $this->buildEventPrompt($outfits, $event);
        
        try {
            Log::info('Calling Gemini API for event outfit');
            
            $response = Http::timeout(30)
                ->post($this->apiUrl . '?key=' . $this->apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]);

            if (!$response->successful()) {
                throw new \Exception('Gemini API Error: ' . $response->body());
            }

            $data = $response->json();
            $responseText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
            
            Log::info('Gemini Response: ' . $responseText);
            
            $recommendation = $this->parseResponse($responseText);
            
            return $recommendation;
            
        } catch (\Exception $e) {
            Log::error('=== GEMINI API ERROR ===');
            Log::error('Error Message: ' . $e->getMessage());
            
            return $this->fallbackRandomSelection($outfits);
        }
    }
    /**
 * Generate smart outfit based on day + activity
 */
public function generateSmartOutfit(Collection $outfits, string $day, string $activity): array
{
    $prompt = $this->buildSmartPrompt($outfits, $day, $activity);
    
    try {
        Log::info('Calling Gemini API for smart outfit');
        
        $response = Http::timeout(30)
            ->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

        if (!$response->successful()) {
            throw new \Exception('Gemini API Error: ' . $response->body());
        }

        $data = $response->json();
        $responseText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
        
        Log::info('Gemini Response: ' . $responseText);
        
        $recommendation = $this->parseResponse($responseText);
        
        return $recommendation;
        
    } catch (\Exception $e) {
        Log::error('=== GEMINI API ERROR ===');
        Log::error('Error Message: ' . $e->getMessage());
        
        return $this->fallbackRandomSelection($outfits);
    }
}

/**
 * Build smart prompt dengan aktivitas
 */
private function buildSmartPrompt(Collection $outfits, string $day, string $activity): string
{
    $wardrobeData = $this->formatWardrobeData($outfits);
    
    // Predefined activity contexts
    $predefinedActivities = [
        'kerja_kuliah' => 'bekerja atau kuliah - butuh tampilan profesional, rapi, dan tidak terlalu kasual',
        'santai' => 'santai di rumah - prioritaskan kenyamanan dan casual style',
        'hangout' => 'hangout dengan teman - stylish tapi tetap comfortable dan fun',
        'formal' => 'menghadiri acara formal - elegant, sophisticated, dan polished',
        'kencan' => 'kencan romantis - attractive, confident, smart casual',
        'kondangan' => 'kondangan/wedding - festive, elegant, tapi jangan sampai lebih mencolok dari pengantin',
        'ibadah' => 'ibadah atau perayaan keagamaan - modest, sopan, dan respectful'
    ];
    
    // Check if it's a predefined activity or custom
    $context = $predefinedActivities[$activity] ?? $activity;
    
    return "Kamu adalah AI fashion stylist profesional. Hari ini adalah {$day}, dan user akan {$context}.

Wardrobe yang tersedia:
{$wardrobeData}

Tugas kamu:
1. Pilih SATU item dari SETIAP kategori (top, bottom, outer, shoes, accessory)
2. Kalau kategori tidak tersedia, set null
3. Pertimbangkan: aktivitas hari ini, kesesuaian warna, style compatibility, cuaca, dan tingkat formalitas
4. Berikan penjelasan singkat (maks 2-3 kalimat) dalam Bahasa Indonesia kenapa kombinasi ini cocok untuk aktivitas hari ini

PENTING: Response HANYA dalam format JSON berikut, tanpa markdown, tanpa teks tambahan:
{
    \"selected_items\": {
        \"top\": <item_id or null>,
        \"bottom\": <item_id or null>,
        \"outer\": <item_id or null>,
        \"shoes\": <item_id or null>,
        \"accessory\": <item_id or null>
    },
    \"reasoning\": \"Penjelasan singkat kenapa outfit ini cocok untuk aktivitas user hari ini\"
}";
}
    /**
     * Build prompt for daily outfit
     */
private function buildDailyPrompt(Collection $outfits, string $day): string
    {
        $wardrobeData = $this->formatWardrobeData($outfits);
        
        return "You are a professional fashion stylist AI. Analyze the user's wardrobe and recommend the BEST outfit combination for {$day}.

User's Wardrobe (grouped by category role):
{$wardrobeData}

Instructions:
1. Choose ONE item from EACH category role (top, bottom, outer, shoes, accessory)
2. If a category role has NO items, set its value to null
3. Consider color harmony, style compatibility, and appropriateness for {$day}
4. Provide a brief, friendly reasoning in Indonesian (max 2 sentences) why this combination works

CRITICAL: Respond ONLY with valid JSON in this EXACT format, no markdown, no extra text:
{
    \"selected_items\": {
        \"top\": <item_id or null>,
        \"bottom\": <item_id or null>,
        \"outer\": <item_id or null>,
        \"shoes\": <item_id or null>,
        \"accessory\": <item_id or null>
    },
    \"reasoning\": \"Penjelasan singkat dalam bahasa Indonesia kenapa kombinasi ini cocok\"
}";
    }

    /**
     * Build prompt for event outfit
     */
    private function buildEventPrompt(Collection $outfits, string $event): string
    {
        $wardrobeData = $this->formatWardrobeData($outfits);
        
        $eventContext = [
            'hari_raya' => 'formal religious celebration requiring elegant, modest, and respectful attire',
            'kondangan' => 'wedding guest attire - formal, elegant, and festive but not overshadowing the bride',
            'date' => 'romantic date - smart casual, attractive, and confident',
            'hangout' => 'casual friends gathering - comfortable, relaxed, and stylish',
            'formal' => 'formal business/office setting - professional and polished'
        ];
        
        $context = $eventContext[$event] ?? 'general event';
        
        return "You are a professional fashion stylist AI. Recommend the PERFECT outfit for: {$context}

User's Available Items:
{$wardrobeData}

Instructions:
1. Choose ONE item from EACH category role that best suits the event
2. If a category is not available, set to null
3. Prioritize formality level and appropriateness for the event
4. Provide styling tips in Indonesian (max 2 sentences)

CRITICAL: Respond ONLY with valid JSON, no markdown:
{
    \"selected_items\": {
        \"top\": <item_id or null>,
        \"bottom\": <item_id or null>,
        \"outer\": <item_id or null>,
        \"shoes\": <item_id or null>,
        \"accessory\": <item_id or null>
    },
    \"reasoning\": \"Tips styling dalam bahasa Indonesia\"
}";
    }

    /**
     * Format wardrobe data for AI
     */
    private function formatWardrobeData(Collection $outfits): string
    {
        $grouped = $outfits->groupBy('category.role');
        
        $formatted = [];
        
        foreach ($grouped as $role => $items) {
            $formatted[$role] = $items->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'category' => $item->category->name ?? 'unknown'
                ];
            })->toArray();
        }
        
        return json_encode($formatted, JSON_PRETTY_PRINT);
    }

    /**
     * Parse AI response
     */
    private function parseResponse(string $response): array
    {
        // Remove markdown code blocks if present
        $cleaned = preg_replace('/```json\s*|\s*```/', '', $response);
        $cleaned = trim($cleaned);
        
        $decoded = json_decode($cleaned, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('JSON Parse Error: ' . json_last_error_msg());
            Log::error('Raw Response: ' . $response);
            
            throw new \Exception('Invalid JSON response from AI');
        }
        
        return $decoded;
    }

    /**
     * Fallback random selection if AI fails
     */
    private function fallbackRandomSelection(Collection $outfits): array
    {
        $grouped = $outfits->groupBy('category.role');
        
        $selected = [];
        
        foreach (['top', 'bottom', 'outer', 'shoes', 'accessory'] as $role) {
            if ($grouped->has($role) && $grouped[$role]->isNotEmpty()) {
                $selected[$role] = $grouped[$role]->random()->id;
            } else {
                $selected[$role] = null;
            }
        }
        
        return [
            'selected_items' => $selected,
            'reasoning' => 'Outfit dipilih secara random karena sistem AI sedang sibuk.'
        ];
    }

    /**
 * Analyze fashion trend dengan AI
 */
public function analyzeTrend(Trend $trend, Collection $userOutfits): array
{
    $prompt = $this->buildTrendAnalysisPrompt($trend, $userOutfits);
    
    try {
        Log::info('Calling Gemini API for trend analysis');
        
        $response = Http::timeout(30)
            ->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

        if (!$response->successful()) {
            throw new \Exception('Gemini API Error: ' . $response->body());
        }

        $data = $response->json();
        $responseText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
        
        Log::info('Gemini Trend Analysis: ' . $responseText);
        
        $analysis = $this->parseResponse($responseText);
        
        return $analysis;
        
    } catch (\Exception $e) {
        Log::error('=== GEMINI TREND ANALYSIS ERROR ===');
        Log::error('Error Message: ' . $e->getMessage());
        
        return [
            'insights' => 'Trend ini sedang viral di TikTok!',
            'styling_tips' => 'Lihat video untuk inspirasi lebih lanjut.',
            'matched_outfits' => []
        ];
    }
}

/**
 * Match user wardrobe to trend
 */
public function matchTrendToWardrobe(Trend $trend, Collection $userOutfits): array
{
    $prompt = $this->buildTrendMatchPrompt($trend, $userOutfits);
    
    try {
        Log::info('Calling Gemini API for trend matching');
        
        $response = Http::timeout(30)
            ->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

        if (!$response->successful()) {
            throw new \Exception('Gemini API Error: ' . $response->body());
        }

        $data = $response->json();
        $responseText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
        
        Log::info('Gemini Trend Match: ' . $responseText);
        
        $recommendation = $this->parseResponse($responseText);
        
        return $recommendation;
        
    } catch (\Exception $e) {
        Log::error('=== GEMINI TREND MATCH ERROR ===');
        Log::error('Error Message: ' . $e->getMessage());
        
        return $this->fallbackRandomSelection($userOutfits);
    }
}

/**
 * Build prompt for trend analysis
 */
private function buildTrendAnalysisPrompt(Trend $trend, Collection $userOutfits): string
{
    $wardrobeData = $this->formatWardrobeData($userOutfits);
    
    $trendInfo = "Title: {$trend->title}\nDescription: {$trend->description}";
    
    return "Kamu adalah fashion trend analyst AI. Analyze trend fashion berikut dan berikan insights untuk user.

Trend Information:
{$trendInfo}

User's Current Wardrobe:
{$wardrobeData}

Tugas kamu:
1. Analisis apa yang membuat trend ini menarik (warna, style, vibe, dll)
2. Berikan 3-4 styling tips konkret dalam Bahasa Indonesia
3. Cek apakah user punya item yang bisa recreate trend ini (cukup match 60-70%, ga harus 100% sama)
4. Return matched outfit IDs (atau empty array jika tidak ada yang cocok)

PENTING: Response HANYA dalam format JSON berikut:
{
    \"insights\": \"Penjelasan singkat kenapa trend ini menarik (2-3 kalimat)\",
    \"styling_tips\": \"3-4 tips konkret cara styling trend ini\",
    \"matched_outfits\": [<array of outfit IDs yang bisa recreate trend, atau [] kalau ga ada>]
}";
}

/**
 * Build prompt for matching trend to wardrobe
 */
private function buildTrendMatchPrompt(Trend $trend, Collection $userOutfits): string
{
    $wardrobeData = $this->formatWardrobeData($userOutfits);
    
    $trendInfo = "Title: {$trend->title}\nDescription: {$trend->description}";
    
    return "Kamu adalah AI fashion stylist. User ingin recreate trend berikut dengan outfit yang mereka punya.

Trend Information:
{$trendInfo}

User's Wardrobe:
{$wardrobeData}

Tugas kamu:
1. Pilih outfit dari wardrobe user yang PALING COCOK untuk recreate trend ini
2. Fokus pada vibe dan style similarity (tidak harus exact match)
3. Pilih SATU item dari setiap kategori yang available
4. Berikan tips cara styling agar lebih mirip trend

PENTING: Response HANYA dalam format JSON:
{
    \"selected_items\": {
        \"top\": <item_id or null>,
        \"bottom\": <item_id or null>,
        \"outer\": <item_id or null>,
        \"shoes\": <item_id or null>,
        \"accessory\": <item_id or null>
    },
    \"reasoning\": \"Penjelasan kenapa kombinasi ini cocok untuk recreate trend\",
    \"tips\": \"Tips tambahan cara styling (misal: roll up sleeves, tuck in shirt, dll)\"
}";
}
}