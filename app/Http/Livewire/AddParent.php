<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;

use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Religion;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddParent extends Component
{
    use WithFileUploads;
    public $successMessage = '';
    public $photos, $catchError, $updateMode = false, $show_table = true, $parent_id;
    public $currentStep = 1,

        // Father_INPUTS
        $email, $password,
        $name_father, $name_father_en,
        $national_id_father, $passport_id_father,
        $phone_father, $job_father, $job_father_en,
        $nationality_father_id, $blood_type_father_id,
        $address_father, $religion_father_id,

        // Mother_INPUTS
        $name_mother, $name_mother_en,
        $national_id_mother, $passport_id_mother,
        $phone_mother, $job_mother, $job_mother_en,
        $nationality_mother_id, $blood_type_mother_id,
        $address_mother, $religion_mother_id;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'national_id_father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_father' => 'min:10|max:10',
            'phone_father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'national_id_mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_mother' => 'min:10|max:10',
            'phone_mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }
    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities' => Nationality::all(),
            'type_bloods' => TypeBlood::all(),
            'religions' => Religion::all(),
            'my_parents' => My_Parent::all(),
        ]);
    }
    public function showformadd()
    {
        $this->show_table = false;
    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my__parents,Email,' . $this->id,
            'password' => 'required',
            'name_father' => 'required',
            'name_father_en' => 'required',
            'job_father' => 'required',
            'job_father_en' => 'required',
            'national_id_father' => 'required|unique:my__parents,National_id_father,' . $this->id,
            'passport_id_father' => 'required|unique:my__parents,passport_id_father,' . $this->id,
            'phone_father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'nationality_father_id' => 'required',
            'blood_type_father_id' => 'required',
            'religion_father_id' => 'required',
            'address_father' => 'required',
        ]);
        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->currentStep = 3;
    }
    public function submitForm()
    {

        try {
            $my_parent = new My_Parent();
            // Father_INPUTS
            $my_parent->email = $this->email;
            $my_parent->password = Hash::make($this->password);
            $my_parent->name_father = ['en' => $this->name_father_en, 'ar' => $this->name_father];
            $my_parent->national_id_father = $this->national_id_father;
            $my_parent->passport_id_father = $this->passport_id_father;
            $my_parent->phone_father = $this->phone_father;
            $my_parent->job_father = ['en' => $this->job_father_en, 'ar' => $this->job_father];
            $my_parent->passport_id_father = $this->passport_id_father;
            $my_parent->nationality_father_id = $this->nationality_father_id;
            $my_parent->blood_type_father_id = $this->blood_type_father_id;
            $my_parent->religion_father_id = $this->religion_father_id;
            $my_parent->address_father = $this->address_father;

            // Mother_INPUTS
            $my_parent->name_mother = ['en' => $this->name_mother_en, 'ar' => $this->name_mother];
            $my_parent->national_id_mother = $this->national_id_mother;
            $my_parent->passport_id_mother = $this->passport_id_mother;
            $my_parent->phone_mother = $this->phone_mother;
            $my_parent->job_mother = ['en' => $this->job_mother_en, 'ar' => $this->job_mother];
            $my_parent->passport_id_mother = $this->passport_id_mother;
            $my_parent->nationality_mother_id = $this->nationality_mother_id;
            $my_parent->blood_type_mother_id = $this->blood_type_mother_id;
            $my_parent->religion_mother_id = $this->religion_mother_id;
            $my_parent->address_mother = $this->address_mother;
            $my_parent->save();
            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->national_id_father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => My_Parent::latest()->first()->id,
                    ]);
                }
            }

            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }


    //clearForm
    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->name_father = '';
        $this->name_father_en = '';
        $this->national_id_father = '';
        $this->passport_id_father = '';
        $this->phone_father = '';
        $this->job_father = '';
        $this->job_father_en = '';
        $this->nationality_father_id = '';
        $this->blood_type_father_id = '';
        $this->address_father = '';
        $this->religion_father_id = '';

        $this->name_mother = '';
        $this->name_mother_en = '';
        $this->national_id_mother = '';
        $this->passport_id_mother = '';
        $this->phone_mother = '';
        $this->job_mother = '';
        $this->job_mother_en = '';
        $this->nationality_mother_id = '';
        $this->blood_type_mother_id = '';
        $this->address_mother = '';
        $this->religion_mother_id = '';
    }
    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $my_parent = My_Parent::where('id', $id)->first();
        $this->parent_id = $id;
        $this->email = $my_parent->Email;
        $this->password = $my_parent->Password;
        $this->name_father = $my_parent->getTranslation('name_father', 'ar');
        $this->name_father_en = $my_parent->getTranslation('name_father', 'en');
        $this->job_father = $my_parent->getTranslation('job_father', 'ar');;
        $this->job_father_en = $my_parent->getTranslation('job_father', 'en');
        $this->national_id_father = $my_parent->national_id_father;
        $this->passport_id_father = $my_parent->passport_id_father;
        $this->phone_father = $my_parent->phone_father;
        $this->nationality_father_id = $my_parent->nationality_father_id;
        $this->blood_type_father_id = $my_parent->blood_type_father_id;
        $this->address_father = $my_parent->address_father;
        $this->religion_father_id = $my_parent->religion_father_id;

        $this->name_mother = $my_parent->getTranslation('name_mother', 'ar');
        $this->name_mother_en = $my_parent->getTranslation('name_mother', 'en');
        $this->job_mother = $my_parent->getTranslation('job_mother', 'ar');;
        $this->job_mother_en = $my_parent->getTranslation('job_mother', 'en');
        $this->national_id_mother = $my_parent->national_id_mother;
        $this->passport_id_mother = $my_parent->passport_id_mother;
        $this->phone_mother = $my_parent->phone_mother;
        $this->nationality_mother_id = $my_parent->nationality_mother_id;
        $this->blood_type_mother_id = $my_parent->blood_type_mother_id;
        $this->address_mother = $my_parent->address_mother;
        $this->religion_mother_id = $my_parent->religion_mother_id;
    }
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }
    public function submitForm_edit()
    {
        if ($this->parent_id) {
            $parent = My_Parent::findOrFail($this->parent_id);
            $parent->update([
                'passport_id_father' => $this->passport_id_father,
                'national_id_father' => $this->national_id_father
            ]);
        }
        return redirect()->to('add_parent');
    }
    public function delete($id)
    {
        My_Parent::findOrFail($id)->delete();
        return redirect()->to('add_parent');
    }
    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }
}
