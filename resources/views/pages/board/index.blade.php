@extends('layouts.main')
@section('title', 'Project Board')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="text-dark mb-3">{{ $item->project_name }} Board</h3>
          </div>
        </div>
        <div class="row">
          <div class="col p-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                  <a href="{{ route('my-project.index') }}">My Project</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  {{ $item->project_name }} Board
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <button
             class="btn btn-primary btn-sm text-primary" type="button" data-toggle="modal" data-target="#createBoard" 
            >
            <i class="fas fa-plus"></i> Create Board
          </button>
        </div>
      </div>
      
      <div class="scrolling-wrapper">
        <!-- Board card -->
        <div class="card bg-light" style="width: 320px;">
          <div class="card-body">
            <div class="row">
              <p
              style="font-weight: 600; font-size: 17px;"
              class="text-dark"
              >
              To Do
            </p>
          </div>
          <!-- Board task -->
          
          <div class="row mb-3">
            <div class="board-content">
              <div class="row mb-4">
                <div class="col-8">
                  <a href="" style="text-decoration: none" data-toggle="modal"
                  data-target=".bd-example-modal-lg">
                  <p>
                    Authentication
                  </p>
                </a>
              </div>
              <div class="col-4 text-right">
                <button
                class="btn btn-sm btn-transparent text-black"
                >
                <i class="fas fa-thumbtack"></i>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <p class="assigned-to mb-2">
                Assigned To
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="assigned-profile">
                <img
                src="https://ui-avatars.com/api/?name=a"
                class="rounded-circle border"
                height="30"
                alt=""
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Button create task -->
      <div class="row justify-content-center">
        <a
        style="text-decoration:none;" class="text-black-50" href="#" type="button" data-toggle="modal" data-target="#exampleModal" 
        >
        <i class="fas fa-plus"></i> Create Task
      </a>
    </div>
  </div>
</div>

<!-- End of board -->
</div>
</div>
</div>
</section>

</div>


<!-- task modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title text-dark" id="myLargeModalLabel">Absensi Harian</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-7">
          <div class="btn-group">
            <a href="#" class="btn btn-icon icon-left btn-secondary text-dark"><i class="fa fa-paperclip" aria-hidden="true"></i> Attachment</a>
            <a href="#" class="btn btn-icon icon-left btn-secondary mr-3 ml-2 text-dark"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Sub Task</a>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control"></textarea>
          </div>
          <button class="btn btn-primary" type="submit">Save</button>
          <button class="btn btn-warning mr-3 ml-2" type="reset">
            Cancel
          </button>
          <div class="form-group">
            <label>Due Date Task</label>
            <input type="text" class="form-control form-control-sm datepicker">
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
            <p for="">Activity</p>
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
          <div class="form-group">
            <div class="assigned-profile mr-2">
              <img
              src="https://ui-avatars.com/api/?name=a"
              class="rounded-circle border"
              height="40"
              alt=""
              />
            </div>
            <textarea name="comment" id="" rows="1" style="border-radius: 5px;"></textarea>
          </div>
        </div>
        <div class="col-5">
          <button class="btn btn-secondary text-dark dropdown-toggle" type="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          To Do
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">In Progress</a>
          <a class="dropdown-item" href="#">Testing</a>
          <a class="dropdown-item" href="#">Completed</a>
        </div>
        
        <div class="form-group mt-lg-5">
          <p>Assigned-To</p>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>
</div>


<!-- Create Board Modal -->
<div class="modal fade" id="createBoard" tabindex="-1" role="dialog" aria-labelledby="formModal"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="formModal">Create Board</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="board_name" class="form-control" placeholder="Board Name">
        </div>
        <button type="button" class="btn btn-primary m-t-15 waves-effect">Create</button>
      </form>
    </div>
  </div>
</div>
</div>


<!-- Create Task Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="formModal">Create Task</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form class="">
        <div class="form-group">
          <label>Task Name</label>
          <input type="text" name="task_name" class="form-control" placeholder="task name">
        </div>
        <div class="form-group">
          <label>Task Description</label>
          <textarea name="task_description" class="form-control" cols="30" rows="10" placeholder="description"></textarea>
        </div>
        <div class="form-group">
          <label>Due Date</label>
          <input type="date" name="due_date" class="form-control">
        </div>
        <button type="button" class="btn btn-primary m-t-15 waves-effect">Create</button>
      </form>
    </div>
  </div>
</div>
</div>
@endsection



