<template>
  <div >
    <li class="dropdown dropdown-list-toggle" >
              <a
                href="#"
                data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle"
                ><i data-feather="bell"></i>
                <span class="badge headerBadge1"> {{assignedProjects.length}} </span>
              </a>
              <div
                class="dropdown-menu dropdown-list dropdown-menu-right pullDown" >
                <div class="dropdown-header">
                  Notifications
                  <div class="float-right">
                    <a @click="markAsRead" href="#">Mark All As Read</a>
                  </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons" style="overflow:auto">
                 
                  <a href="#" class="dropdown-item"   v-for="(assigned, index) in assignedProjects.slice(0,10)" :key="index" >
                    <span class="dropdown-item-icon bg-success text-white" >
                      <i  :class="assigned.data.icon"></i>
                    </span>
                   
                   <span class="dropdown-item-desc">{{assigned.data.message}}  
                     <span class="time">{{assigned.created_at | moment("from")}}</span>
                    </span> 

                    
                  </a>

                  <span class="dropdown-item mt-5 border-0 bg-transparent d-flex justify-content-center align-self-center" 
                  v-if="!assignedProjects.length">
                    There is no notifications
                  </span>
                </div>
                <div class="dropdown-footer text-center">
                  <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </li>
  </div>
</template>

<script>


    export default {
      props:['assignedProjects','user'],


    created(){
       Echo.private('App.User.' + this.user.id)
          .notification((notification) => {
              this.assignedProjects.unshift(notification)
              
          });
    },

    methods: {
    markAsRead() {
      axios.get("/assigned-projects/mark-all-read/" + this.user.id).then(response=>{
          window.location.reload()
      });
    }
  },
}; 
</script>
