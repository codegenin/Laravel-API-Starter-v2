<!-- Category Modal -->
<div class="modal fade" id="modal-new-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="category-modal-title">{{__('label.new_category')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">{{__('label.name')}}:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="english">
                        </span>
                            <input type="text" name="name" id="name"
                                   class="form-control" value="{{ old('name') }}">
                        </div>
                        <!-- Translation -->
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                            <input type="text" name="fr_name" id="fr_name"
                                   class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <!-- Description: Form Input -->
                    <div class="form-group">
                        <label for="description">{{__('label.description')}}:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="french">
                        </span>
                            <input type="text" name="description" id="description"
                                   class="form-control" value="{{ old('description') }}">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                            <input type="text" name="fr_description" id="fr_description"
                                   class="form-control" value="{{ old('description') }}">
                        </div>
                    </div>

                    <!-- Parent Category: Form Input -->
                    <div class="form-group">
                        <label for="parent">{{__('label.parent_category')}}:</label>
                        <select name="parent_id" id="parent-id" class="form-control">
                            <option value="0">-- This is a parent category --</option>
                            @foreach($categoriesDropDown as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Set as public? Form Input -->
                    <div class="form-group">
                        <label for="is_public">{{__('label.set_public')}}:</label>
                        <select name="is_public" id="is-public" class="form-control">
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                    </div>

                    <!-- Image URL: Form Input -->
                    <div class="form-group">
                        <label for="media_id">{{__('label.cover_image')}}:</label>
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">Browse</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">{{__('button.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('button.save_changes')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Edit Category Modal -->
<div class="modal fade" id="modal-edit-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.category.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="category-modal-title">{{__('label.update_category')}}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">{{__('label.name')}}:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="english">
                        </span>
                            <input type="text" name="name" id="edit-name"
                                   class="form-control" value="{{ old('name') }}">
                        </div>
                        <!-- Translation -->
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                            <input type="text" name="fr_name" id="edit-fr_name"
                                   class="form-control" value="{{ old('fr_name') }}">
                        </div>
                    </div>
                    <!-- Description: Form Input -->
                    <div class="form-group">
                        <label for="description">{{__('label.description')}}:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="french">
                        </span>
                            <input type="text" name="description" id="edit-description"
                                   class="form-control" value="{{ old('description') }}">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                            <input type="text" name="fr_description" id="edit-fr_description"
                                   class="form-control" value="{{ old('fr_description') }}">
                        </div>
                    </div>

                    <!-- Parent Category: Form Input -->
                    <div class="form-group">
                        <label for="parent">{{__('label.parent_category')}}:</label>
                        <select name="parent_id" id="edit-parent-id" class="form-control">
                            <option value="0">-- This is a parent category --</option>
                            @foreach($categoriesDropDown as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Set as public? Form Input -->
                    <div class="form-group">
                        <label for="is_public">{{__('label.set_public')}}</label>
                        <select name="is_public" id="edit-is-public" class="form-control">
                            <option value="1">YES</option>
                            <option value="0">NO</option>
                        </select>
                    </div>

                    <!-- Image URL: Form Input -->
                    <div class="form-group">
                        <label for="media_id">{{__('label.cover_image')}}</label>
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">Browse</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <img src="" id="cover-image" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">{{__('button.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('button.save_changes')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->