function appViewModel()
{
    let self=this;
    //localStorage.clear();
    //RegistrationPage details
    self.newUsername=ko.observable("");
    self.email=ko.observable("");
    self.newUserPassword=ko.observable("");
    self.newUserConfirmPassword=ko.observable("");
    self.emailErrorMessage=ko.observable("");
    self.passwordErrorMessage=ko.observable("");
    self.registrationErrorMessage=ko.observable("");
    self.confirmPasswordErrorMessage=ko.observable("");
    self.registrationSuccess=ko.observable("");

     //admin Page details
     self.adminUsername=ko.observable("");
     self.adminPassword=ko.observable("");
     self.adminInvalid=ko.observable("");
     
    //Registration Page Functionality
    self.validateForm=function()
    {
        const emailId= /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const Password= /^[A-Za-z0-9+]{8,15}$/;

        self.emailErrorMessage("");
        self.passwordErrorMessage("");
        self.registrationErrorMessage("");
        self.confirmPasswordErrorMessage("");
     
        if(!self.newUsername()||!self.email()||!self.newUserPassword()||!self.newUserConfirmPassword())
        {
            self.registrationErrorMessage('All fields must be filled.');
            return false;
        }
        if(!emailId.test(self.email()))
        {
            self.emailErrorMessage("Please enter a valid email address.");
           
            return false;
        }
        if(!Password.test(self.newUserPassword()))
        {
            self.passwordErrorMessage("Password must be contain 8-15 char with atleast one upper,lowercase and digit.");
           
            return false;
        }
        if(self.newUserPassword()!=self.newUserConfirmPassword())
        {
            self.confirmPasswordErrorMessage("password should be same");
            return false;
        }
       
        return true;
    };
    self.userRegisterForm=function()
    {
      
        const storedData = JSON.parse(localStorage.getItem('registrationData')) || [];
        const checkDataInLocal=storedData.some(data=>data.email===self.email());
        if(self.validateForm())
        {
            self.emailErrorMessage("");
            self.passwordErrorMessage("");
            self.registrationErrorMessage("");
            self.confirmPasswordErrorMessage("");
            
            if(checkDataInLocal)
            {
                alert("this emailId is already registered");
                return;
            }

            const registrationData={
                username:self.newUsername(),
                password:self.newUserPassword(),
                email:self.email(),  
                confirmPassword:self.newUserConfirmPassword()
            }
            storedData.push(registrationData);
            const registrationDataJson=JSON.stringify(storedData);
            localStorage.setItem("registrationData",registrationDataJson);
            self.registrationSuccess("Registered Successfully,you can sign in");
        }
    };

   
    self.adminLoginForm=function()
    {
       
        const adminData=JSON.parse(localStorage.getItem("adminDetails"))||[];
        self.adminInvalid('');
        if(self.adminUsername()=="admin"&&self.adminPassword()=="password")
        {
           
            const data={
                username:"admin",
                password:"password"
            }
           
            const adminDataJson=JSON.stringify(data);
            localStorage.setItem("adminDetails",adminDataJson);
            window.location.href = 'next_page.html';
        }
        else
        {
            self.adminInvalid('Invalid credentials. Please try again.');
        }
    }
}
ko.applyBindings(new appViewModel());