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
    
    <div class="form-group">
        <label>Add Duration To Another Task</label>
        <select id="addTask" name="add_due_date[]" class="form-control" multiple="multiple">
          
            @foreach ($tasks as $task)
                <option value="{{ $task->id }}">{{ $task->task_name }}</option>
            @endforeach
        </select>
    </div>
    
    
    
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