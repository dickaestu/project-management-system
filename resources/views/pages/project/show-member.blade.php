 <!-- Search form -->
 @if (Auth::id() == $item->project_manager)
 <form class="form-member">
  @csrf
  
  <div class="form-group">
    <label>Search</label>
    
    <select name="users_id" id="users_id" class="form-control">
      
    </select>
    
  </div>
  <div class="form-group">
    <label>Roles</label>
    <select name="role_member" id="role_member" class="form-control">
      <option value="System Analyst">System Analyst</option>
      <option value="UI/UX Designer">UI/UX Designer</option>
      <option value="Front End Developer">Front End Developer</option>
      <option value="Back End Developer">Back End Developer</option>
      <option value="Android Developer">Android Developer</option>
      <option value="iOS Developer">iOS Developer</option>
    </select>
  </div>
  
  <div class="row justify-content-center">
    <button type="submit" class="btn btn-primary">
      Invite
    </button>
  </div>
</form>
@endif

<div class="container mt-4">
  @if (Auth::id() == $item->project_manager)
  <div class="row mb-2">
    <h5 class="text-dark">
      Team Member
    </h5>
    <hr style="width: 280px;" />
  </div>
  @endif
  
  <div class="row pl-0 mb-3">
    <div class="col-2">
      <img
      src="https://ui-avatars.com/api/?name={{ $item->user->name }}"
      class="rounded-circle"
      height="45"
      alt=""
      />
    </div>
    <div class="col-6">
      <p class="text-dark" style="margin-bottom: -5px;">
        {{ $item->user->name }}
      </p>
      <small>Project Manager</small>
    </div>
  </div>
  
  
  @foreach ($item->project_member as $member)
  <div class="row project-members pl-0 mb-3">
    <div class="col-2">
      <img
      src="https://ui-avatars.com/api/?name={{ $member->user->name}}"
      class="rounded-circle avatar-members"
      height="45"
      alt=""
      />
    </div>
    <div class="col-7">
      <p class="text-dark" style="margin-bottom: -5px;">
        {{ $member->user->name}}
      </p>
      <small>{{ $member->role_member }}</small>
    </div>
    @if (Auth::id() == $item->project_manager)
    <div class="col-2 pt-2">
      <button 
      type="button"
      data-id = "{{ $member->id }}"
      data-token = "{{ csrf_token() }}"
      data-url="{{ route('delete-member', $member->id) }}"
      data-name="{{ $member->user->name }}"
      class="btn button_delete rounded-circle btn-sm py-0 btn-outline-danger"
      >
      <i class="fas fa-minus"></i>
    </button>
  </div>
  @endif
</div>

@endforeach
<div class="hidden-form"></div>


</div>


<script>
  $(document).ready(function(){
    
    // Untuk search dengan ajax
    $('#users_id').select2({
      dropdownParent : $('#modalMember'),
      placeholder : 'Search Name...',
      minimumInputLength: 2,
      ajax: {
        url :'{{ route('cari-user') }}',
        dataType : 'json',
        delay: 250,
        processResults : function (users){
          return {
            results : $.map(users, function(item){
              return {
                text: item.name,
                id: item.id
              }
            })
          }
        },
        cache : true
      }
    });
    
    // Untuk post data dengan ajax
    $('.form-member').on('submit', function(e){
      e.preventDefault();
      var $this = $(this);
      var projects_id = '{{ $item->id }}';
      var data = $this.serializeArray();
      data.splice(1 , 0 ,{name: "projects_id", value: projects_id})   
      $.ajax({
        url: '{{ route('create-member') }}',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response){
          if(response.failed == 'error'){
            swal('Sorry', 'Member already exists', 'error');
          } else {
            swal('Success', response.name + ' Successfully Added' , 'success');
            $(".hidden-form").append(
            `<div class="row project-members pl-0 mb-3">
              <div class="col-2">
                <img
                src="https://ui-avatars.com/api/?name=`+ response.name +`"
                class="rounded-circle avatar-members"
                height="45"
                alt=""
                />
              </div>
              <div class="col-7">
                <p class="text-dark" style="margin-bottom: -5px;">
                  `+response.name +`
                </p>
                <small>`+ response.role_member +`</small>
              </div>
              <div class="col-2 pt-2">
                <button 
                type="button"
                data-id = "`+ response.id +`"
                data-token = "{{ csrf_token() }}"
                data-url="/my-project/`+response.id +`"
                data-name="`+ response.name+`"
                class="btn button_delete rounded-circle btn-sm py-0 btn-outline-danger"
                >
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          `
          )
        }
        },
        error: function(response){
          alert('Failed')
        }
      })
    })
    
    
  });
  
  
  // Untuk Hapus member project
  $(".project-members").on('click','.button_delete', function (event) {
    
    let id = $(this).data('id');
    let token = $(this).data('token');
    let url = $(this).data('url');
    let project_members = $(this);
    let name = $(this).data('name');
    
    swal({
      title: 'Are you sure?',
      text: name + ' will be removed from the project',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      
      if (willDelete) {
        $.ajax({
          type: 'POST',
          url: url,
          data: {
            "_method" : 'DELETE',
            "_token" : token,
            "id" : id
            
          },
          dataType : "JSON",
          success: function (response){
            
            swal(response.success, {
              icon: 'success',
            });
            
            $(project_members).closest('.project-members').remove()
          }
          
        })
        
        
      } 
    });
  });
  //  Untuk Hapus Member Project yang baru ditambah
  $(".hidden-form").on('click','.button_delete', function (event) {
    
    let id = $(this).data('id');
    let token = $(this).data('token');
    let url = $(this).data('url');
    let project_members = $(this);
    let name = $(this).data('name');
    
    swal({
      title: 'Are you sure?',
      text: name + ' will be removed from the project',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      
      if (willDelete) {
        $.ajax({
          type: 'POST',
          url: url,
          data: {
            "_method" : 'DELETE',
            "_token" : token,
            "id" : id
            
          },
          dataType : "JSON",
          success: function (response){
            
            swal(response.success, {
              icon: 'success',
            });
            
            $(project_members).closest('.project-members').remove()
          }
          
        })
        
        
      } 
    });
  });
</script>

