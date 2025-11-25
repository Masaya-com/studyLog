<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudyLog;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // とりあえず「今週」をデフォルト期間に（あとで?from, ?toに対応でもOK）
        $from = now()->startOfWeek();
        $to   = now()->endOfWeek();

        $logs = StudyLog::where('user_id', $user->id)
            ->whereBetween('date', [$from->toDateString(), $to->toDateString()])
            ->orderBy('date')
            ->get();

        $daily = $logs->groupBy('date')->map(function ($items) {
            return [
                'date'    => $items->first()->date->format('Y-m-d'),
                'minutes' => $items->sum('minutes'),
            ];
        })->values();

        $byCategory = $logs->groupBy('category')->map(function ($items, $category) {
            return [
                'category' => $category,
                'minutes'  => $items->sum('minutes'),
            ];
        })->values();

        $totalMinutes = $logs->sum('minutes');

        return Inertia::render('Dashboard', [
            'daily'        => $daily,
            'byCategory'   => $byCategory,
            'totalMinutes' => $totalMinutes,
            'period'       => [
                'from' => $from->toDateString(),
                'to'   => $to->toDateString(),
            ],
        ]);
    }
}

