<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'all');
        $query = Message::query();

        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }

        $messages = $query->latest()->get();
        $unreadCount = Message::where('is_read', false)->count();
        $allCount = Message::count();

        return view('messages.index', compact('messages', 'filter', 'unreadCount', 'allCount'));
    }

    public function markAsRead(Message $message): RedirectResponse
    {
        $message->update(['is_read' => true]);

        return back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function markAsUnread(Message $message): RedirectResponse
    {
        $message->update(['is_read' => false]);

        return back()->with('success', 'Pesan ditandai belum dibaca.');
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
