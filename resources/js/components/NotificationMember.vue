<template>
  <div >
    <li class="dropdown dropdown-list-toggle" >
              <a
                href="#"
                data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle"
                ><i data-feather="bell"></i>
                <span class="badge headerBadge1"> {{notifications.length}} </span>
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
                 
                  <a href="#" @click="goToBoard(notification.data.projects_id)" class="dropdown-item"   v-for="(notification, index) in notifications" :key="index" >
                    <span class="dropdown-item-icon bg-success text-white" >
                      <i  :class="notification.data.icon"></i>
                    </span>
                   
                   <span class="dropdown-item-desc">{{notification.data.message}}  
                     <span class="time">{{notification.created_at | moment("from")}}</span>
                    </span> 

                    
                  </a>

                  <span class="dropdown-item mt-5 border-0 bg-transparent d-flex justify-content-center align-self-center" 
                  v-if="!notifications.length">
                    There is no notifications
                  </span>
                </div>
                <div class="dropdown-footer text-center">
                  <a @click="viewAll" href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </li>
  </div>
</template>

<script>


    export default {
      props:['notifications','user'],


    created(){
       Echo.private('App.User.' + this.user.id)
          .notification((notification) => {
              this.notifications.unshift(notification)
              
          });
    },

    methods: {
    markAsRead() {
      axios.get("/notification-members/mark-all-read/" + this.user.id).then(response=>{
          window.location.reload()
      });
    },

    goToBoard(notification){
     
      const id= notification;
      window.location.href = "/my-project/"+id+"/board"
    },

    viewAll(){
      window.location.href="/my-project/all-notification/";
    }

  },
}; 
</script>
