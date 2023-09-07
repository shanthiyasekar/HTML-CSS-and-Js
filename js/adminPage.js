
function appViewModel()
{
   
    let self=this;
    self.adminMessage=ko.observable("");
    self.utilizationData = ko.observableArray([]);
    self.showLoginButton = ko.observable(false);
    const storedAdminData = JSON.parse(localStorage.getItem('adminDetails')) || [];
    self.displayUtilization=function()
    {
        const storedParkingData = JSON.parse(localStorage.getItem('Data')) || [];
        console.log(storedParkingData);
        self.utilizationData(storedParkingData);
    };
    if(storedAdminData.password)
    {
        self.displayUtilization();
    }
    else
    {
        self.adminMessage("you need to login")
        self.showLoginButton(true);
    }
    self.LoginRedirect = function () 
    {
    window.location.href = 'index.html';
    };
}
ko.applyBindings(new appViewModel());

