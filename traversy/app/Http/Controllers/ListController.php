<?php
namespace App\Http\Controllers;
use App\Models\Listing;
use App\Models\User;
use App\tarits\upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ListController extends Controller
{
    public function index()
    {
        $listing=Listing::latest()->filter(request(['tags','search']))->paginate(4);
        return view("listings.index",compact("listing"));
    }
    public function show(Listing $list)
    {

        return view("listings.show",compact("list"));
    }
    public function showform()
    {
        return view("listings.create");
    }
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo'))
        {
//            $img=$request->file("logo")->getClientOriginalName();
            $formFields['logo'] = $request->file('logo')->store('logos',"public");
        }
        $formFields['user_id']=auth()->id();

        Listing::create($formFields);
        return redirect("/");
    }
    public function edit(Request $request,$id)
    {
        $listing=Listing::findorFail($id);
        return view("listings.edit",compact("listing","id"));
    }
    public function update(Request $request,$id,Listing $listing)
    {
        $uid=Auth::id();
        if ($listing->user_id != $uid)
        {
            abort(403,"forbidden");
        }
        else
        {
            $formFields = $request->validate([
                'title' => 'required',
                'company' => ['required'],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required'
            ]);

            if($request->hasFile('logo')) {
                $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            }

            $listing=Listing::findorFail($id);
            $listing->update($formFields);
            return redirect("/");
        }

    }
    public function destroy(Request $request,$id,Listing $listing)
    {
        if ($listing->user_id != auth()->id())
        {
            abort(403,"forbidden");
        }
        $listing=Listing::findorFail($id);
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect("/");
    }
    public function manage(Listing $listing)
    {

        $listings= auth()->user()->listing()->get();
        return view("users.manage", ['listings' => $listings]);
    }

}
