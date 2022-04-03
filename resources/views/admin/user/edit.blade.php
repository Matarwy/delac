<div class="card">
    <div class="card-header">
        <h4>{{__('Add New User')}}</h4>
    </div>
    <form action="{{ route("users.update", [$user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name',$user->name) }}">
                                 @error('name')
                                 <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                 @enderror
                    </div>
               
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Roles') }}</label>
                        <select name="roles[]" class="form-control select2 @error('roles') is-invalid @enderror"
                            required multiple="">
                            @foreach ($roles as $role)

                            <option value="{{$role->name}}"
                                {{  $user->roles->contains($role->id) == 1 ? 'selected' : '' }}>
                                {{$role->name}}</option>
                            @endforeach
                        </select>
@error('permissions')
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