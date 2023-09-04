function appViewModel()
{
   // localStorage.clear();

    let self = this;
    self.utilizationData = ko.observableArray([]);
    self.showLoginButton = ko.observable(false);
    self.adminMessage=ko.observable("");
    const storedAdminData = JSON.parse(localStorage.getItem('adminDetails')) || [];
    self.adminMessage("");
    self.displayUtilization=function()
    {
        const storedParkingData = JSON.parse(localStorage.getItem('Data')) || [];
        self.utilizationData(storedParkingData);
    }
    if(storedAdminData.password)
    {
        self.displayUtilization();
    }
    else
    {
        self.adminMessage("you need to login")
        self.showLoginButton(true);
    }
    self.LoginRedirect = function () {
        window.location.href = 'index.html';
    };
}
ko.applyBindings(new appViewModel());