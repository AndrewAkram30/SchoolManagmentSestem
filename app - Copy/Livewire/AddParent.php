<?php

namespace App\Livewire;
use Illuminate\Mail\Attachment;
use Livewire\WithFileUploads;
use App\Models\my_parent;
use App\Models\nationalites;
use App\Models\ParentAttachment;
use App\Models\reliagion;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddParent extends Component
{

    use WithFileUploads;
    public $updateMode = 0;
    public $currentStep = 1;
    public $photos;
    public $message;
    public $successMessage,


        $Email,
        $Password,

     // Father_INPUTS
        $Name_Father,
        $National_ID_Father,
        $Passport_ID_Father,
        $Phone_Father,
        $Job_Father,
        $Nationality_Father_id,
        $Blood_Type_Father_id,
        $Address_Father,
        $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother,
        $National_ID_Mother,
        $Passport_ID_Mother,
        $Phone_Mother,
        $Job_Mother,
        $Nationality_Mother_id,
        $Blood_Type_Mother_id,
        $Address_Mother,
        $Religion_Mother_id;


        public function update(){
        $this->validateOnly([
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:12|max:12|regex:/[0-11]{11}/',
            'Passport_ID_Father' => 'min:14|max:14',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'National_ID_Mother' => 'required|string|min:12|max:12|regex:/[0-11]{11}/',
            'Passport_ID_Mother' => 'min:14|max:14',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:12'

        ]);
        }

    public function render()
    {
        return view('livewire.add-parent',[

'Nationalites'=>nationalites::all(),
'Reliagions'=>reliagion::all(),
'Type_Blood'=>Type_Blood::all(),

        ]);
    }

  //firstStepSubmit
    public function firstStepSubmit()
    {

          $this->validate([
            'Email' => 'required|unique:my_parents,Email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Job_Father' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my_parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {

          $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm(){
// insert in data base
        $MyParent = new my_parent();
        //  father_inputs
            $MyParent->Email = $this->Email;
            $MyParent->Password = Hash::make($this->Password);
            $MyParent->Name_Father =  $this->Name_Father;
            $MyParent->National_ID_Father = $this->National_ID_Father;
            $MyParent->Passport_ID_Father = $this->Passport_ID_Father;
            $MyParent->Phone_Father = $this->Phone_Father;
            $MyParent->Job_Father = $this->Job_Father;
            $MyParent->Passport_ID_Father = $this->Passport_ID_Father;
            $MyParent->Nationality_Father_id = $this->Nationality_Father_id;
            $MyParent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
            $MyParent->Religion_Father_id = $this->Religion_Father_id;
            $MyParent->Address_Father = $this->Address_Father;

      // mother_inputs
            $MyParent->Name_Mother =  $this->Name_Mother;
            $MyParent->National_ID_Mother = $this->National_ID_Mother;
            $MyParent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $MyParent->Phone_Mother = $this->Phone_Mother;
            $MyParent->Job_Mother =  $this->Job_Mother;
            $MyParent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $MyParent->Nationality_Mother_id = $this->Nationality_Mother_id;
            $MyParent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
            $MyParent->Religion_Mother_id = $this->Religion_Mother_id;
            $MyParent->Address_Mother = $this->Address_Mother;

              $MyParent->save();

if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => my_parent::latest()->first()->id,
                    ]);
                }
            }
        $this->successMessage = 'تمه الاضافه بنجاح';
            $this->clearForm();
            $this->currentStep = 1;

    }

  //clearForm
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';

        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }



       public function back($step)
    {
        $this->currentStep = $step;
    }
}



