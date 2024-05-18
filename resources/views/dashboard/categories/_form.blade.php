
@if($errors->any())
<div class="alert alert-danger">
    <h3>Error Occured!</h3>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <div class="form-group">
        <label for="name">Catetory Name:</label>
        <input class="form-control" type="text" id="name" name="name">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Catetory parent:</label>
        <select type="text"  name="parent_id" class="form-select">
            <option value="0">Primary Category</option>
            @foreach ($parents as $parent)
                <option value="{{$parent->id}}"> {{$parent->name}}</option>
            @endforeach
        </select>
        @error('parent_id')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Catetory description:</label>
        <textarea type="text"  name="description"></textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Catetory image:</label>
        <input type="file" name="image">
        @error('image')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-check">
        <label>Status:</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ $parent->status == 'active' ? 'checked' : '' }}>
            <label class="form-check-label" for="active">Active</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="archived" value="archived" {{ $parent->status == 'archived' ? 'checked' : '' }}>
            <label class="form-check-label" for="archived">Archived</label>
        </div>
    </div>

    <button type="submit" class="submit-btn" style=" width: 200px;text-align: center">Save</button>
    </div>
