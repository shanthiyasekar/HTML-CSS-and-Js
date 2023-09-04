function appViewModel()
{
    let self=this;
    self.vehicleNo=ko.observable("");
    self.duration=ko.observable("");
    self.timestamp = ko.observable("");

    const currentTimeStamp = new Date();
    self.timestamp(currentTimeStamp.toString());

    self.selectedSlot=ko.observable("");
    self.price=ko.observable("");
    self.bookSuccess=ko.observable("");
    self.showLogin = ko.observable(false);
    self.failureText=ko.observable("");

    const storedData = JSON.parse(localStorage.getItem('Data')) || [];
    const ActiveUserData=JSON.parse(localStorage.getItem('ActiveUser'))||[];
    const slotVacancy=getDetailsForVacancy(storedData);
    let calculated=false;

    function getDetailsForVacancy(storedData)
    {
        const vacancy=[false,false,false,false,false,false];
        storedData.forEach(data=>
        {
            if(data.slot>=1&&data.slot<=6)
            {
                vacancy[data.slot-1]=true;
            }
        });
        return vacancy;
    };
    self.getDetailsForVacancy = getDetailsForVacancy; 
    
    self.isSlotBooked = function (slot) {
        return slotVacancy[slot - 1];
    };

    self.userpage=function()
    {
        self.price("");
        if(self.selectedSlot()&&!isNaN(self.selectedSlot())&&self.selectedSlot()>=1&&self.selectedSlot()<=6&&self.vehicleNo()&&self.duration()>0)
        {
            if(!slotVacancy[self.selectedSlot()-1])
            {
                const rate=self.calculatePrice(self.duration());
                calculated=true;    
                self.price(`Price for Slot ${self.selectedSlot()}: $${rate}`);
                slotVacancy[self.selectedSlot-1]=true;
            }
            else
            {
                self.price("the chosen Slot is filled");
            }
        }
        else
        {
            self.price('Please fill in all the fields correctly.');
        }
    };

    self.bookNow=function()
    {   
        self.bookSuccess("");
        if(!calculated)
        {
            alert("Please calculate the price before booking");
            return;
        }
        const len=ActiveUserData.length;
        if(self.selectedSlot()&&!isNaN(self.selectedSlot())&&self.selectedSlot()>=1&&self.selectedSlot()<=6&&self.vehicleNo()&&self.duration()>0)
        {
            //if any slot is filled it shows not vacent
           
                if(len>0)
                {
                    const price=self.calculatePrice(self.duration());
                    const Data={
                        slot:self.selectedSlot(),
                        vehicleNo:self.vehicleNo(),
                        duration:self.duration(),
                        price:price,
                        timestamp:self.timestamp(),
                        username:ActiveUserData[len-1].username
                    }
                    self.sendToLocalStoreAge(Data);
                    self.bookSuccess("Successfully Booked");
                    $(`#slot option[value="${self.selectedSlot()}"]`).removeClass('vacant-slot').addClass('occupied-slot');
                    calculated=false;
                }
                else
                {
                    self.failureText("No activeUser,signin");
                    self.showLogin(true);
                }
           
            
        }
        else
        {
            self.failureText('Please fill in all the fields correctly.');
        }
    }
    self.calculatePrice=function(duration)
    {
        const ratePerHour=10;
        return ratePerHour*duration;
    };
    self.sendToLocalStoreAge=function(Data)
    {
     //   const storedData = JSON.parse(localStorage.getItem('Data')) || [];
        storedData.push(Data);
        localStorage.setItem('Data', JSON.stringify(storedData));
    };
    
    self.loginRedirect = function () {
        window.location.href = 'sign.html';
    };
    self.logout=function()
    {
        localStorage.removeItem('ActiveUser');
        window.location.href ="index.html";
    }
}
ko.applyBindings(new appViewModel());