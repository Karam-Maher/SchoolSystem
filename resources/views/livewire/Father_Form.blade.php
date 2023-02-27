@if ($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
@endif
<div class="col-xs-12">
    <div class="col-md-12">
        <br>
        <div class="form-row">
            <div class="col">
                <label for="title">{{ trans('parent.Email') }}</label>
                <input type="email" wire:model="email" class="form-control">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{ trans('parent.Password') }}</label>
                <input type="password" wire:model="password" class="form-control">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="title">{{ trans('parent.Name_Father') }}</label>
                <input type="text" wire:model="name_father" class="form-control">
                @error('name_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{ trans('parent.Name_Father_en') }}</label>
                <input type="text" wire:model="name_father_en" class="form-control">
                @error('name_father_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-3">
                <label for="title">{{ trans('parent.Job_Father') }}</label>
                <input type="text" wire:model="job_father" class="form-control">
                @error('job_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="title">{{ trans('parent.Job_Father_en') }}</label>
                <input type="text" wire:model="job_father_en" class="form-control">
                @error('job_father_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="title">{{ trans('parent.National_ID_Father') }}</label>
                <input type="text" wire:model="national_id_father" class="form-control">
                @error('national_id_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{ trans('parent.Passport_ID_Father') }}</label>
                <input type="text" wire:model="passport_id_father" class="form-control">
                @error('passport_id_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="title">{{ trans('parent.Phone_Father') }}</label>
                <input type="text" wire:model="phone_father" class="form-control">
                @error('phone_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">{{ trans('parent.Nationality_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="nationality_father_id">
                    <option selected>{{ trans('parent.Choose') }}...</option>
                    @foreach ($nationalities as $national)
                        <option value="{{ $national->id }}">{{ $national->name }}</option>
                    @endforeach
                </select>
                @error('nationality_father_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col">
                <label for="inputState">{{ trans('parent.Blood_Type_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="blood_type_father_id">
                    <option selected>{{ trans('parent.Choose') }}...</option>
                    @foreach ($type_bloods as $type_blood)
                        <option value="{{ $type_blood->id }}">{{ $type_blood->name }}</option>
                    @endforeach
                </select>
                @error('blood_type_father_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col">
                <label for="inputZip">{{ trans('parent.Religion_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="religion_father_id">
                    <option selected>{{ trans('parent.Choose') }}...</option>
                    @foreach ($religions as $religion)
                        <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                    @endforeach
                </select>
                @error('religion_father_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-group">
            <label for="exampleFormControlTextarea1">{{ trans('parent.Address_Father') }}</label>
            <textarea class="form-control" wire:model="address_father" id="exampleFormControlTextarea1" rows="4"></textarea>
            @error('address_father')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        @if ($updateMode)
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                wire:click="firstStepSubmit_edit">{{ trans('parent.Next') }}</button>
        @else
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                wire:click="firstStepSubmit">{{ trans('parent.Next') }}</button>
        @endif



    </div>
</div>
</div>
