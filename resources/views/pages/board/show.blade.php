<div class="row">
    <div class="col-12 col-md-7 mb-4 mb-lg-0">
        <div class="btn-group">
            <a href="#" class="btn btn-icon icon-left btn-secondary text-dark"><i class="fa fa-paperclip" aria-hidden="true"></i> Attachment</a>
            <a href="#" class="btn btn-icon icon-left btn-secondary mr-3 ml-2 text-dark"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Sub Task</a>
        </div>
        <form class="mt-3 form-update-description">
            @method('PUT')
            @csrf
            <div class="form-group mb-1">
                <label>Description</label>
                <textarea name="task_description" class="form-control description">{{ $item->task_description }}</textarea>
            </div>
            <button class="btn btn-primary btn-sm btn-save-description" style="display: none" type="submit">Save</button>
            <button class="btn btn-light btn-sm mr-3 ml-2 btn-cancel-description" style="display: none" type="reset">
                Cancel
            </button>
        </form>
        <div class="form-group mt-3">
            <label>Due Date Task</label>
            <input type="date" class="form-control form-control-sm" value="{{$item->due_date }}">
        </div>
        <div class="form-group">
            <label>Sub Task</label>
            <!-- <div class="progress">
                <div class="progress-bar" role="progressbar" data-width="50%" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100">50%</div>
            </div> -->
            
        </div>
        <div class="form-group">
            <label for="">Attachment</label>
        </div>
        <div class="form-group">
            <p style="color: #34395e; font-weight:600; font-size:12px">Activity</p>
            <div class="assigned-profile float-left mr-2">
                <img
                src="https://ui-avatars.com/api/?name=a"
                class="rounded-circle border"
                height="40"
                alt=""
                />
            </div>
            <div class="activity float-left">
                <div class="activity-user">
                    Cemoren Dallas <span>1 minute ago</span>
                </div>
                <div class="activity-comment">
                    Jangan lupa diklik!
                </div>
                <div class="activity-button">
                    <button class="btn bg-transparent">Edit</button>
                    <button class="btn bg-transparent">Delete</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        {{-- <div class="form-group">
            <div class="assigned-profile mr-2">
                <img
                src="https://ui-avatars.com/api/?name=a"
                class="rounded-circle border"
                height="40"
                alt=""
                />
            </div>
            <textarea name="comment" id="" rows="1" style="border-radius: 5px;"></textarea>
        </div> --}}
    </div>
    <div class="col-12 col-md-5">
        <div class="form-group">
            <p style="color: #34395e; font-weight:600; font-size:12px">Assigned-To</p>
        </div>
    </div>
    
</div>


<script>
    $('document').ready( function(){
        $('.form-update-description').on('submit', function(e){
            e.preventDefault();
            var $this = $(this);
            var data = $this.serializeArray();  
            $.ajax({
                url: '{{ route('task-description-update', $item->id) }}',
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
        
        
        
        $('.description').on('focus', function(e){
            $('.btn-save-description').show()
            $('.btn-cancel-description').show()
        })
        
        $('.btn-cancel-description').click(function(){
            $('.btn-save-description').hide()
            $('.btn-cancel-description').hide()
        })
    })
</script>