import cons from './const.js';

export default class email {
  constructor(email,subject,body){
    this.email=email;
    this.subject=subject;
    this.body=body;
  }
  sendEmail(){
      let email_send=Email.send({ 
        Host: cons.EMAIL_HOST, 
        Username: cons.ADMIN_EMAIL, 
        Password: cons.EMAIL_PASSWORD, 
        To:this.email, 
        From: cons.ADMIN_EMAIL, 
        Subject:this.subject, 
        Body:this.body});
      if(email_send){return 1}
      else{return 0}
  }
}