<?php

namespace App\Http\Controllers;

use App\Models\StudyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class StudyLogController extends Controller
{
    // 一覧ページ
    public function index(Request $request)
{
    $query = StudyLog::where('user_id', Auth::id())
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc');

    // ▼ フィルタ：開始日
    if ($request->filled('from')) {
        $query->where('date', '>=', $request->from);
    }

    // ▼ フィルタ：終了日
    if ($request->filled('to')) {
        $query->where('date', '<=', $request->to);
    }

    // ▼ フィルタ：カテゴリ
    if ($request->filled('category')) {
        $query->where('category', 'LIKE', '%' . $request->category . '%');
    }

    $logs = $query->paginate(20)->appends($request->all());

    return Inertia::render('Study/Index', [
        'logs' => $logs,
        'filters' => [
            'from' => $request->from,
            'to' => $request->to,
            'category' => $request->category,
        ],
    ]);
}


    // 登録画面
    public function create()
    {
        return Inertia::render('Study/Create');
    }

    // 登録処理
    public function store(Request $request)
    {
        $data = $request->validate([
            'date'     => ['required', 'date'],
            'category' => ['required', 'string', 'max:100'],
            'minutes'  => ['required', 'integer', 'min:1'],
            'memo'     => ['nullable', 'string'],
        ]);

        $data['user_id'] = Auth::id();

        StudyLog::create($data);

        return redirect()->route('study.index')
            ->with('success', '学習ログを登録しました。');
    }
}
