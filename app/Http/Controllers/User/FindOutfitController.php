<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Outfit;
use App\Services\GeminiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FindOutfitController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function index()
    {
        $days = [
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
        ];

        return view('find-outfit.index', compact('days'));
    }

    public function event()
    {
        $events = [
            'hari_raya' => 'Hari Raya',
            'kondangan' => 'Kondangan',
            'date'      => 'Date',
            'hangout'   => 'Hangout',
            'formal'    => 'Formal'
        ];

        return view('find-outfit.event', compact('events'));
    }

   /**
 * Generate outfit dengan AI berdasarkan aktivitas
 */
/**
 * Generate outfit dengan AI berdasarkan aktivitas
 */
public function generate(Request $request)
{
    $request->validate([
        'activity' => 'required',
        'custom_activity' => 'required_if:activity,custom|nullable|string|max:500'
    ]);

    $userId = Auth::id();

    // Auto-detect hari ini
    $today = Carbon::now();
    $dayName = $today->locale('id')->translatedFormat('l'); // Senin, Selasa, etc
    $fullDate = $today->locale('id')->translatedFormat('l, d F Y'); // Senin, 12 Februari 2025

    // Determine activity (use custom if selected)
    $activity = $request->activity === 'custom' 
        ? $request->custom_activity 
        : $request->activity;

    // Ambil SEMUA outfit user
    $allOutfits = Outfit::with('category')
        ->where('user_id', $userId)
        ->get();

    if ($allOutfits->isEmpty()) {
        return back()->with('error', 'Kamu belum punya outfit. Upload dulu ya!');
    }

    // Call Gemini AI dengan context aktivitas + hari
    $aiRecommendation = $this->geminiService->generateSmartOutfit(
        $allOutfits, 
        $dayName, 
        $activity
    );

    // Get outfit items
    $selectedOutfits = $this->getSelectedOutfits($aiRecommendation['selected_items']);

    if ($selectedOutfits->isEmpty()) {
        return back()->with('error', 'Tidak bisa generate outfit. Coba lagi!');
    }

    // Format activity untuk display
    $activityDisplay = $this->formatActivityDisplay($request->activity, $request->custom_activity);

    return view('find-outfit.result', [
        'day' => $dayName,
        'fullDate' => $fullDate,
        'activity' => $activityDisplay,
        'outfits' => $selectedOutfits,
        'ai_reasoning' => $aiRecommendation['reasoning'] ?? null
    ]);
}

/**
 * Format activity untuk display
 */
private function formatActivityDisplay($activity, $customActivity = null): string
{
    if ($activity === 'custom') {
        return $customActivity;
    }

    $activityLabels = [
        'kerja_kuliah' => 'Kerja / Kuliah',
        'santai' => 'Santai di Rumah',
        'hangout' => 'Hangout Bareng Teman',
        'formal' => 'Acara Formal',
        'kencan' => 'Kencan',
        'kondangan' => 'Kondangan / Wedding',
        'ibadah' => 'Ibadah / Hari Raya'
    ];

    return $activityLabels[$activity] ?? $activity;
}
    /**
     * Generate EVENT outfit dengan AI
     */
    public function generateEvent(Request $request)
    {
        $request->validate([
            'event' => 'required'
        ]);

        $userId = Auth::id();

        // Ambil SEMUA outfit user
        $allOutfits = Outfit::with('category')
            ->where('user_id', $userId)
            ->get();

        if ($allOutfits->isEmpty()) {
            return back()->with('error', 'Kamu belum punya outfit. Upload dulu ya!');
        }

        // Call Gemini AI
        $aiRecommendation = $this->geminiService->generateEventOutfit($allOutfits, $request->event);

        // Get outfit items
        $selectedOutfits = $this->getSelectedOutfits($aiRecommendation['selected_items']);

        if ($selectedOutfits->isEmpty()) {
            return back()->with('error', 'Tidak bisa generate outfit untuk event ini. Coba lagi!');
        }

        return view('find-outfit.event-result', [
            'event' => $request->event,
            'outfits' => $selectedOutfits,
            'ai_tips' => $aiRecommendation['reasoning'] ?? null
        ]);
    }

    /**
     * Helper: Get outfit objects from AI selected IDs
     */
    private function getSelectedOutfits(array $selectedIds): \Illuminate\Support\Collection
    {
        $outfitIds = array_filter($selectedIds, fn($id) => $id !== null);

        return Outfit::with('category')
            ->whereIn('id', $outfitIds)
            ->get();
    }
}