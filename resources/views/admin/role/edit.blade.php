<div class="card">
    <div class="card-header">
        <h4>{{__('Edit Role')}}</h4>
    </div>
    <form action="{{ route("role.update", [$role->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                            maxlength="50" value="{{ old('name',$role->name) }}">
                    </div>
                    @error('name')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label>{{ __('Permissions') }}</label>
                        <select name="permissions[]"
                            class="form-control select2 @error('permissions') is-invalid @enderror" required
                            multiple="">
                            @foreach ($permissions as $permission)

                            <option value="{{$permission->id}}"
                                {{  $role->permissions->contains($permission->id) == 1 ? 'selected' : '' }}>
                                {{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('permissions')
                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                    @enderror
                </div>
            </div>


        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
        </div>
    </form>
</div>