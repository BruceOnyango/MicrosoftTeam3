<?php

namespace App\Http\Controllers;

use App\Models\EmergencyContact;
use App\Models\MedicalHistory;
use Illuminate\Support\Facades\Auth;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        return view('patient.show',compact('user'));
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user=Auth::user();
        return view('patient.show', compact('user'));
    }

    public function showMedicalHistory(User $user)
    {
        $id=Auth::id();

        $medicalHistory = MedicalHistory::where('patient_id','=',$id)->first();
        $emergencyContact = EmergencyContact::find($medicalHistory->emergency_contact_id);
        return view('patient.show_medical_history',['medicalHistory'=>$medicalHistory, 'emergencyContact'=>$emergencyContact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\User  $user
<<<<<<< HEAD
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user=Auth::user();
        return view('patient.edit', compact('user'));
=======
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $user)
    {
//        $user=Auth::user();
//        return view('patient.edit', compact('user'));

        $id=Auth::id();

        $user = User::where('id','=',$id)->first();
        return view('patient.edit',['user'=>$user]);
>>>>>>> 2ce49e4adfe3a4e90f05cf7547cf80feb034c125
    }

    public function editMedicalHistory(User $user)
    {
        $id=Auth::id();

        $medicalHistory = MedicalHistory::where('patient_id','=',$id)->first();
        $emergencyContact = EmergencyContact::find($medicalHistory->emergency_contact_id);
        return view('patient.edit_medical_history',['medicalHistory'=>$medicalHistory, 'emergencyContact'=>$emergencyContact]);
    }
<<<<<<< HEAD
    
=======

>>>>>>> 2ce49e4adfe3a4e90f05cf7547cf80feb034c125
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\User  $user
<<<<<<< HEAD
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user=  User::find(Auth::id());
        $request->validate([
            'name'=>'required',

            'email'=>'required'
        ]);

=======
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $id=  Auth::id();
        $user = User::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'profile_photo'=>'required',
            'city'=>'required'
        ]);
//        $user = User::where('id',$id)->first();
>>>>>>> 2ce49e4adfe3a4e90f05cf7547cf80feb034c125

        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->phone_number = $request->get('phone_number');
<<<<<<< HEAD
        $user->city = $request->get('city');

        $user->update();

        return redirect('/myprofile')->with('success', 'Contact updated!');
=======
        $user->profile_photo = $request->get('profile_photo');
        $user->city = $request->get('city');
        $user->update();

        return redirect('/myprofile')->with('success', 'Profile has been updated!');
//        return view('patient.edit')->with('success', 'Profile has been updated!');
//        return view('patient.show', ['user'=>$user, 'successMessage'=>"Profile successfully updated"]);
>>>>>>> 2ce49e4adfe3a4e90f05cf7547cf80feb034c125
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function updateMedicalHistory(Request $request){
        $id= Auth::id();
        $request->validate([
            'height' => 'required',
            'weight' => 'required'
        ]);

        $medicalHistory = MedicalHistory::where('patient_id',$id)->first();
        $medicalHistory->weight= $request->weight;
        $medicalHistory->height= $request->height;
        $medicalHistory->medical_problems= $request->medical_problems;
        $medicalHistory->allergies= $request->allergies;
        $medicalHistory->update();

        $emergencyContact = EmergencyContact::find($medicalHistory->emergency_contact_id);
        return view('patient.edit_medical_history', ['medicalHistory'=>$medicalHistory, 'emergencyContact'=>$emergencyContact, 'succesMessage'=>"Medical History successfully updated"]);

    }

    public function updateEmergencyContact(Request $request){
        $id= Auth::id();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'relationship' => 'required',
            'phonenumber' => 'required'
        ]);

        $medicalHistory = MedicalHistory::where('patient_id',$id)->first();
        $emergencyContact = EmergencyContact::find($medicalHistory->emergency_contact_id);
        if($emergencyContact==null){
            $emergencyContact= new EmergencyContact();
            $emergencyContact->first_name =$request->first_name;
            $emergencyContact->last_name =$request->last_name;
            $emergencyContact->relationship =$request->relationship;
            $emergencyContact->phone_number =$request->phonenumber;
            $emergencyContact->save();
            $medicalHistory->emergency_contact_id= $emergencyContact->id;
            $medicalHistory->save();
        }else{
            $emergencyContact->first_name =$request->first_name;
            $emergencyContact->last_name =$request->last_name;
            $emergencyContact->relationship =$request->relationship;
            $emergencyContact->phone_number =$request->phonenumber;
            $emergencyContact->save();
        }

        return redirect('/medicalHistoryEdit')->with(['medicalHistory'=>$medicalHistory, 'emergencyContact'=>$emergencyContact, 'succesMessageTwo'=>"Emergency Contact Updated successfully updated"]);

    }
<<<<<<< HEAD
    
=======

>>>>>>> 2ce49e4adfe3a4e90f05cf7547cf80feb034c125

}
