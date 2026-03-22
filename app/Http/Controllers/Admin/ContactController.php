<?php
// app/Http/Controllers/Admin/ContactController.php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::latest();
        if ($request->filled('status')) { $query->where('status', $request->status); }
        $contacts = $query->paginate(15);
        return view('pages.admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        if ($contact->status === 'unread') {
            $contact->update(['status' => 'read']);
        }
        return view('pages.admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, Contact $contact)
    {
        $request->validate(['reply_message' => 'required|string']);
        $contact->update([
            'status'        => 'replied',
            'reply_message' => $request->reply_message,
            'replied_at'    => now(),
        ]);
        return back()->with('success', 'Balasan berhasil disimpan!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Pesan berhasil dihapus!');
    }
}
