<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Outfit;
use App\Models\OutfitItem;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;
 use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class FindOutfitController extends Controller
{
public function index()
{
    $days = [
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'
    ];

    return view('find-outfit.index', compact('days'));
}



public function daily()
{
    $days = [
        'Senin', 'Selasa', 'Rabu',
        'Kamis', 'Jumat', 'Sabtu', 'Minggu'
    ];

    $roles = Category::where('is_active', true)
        ->pluck('role')
        ->unique();

    $weeklyOutfits = [];

    foreach ($days as $day) {

        $items = [];

        foreach ($roles as $role) {
            $item = Outfit::where('user_id', Auth::id())
                ->whereHas('category', fn ($q) => $q->where('role', $role))
                ->inRandomOrder()
                ->first();

            if ($item) {
                $items[] = $item;
            }
        }

        $weeklyOutfits[] = [
            'day'   => $day,
            'items' => $items
        ];
    }

    return view('find-outfit.daily', compact('weeklyOutfits'));
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


    public function trend()
    {
        $recommendations = Recommendation::with('items')
            ->where('type', 'trend')
            ->get();

        return view('find-outfit.trend', compact('recommendations'));
    }
public function generate(Request $request)
{
    $request->validate([
        'day' => 'required'
    ]);

    $userId = Auth::id();

    // ambil semua kategori aktif
    $categories = Category::where('is_active', true)->get();

    if ($categories->isEmpty()) {
        return back()->with('error', 'Belum ada kategori aktif dari admin');
    }

    $outfits = [];

    foreach ($categories as $category) {

        $item = Outfit::where('user_id', $userId)
            ->where('category_id', $category->id)
            ->inRandomOrder()
            ->first();

        if (!$item) {
            return back()->with(
                'error',
                "Outfit kategori {$category->name} belum lengkap"
            );
        }

        $outfits[] = $item;
    }

    return view('find-outfit.result', [
        'day'     => $request->day,
        'outfits' => $outfits
    ]);
}

public function generateEvent(Request $request)
{
    $request->validate([
        'event' => 'required'
    ]);

    $userId = Auth::id();

    $eventStyles = [
        'hari_raya' => ['Formal', 'Muslim', 'Elegant'],
        'kondangan' => ['Formal', 'Elegant'],
        'date'      => ['Casual', 'Smart Casual'],
        'hangout'   => ['Casual'],
        'formal'    => ['Formal']
    ];

    $styles = $eventStyles[$request->event] ?? [];

    // Ambil category aktif (DINAMIS)
    $categories = Category::where('is_active', true)->get();

    $outfits = [];

    foreach ($categories as $category) {

        $query = Outfit::where('user_id', $userId)
            ->where('category_id', $category->id);

        // OPTIONAL: filter style kalau ada kolom style
        if (!empty($styles) && Schema::hasColumn('outfits', 'style')) {
            $query->whereIn('style', $styles);
        }

        $item = $query->inRandomOrder()->first();

        if ($item) {
            $outfits[] = $item;
        }
    }

    if (count($outfits) === 0) {
        return back()->with('error', 'Outfit belum cukup untuk event ini');
    }

    return view('find-outfit.event-result', [
        'event'   => $request->event,
        'outfits' => $outfits
    ]);
}


}


