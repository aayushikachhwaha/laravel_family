<?php

namespace App\Http\Controllers;

use App\Models\FamilyHead;
use App\Models\FamilyMember;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator facade
use Illuminate\Validation\Rule; // Import Rule class for conditional validation
use DB;

class FamilyController extends Controller
{
    /**
     * Display a listing of the family heads.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all family heads with their associated family members count
        $familyHeads = FamilyHead::withCount('FamilyMember')->get();
        return view('families.index', compact('familyHeads'));
    }

    public function create()
    {
        $states = State::all();
        return view('families.create', compact('states'));
    }

    /**
     * Store a newly created family head with associated family members.
     *
     * Handles the creation of a new FamilyHead record along with its associated
     * family members. Validates input data, including optional photos for both
     * family head and family members. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'head_name' => 'required|max:255',
            'head_surname' => 'required|max:255',
            'head_birthdate' => 'required|date|before_or_equal:today',
            'head_mobile_no' => 'required|max:20',
            'head_address' => 'required|max:255',
            'head_state' => 'required',
            'head_city' => 'required',
            'head_pincode' => 'required|max:10',
            'head_marital_status' => 'required|in:married,unmarried',
            'head_wedding_date' => 'nullable|required_if:head_marital_status,married|date',
            'head_photo' => 'nullable|image|max:2048', // 2MB max
            'head_hobbies.*' => 'nullable|max:255',
            'members.*.name' => 'required|max:255',
            'members.*.birthdate' => 'required|date|before_or_equal:today',
            'members.*.marital_status' => 'required|in:married,unmarried',
            'members.*.wedding_date' => 'nullable|required_if:members.*.marital_status,married|date',
            'members.*.education' => 'nullable|max:255',
            'members.*.photo' => 'nullable|image|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Start database transaction
        DB::beginTransaction();

        try {
            // Save Family Head
            $familyHead = new FamilyHead();
            $familyHead->name = $request->input('head_name');
            $familyHead->surname = $request->input('head_surname');
            $familyHead->birthdate = $request->input('head_birthdate');
            $familyHead->mobile = $request->input('head_mobile_no');
            $familyHead->address = $request->input('head_address');
            $familyHead->state = $request->input('head_state');
            $familyHead->city = $request->input('head_city');
            $familyHead->pincode = $request->input('head_pincode');
            $familyHead->marital_status = $request->input('head_marital_status');
            $familyHead->hobbies = implode(", ",  $request->input('head_hobbies'));
            if ($request->input('head_marital_status') === 'married') {
                $familyHead->wedding_date = $request->input('head_wedding_date');
            }

            // Handle head photo upload
            if ($request->hasFile('head_photo')) {
                $headPhotoPath = $request->file('head_photo')->store('public/head_photos');
                $familyHead->photo = basename($headPhotoPath);
            }

            $familyHead->save();

            // Save Family Members
            if ($request->has('members')) {
                foreach ($request->input('members') as $memberData) {
                    $member = new FamilyMember();
                    $member->family_head_id = $familyHead->id; // Assign the family head ID
                    $member->name = $memberData['name'];
                    $member->birthdate = $memberData['birthdate'];
                    $member->marital_status = $memberData['marital_status'];
                    if ($memberData['marital_status'] === 'married') {
                        $member->wedding_date = $memberData['wedding_date'];
                    }
                    $member->education = $memberData['education'] ?? null;

                    // Handle member photo upload
                    if (isset($memberData['photo'])) {
                        $memberPhotoPath = $memberData['photo']->store('public/head_photos');
                        $member->photo = basename($memberPhotoPath);
                    }

                    $member->save();
                }
            }

            // Commit the transaction if all queries succeed
            DB::commit();

            // Redirect to a success page or any desired route
            return redirect()->route('families.index')->with('success', 'Family created successfully.');

        } catch (\Exception $e) {

            // Rollback transaction if any error occurs
            DB::rollBack();

            // Log the error for debugging purposes
            \Log::error('Error storing family data: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to create families. Please try again.');
        }
    }

     /**
     * Display the specified family head and their details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $family = FamilyHead::findOrFail($id);
        $family->load('FamilyMember'); // Eager load family members
        return view('families.show', compact('family'));
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Find the family by ID
            $family = FamilyHead::findOrFail($id);

            // Delete associated members
            $family->FamilyMember()->delete();

            // Delete the image file if it exists
            if (!empty($family->image)) {
                Storage::delete($family->image);
            }

            // Delete the family record
            $family->delete();

            DB::commit();

            return redirect()->route('families.index')->with('success', 'Family and associated members deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('families.index')->with('error', 'Failed to delete family: ' . $e->getMessage());
        }
    }
}
