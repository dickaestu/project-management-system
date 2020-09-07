 <form class="form-create-task" method="POST">
    @csrf
    <div class="form-group">
        <label>Task Name</label>
        <input type="text" name="task_name" class="form-control" placeholder="task name">
    </div>
    <div class="form-group">
        <label>Task Description</label>
        <textarea name="task_description" class="form-control" cols="30" rows="10" placeholder="description"></textarea>
    </div>
    <div class="form-group">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control">
    </div>
    <div class="form-group">
        <label>Due Date</label>
        <input type="date" name="due_date" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Create</button>
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