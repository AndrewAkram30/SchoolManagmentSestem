@if ($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
@endif
<div class="col-xs-12">
    <div class="col-md-12">
        <br>
        <div class="form-row">
            <div class="col">
                <label for="title">Email</label>
                <input type="email" wire:model="Email" class="form-control">
                @error('Email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">Password</label>
                <input type="password" wire:model="Password" class="form-control">
                @error('Password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col">
            <label for="title">Name_Father</label>
            <input type="text" wire:model="Name_Father" class="form-control">
            @error('Name_Father')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <label for="title">Job_Father</label>
        <input type="text" wire:model="Job_Father" class="form-control">
        @error('Job_Father')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col">
        <label for="title">National_ID_Father</label>
        <input type="text" wire:model="National_ID_Father" class="form-control">
        @error('National_ID_Father')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col">
        <label for="title">Passport_ID_Father</label>
        <input type="text" wire:model="Passport_ID_Father" class="form-control">
        @error('Passport_ID_Father')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col">
        <label for="title">Phone_Father</label>
        <input type="text" wire:model="Phone_Father" class="form-control">
        @error('Phone_Father')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputCity">Nationality_Father_id</label>
        <select class="custom-select my-1 mr-sm-2" wire:model="Nationality_Father_id">
            <option selected>Choose...</option>
            @foreach ($Nationalites as $National)
                <option value="{{ $National->id }}">{{ $National->Name }}</option>
            @endforeach
        </select>
        @error('Nationality_Father_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col">
        <label for="inputState">Blood_Type_Father_id</label>
        <select class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Father_id">
            <option selected>Choose...</option>
            @foreach ($Type_Blood as $Type_Blood)
                <option value="{{ $Type_Blood->id }}">{{ $Type_Blood->Name }}</option>
            @endforeach
        </select>
        @error('Blood_Type_Father_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col">
        <label for="inputZip">Religion_Father_id</label>
        <select class="custom-select my-1 mr-sm-2" wire:model="Religion_Father_id">
            <option selected>Choose...</option>
            @foreach ($Reliagions as $Religion)
                <option value="{{ $Religion->id }}">{{ $Religion->Name }}</option>
            @endforeach
        </select>
        @error('Religion_Father_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>


<div class="form-group">
    <label for="exampleFormControlTextarea1">Address_Father</label>
    <textarea class="form-control" wire:model="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
    @error('Address_Father')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">Next
</button>

</div>
</div>
</div>
