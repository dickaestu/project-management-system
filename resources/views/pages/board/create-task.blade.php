 <form class="form-create-task" method="POST">
    @csrf
    <div class="form-group">
        <label>Task Name</label>
        <input required type="text" name="task_name" class="form-control" placeholder="task name">
     
    </div>
    <div class="form-group">
        <label>Task Tags</label>
        <input required type="text" name="tags" class="form-control" placeholder="task tags">
     
    </div>
    <div class="form-group">
        <label class="form-label">Tags Color</label>
        <div class="row gutters-xs">
            <div class="col-auto">
                <label class="colorinput">
                    <input required  type="radio" name="tags_color" value="primary" class="colorinput-input" />
                    <span class="colorinput-color bg-primary"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input required  type="radio" name="tags_color" value="secondary" class="colorinput-input" />
                    <span class="colorinput-color bg-secondary"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input required  type="radio" name="tags_color" value="danger" class="colorinput-input" />
                    <span class="colorinput-color bg-danger"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input required  type="radio" name="tags_color" value="warning" class="colorinput-input" />
                    <span class="colorinput-color bg-warning"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input required  type="radio" name="tags_color" value="info" class="colorinput-input" />
                    <span class="colorinput-color bg-info"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input required  type="radio" name="tags_color" value="success" class="colorinput-input" />
                    <span class="colorinput-color bg-success"></span>
                </label>
            </div>
        </div>
      
    </div>
    <div class="form-group">
        <label>Task Description</label>
        <textarea name="task_description" class="form-control" cols="30" rows="10" placeholder="description"></textarea>
       
    </div>
    <div class="form-group">
        <label>Start Date</label>
        <input required type="date" name="start_date" class="form-control">
     
    </div>
    <div class="form-group">
        <label>Due Date</label>
        <input required type="date" name="due_date" class="form-control">
        
    </div>
    <button type="submit" class="btn btn-primary mb-5">Create</button>
</form>



<script>
    // Untuk post data dengan ajax
    $('.form-create-task').on('submit', function(e){
        e.preventDefault();
        var $this = $(this);
        var boards_id = '{{ $id }}';
        var data = $this.serializeArray();
        data.splice(1 , 0 ,{name: "boards_id", value: boards_id})   
        $.ajax({
            url: '{{ route('create-task', $id) }}',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response){
                location.reload()
            },
            error: function(response){
                alert('Failed')
            }
        })
    })
</script>