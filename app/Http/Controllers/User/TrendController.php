<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Trend;
use App\Models\Outfit;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Auth;

class TrendController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function index()
    {
        $trends = Trend::with('tiktoks')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('find-outfit.trend', compact('trends'));
    }

    /**
     * Show trend detail with AI analysis
     */
    public function show(Trend $trend)
    {
        $trend->load('tiktoks');

        // Get user's wardrobe
        $userOutfits = Outfit::with('category')
            ->where('user_id', Auth::id())
            ->get();

        // Call Gemini AI to analyze trend
        $aiAnalysis = $this->geminiService->analyzeTrend($trend, $userOutfits);

        return view('find-outfit.trend-detail', [
            'trend' => $trend,
            'ai_insights' => $aiAnalysis['insights'] ?? null,
            'styling_tips' => $aiAnalysis['styling_tips'] ?? null,
            'matched_outfits' => $aiAnalysis['matched_outfits'] ?? [],
            'all_user_outfits' => $userOutfits
        ]);
    }

    /**
     * Generate outfit based on selected trend
     */
    public function generate(Trend $trend)
    {
        $trend->load('tiktoks');

        // Get user's wardrobe
        $userOutfits = Outfit::with('category')
            ->where('user_id', Auth::id())
            ->get();

        if ($userOutfits->isEmpty()) {
            return back()->with('error', 'Kamu belum punya outfit. Upload dulu ya!');
        }

        // AI match wardrobe to trend
        $aiRecommendation = $this->geminiService->matchTrendToWardrobe($trend, $userOutfits);

        // Get selected outfits
        $selectedOutfits = Outfit::with('category')
            ->whereIn('id', array_filter($aiRecommendation['selected_items']))
            ->get();

        if ($selectedOutfits->isEmpty()) {
            return back()->with('error', 'Outfit kamu belum bisa recreate trend ini. Coba trend lain!');
        }

        return view('find-outfit.trend-result', [
            'trend' => $trend,
            'outfits' => $selectedOutfits,
            'ai_reasoning' => $aiRecommendation['reasoning'] ?? null,
            'tips' => $aiRecommendation['tips'] ?? null
        ]);
    }
}