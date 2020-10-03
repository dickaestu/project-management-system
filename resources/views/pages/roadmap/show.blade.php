 <form action="{{ route('edit-task',$item->id) }}" method="post">
    @method('PUT')
    @csrf
    
    <div class="form-group">
        <label>Start Date</label>
        <input name="start_date" class="form-control form-control-sm start-date-edit" type="date" value="{{ $item->start_date }}">
    </div>
    
    <div class="form-group">
        <label>Due Date</label>
        <input name="due_date" class="form-control form-control-sm due-date-edit" type="date" value="{{ $item->due_date }}">
    </div>

    <hr>
    
    <p class="mb-0" >Extend Time To Other Tasks</p>
    <small class="mt-0">Used for extending the time of the other tasks that related to these task</small>

    <div class="form-group mt-3">
        <label>Add Days</label>
        <input type="number" min="1"  class="form-control form-control-sm" style="width: 100px" name="add_days" >
    </div>

    <div class="form-group">
        <label>Select Tasks</label>
        <select id="addTask" name="add_tasks[]" class="form-control" multiple="multiple">
            
            @foreach ($tasks as $task)
            <option value="{{ $task->id }}">{{ $task->task_name }}</option>
            @endforeach
        </select>
    </div>
    

            
            
            {{-- footer --}}
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        
        <script>
            $('#addTask').select2({
                dropdownParent : $('#modalRoadmap'),
                placeholder : 'Search Task...',
                multiple:true
            })
        </script>