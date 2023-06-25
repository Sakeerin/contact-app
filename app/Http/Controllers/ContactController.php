<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    protected function userCompanies(){
        return Company::forUser(auth()->user())->orderBy('name')->pluck('name', 'id');
    }

    public function index()
    {
        // dd($request->sort_by);
        // $companies = [
        //     1 => ['name' => 'Company One', 'contacts' => 3],
        //     2 => ['name' => 'Company Two', 'contacts' => 5],
        // ];
        // $companies = $this->company->pluck();
        // $query = Contact::query();
        // dd($request->user());
        // if(Auth::check()){
        //     dd('Sign in');
        // }else{
        //     dd('Guest');
        // }
        $companies = $this->userCompanies();
        // DB::enableQueryLog();

        $contacts = Contact::allowedTrash()
            ->allowedSorts(['first_name', 'last_name', 'email'], "-id")
            ->allowedFilters('company_id')
            ->allowedSearch('first_name', 'last_name', 'email')
            // ->forUser(auth()->user())
            ->forUser(auth()->user())
            ->with("company")
            ->paginate(10);
        // dump(DB::getQueryLog());
        // $contactsCollection = Contact::latest()->get();
        // $perPage = 10;
        // $currectPage = request()->query('page', 1);
        // $items = $contactsCollection->slice(($currectPage * $perPage) - $perPage, $perPage);
        // $total = $contactsCollection->count();
        // $contacts = new LengthAwarePaginator($items, $total, $perPage, $currectPage,[
        //     'path' => request()->url(),
        //     'query' => request()->query()
        // ]);
        // return view('contacts.index',['contacts' => $contacts]);
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create(Request $request)
    {
        // dd(request()->routeIs("contacts.*"));
        $companies = $this->userCompanies();
        $contact = new Contact();
        return view('contacts.create', compact('companies', 'contact'));
    }

    public function store(ContactRequest $request)
    {
        // if($request->filled('first_name')){}
        // $request->validate($this->rules());
        // dd($request->first_name);
        // $contact = Contact::create($request->all());
        $request->user()->contacts()->create($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact has been adden successfully');
        // return response()->json([
        //     'success' => true,
        //     'data' => $contact
        // ]);
        // Contact::create($request->only('first_name','last_name', 'email', 'phone', 'address', 'company_id'));
    }


    public function show(Contact $contact)
    {
        // $contacts = $this->getContacts();

        // $contact = $this->findContact($id);
        // abort_if(!isset($contacts[$id]), 404);
        // abort_unless(!empty($contact), 404);
        // abort_if(empty($contact), 404);

        // return view('contacts.show')->with('contact', $contact);
        $companies = $this->userCompanies();
        return view('contacts.edit', compact('companies', 'contact'));
    }



    public function edit(Contact $contact)
    {
        $companies = $this->userCompanies();

        // $contact = Contact::findOrFail($id);

        // return view('contacts.edit')->with('contact', $contact)->with('companies',$companies);
        return view('contacts.edit', compact('companies', 'contact'));
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        // $contact = Contact::findOrFail($id);

        // $request->validate($this->rules());

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact has been updated successfully');

    }

    public function destroy(Contact $contact)
    {

        // $contact = Contact::findOrFail($id);

        $contact->delete();

        $redirect = request()->query('redirect');

        return ($redirect ? redirect()->route($redirect) : back())
            ->with('message', 'Contact has been moved to trash.')
            ->with('undoRoute', getUndoRoute('contacts.restore', $contact));
    }


    public function restore(Contact $contact)
    {

        // $contact = Contact::onlyTrashed()->findOrFail($id);

        $contact->restore();

        return back()
            ->with('message', 'Contact has been restored from trash.')
            ->with('undoRoute', getUndoRoute('contacts.destroy', $contact));
    }

   

    public function forceDelete(Contact $contact)
    {

        // $contact = Contact::onlyTrashed()->findOrFail($id);

        $contact->forceDelete();

        return back()
            ->with('message', 'Contact has been removed permanently.');
    }


}