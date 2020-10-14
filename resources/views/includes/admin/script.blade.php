  <!-- General JS Scripts -->
  <script src="{{ url('assets/js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ url('assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ url('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ url('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
  
  <!-- Template JS File -->
  <script src="{{ url('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ url('assets/js/custom.js') }}"></script>
  
  
  <script>
    jQuery(document).ready(function($){
       $('#modalDetailProjectMember').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var modal = $(this);
        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });

      $('#modalProjectUser').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var modal = $(this);
        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });

      $('#modalTaskUser').on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var modal = $(this);
        modal.find('.modal-body').load(button.data("remote"));
        modal.find('.modal-title').html(button.data("title"));
      });
      
    });
    
  </script>

  <div class="modal" id="modalDetailProjectMember" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <i class="fa fa-spinner fa-spin"></i>
        </div>
        
      </div>
    </div>
  </div>

  <div class="modal" id="modalProjectUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <i class="fa fa-spinner fa-spin"></i>
        </div>
        
      </div>
    </div>
  </div>

  <div class="modal" id="modalTaskUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <i class="fa fa-spinner fa-spin"></i>
        </div>
        
      </div>
    </div>
  </div>