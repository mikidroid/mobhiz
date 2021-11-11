     methods:{
        onChange(){
          this.profile_pic=event.target.files[0];
        },
        async updateProfile(){
          let form=new FormData();
          form.append('profile_pic',this.profile_pic)
          form.append('firstname',this.form.firstname)
          form.append('lastname',this.form.lastname)
          form.append('username',this.form.username)
          form.append('email',this.form.email)
          form.append('country',this.form.country)
          form.append('city',this.form.city)
          form.append('gender',this.form.gender)
          form.append('phone',this.form.phone)
          form.append('_method','put')
          try{
          let resp = await this.UPDATE_USER(this.user.id,form);
            this.$swal.fire({
              icon:'success',
              title:'Profile edited',
              showConfirmButton:false,
              timer:3000,
              toast:true,
              position:'top-end'
            })
          }
          catch(e){
            alert(e.message)
          }
          
        }
     },