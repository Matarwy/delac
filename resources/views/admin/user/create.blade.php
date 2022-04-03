<div class="card">
    <div class="card-header">
        <h4>{{__('Add New User')}}</h4>
    </div>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name') }}">
                             @error('name')
                             <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                             @enderror
                    </div>
                   
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            required maxlength="50" value="{{ old('email') }}">
                             @error('email')
                             <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                             @enderror
                    </div>
                   
                </div>
                <div class="col-12 col-md-6 col-lg-6 mt-3">
                    <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required maxlength="50"
                            minlength="6" value="{{ old('password') }}">
                              @error('password')
                              <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                              @enderror
                    </div>
                  
                </div>
                <div class="col-12 col-md-6 col-lg-6 mt-3">
                    <div class="form-group">
                        <label>{{ __('Roles') }}</label>
                        <select name="roles[]" class="form-control select2-dd @error('roles') is-invalid @enderror"
                            required multiple="">
                            @foreach ($roles as $role)

                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                         @error('roles')
                         <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                         @enderror
                    </div>
                   
                </div>

            </div>

        </div>

        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
        </div>
    </form>
</div>