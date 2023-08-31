function appViewModel()
{
    let self=this;
    self.username=ko.observable("");
    self.email=ko.observable("");
    self.userPassword=ko.observable("");
    self.userLoginError=ko.observable("");
    self.showRegisterButton = ko.observable(false);

    const registrationDataJson=localStorage.getItem("registrationData");
    const activeData=JSON.parse(localStorage.getItem("ActiveUser"))||[];


    self.userLoginForm=function()
    {
        if(registrationDataJson)
        {
            const registrationData=JSON.parse(registrationDataJson);
            const found=registrationData.some(data=>self.username()===data.username&&self.email()===data.email&&self.userPassword()===data.password);

            if(found)
            {
                self.userLoginError("");
                self.showRegisterButton(false);
                const signinData={
                    username:self.username(),
                    email:self.email(),
                    password:self.userPassword()
                }
                activeData.push(signinData);
                const activeDataJson=JSON.stringify(activeData);
                localStorage.setItem("ActiveUser",activeDataJson);
                window.location.href = 'user.html';
            }
            else
            {
                self.userLoginError("wrong details or user have not registered yet");
                self.showRegisterButton(true);
            }
            
        }
    };
    self.registerRedirect = function () {
        window.location.href = 'index.html';
    };
}

    ko.applyBindings(new appViewModel());

