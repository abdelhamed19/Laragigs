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
        $listing=Listing::latest()->filter(request(['tags','search']))->paginate(3);
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
        if ($listing->user_id != auth()->user()->id)
        {
            abort(403,"You are not allowed to edit this listing");
        }
        return view("listings.edit",compact("listing","id"));
    }
    public function update(Request $request,$id,Listing $listing)
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
    public function destroy($id)
    {
        $listing=Listing::findOrFail($id);
        if ($listing->user_id != auth()->user()->id)
        {
            abort(403,"You are not allowed to delete this listing");
        }
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect("/");
    }
    public function manage(Listing $listing)
    {
        $listings=$listing->where('user_id',auth()->user()->id)->get();
        return view("users.manage", ['listings' => $listings]);
    }

}
