<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        $contacts = Contact::Paginate(7);

        return view('index', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();

        $contacts = Contact::with('category')
            ->keywordSearch($request->keyword)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->paginate(7);

        return view('index', compact('contacts', 'categories'));
    }

    public function delete($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect('/admin');
    }

    // エクスポート機能
    public function export(Request $request)
    {
        $fileName = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $query = Contact::with('category')
            ->keywordSearch($request->keyword)
            ->genderSearch($request->gender)
            ->categorySearch($request->category_id)
            ->dateSearch($request->date)
            ->orderByDesc('id');

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');

            fwrite($out, "\xEF\xBB\xBF");

            // ヘッダー行
            fputcsv($out, [
                'ID', '姓', '名', '性別', 'メール', '電話', '住所', '建物名', '種類', '内容', '作成日'
            ]);
            $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];

            $query->chunk(500, function ($contacts) use ($out, $genders) {
                foreach ($contacts as $c) {
                    fputcsv($out, [
                        $c->id,
                        $c->last_name,
                        $c->first_name,
                        $genders[$c->gender] ?? '',
                        $c->email,
                        $c->tel,
                        $c->address,
                        $c->building,
                        optional($c->category)->content,
                        $c->detail,
                        optional($c->created_at)->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($out);
        }, $fileName, $headers);
    }

}
