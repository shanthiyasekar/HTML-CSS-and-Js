import { localStorageGetItems, localStorageSetItems } from "./common.js";


function removeExpiredData() {
    
    const storedData=localStorageGetItems("Data");
    //const storedData = JSON.parse(localStorage.getItem('Data')) || [];
    const currentTime = new Date().getTime(); // Get current time in milliseconds
   // console.log(currentTime);
    self.selectedSlot=ko.observable("");
    
    const updatedData = [];

    const slotVacancy=localStorageGetItems("VacancyDetails");
    //const slotVacancy=JSON.parse(localStorage.getItem('VacancyDetails'));
    console.log("before checking duration",slotVacancy);
    storedData.forEach(data => {
        const bookingTime = new Date(data.timestamp).getTime();
        const bookingTimeout = data.duration*60*1000; 
        /*console.log(data.vehicleNo);
        console.log("bookingTime",bookingTime);
        console.log("currentTime",currentTime);
        console.log("difference",currentTime-bookingTime);
        console.log("user mentioned Duration",bookingTimeout);*/
        
        if (currentTime - bookingTime < bookingTimeout) {
            // Data is within the allowed duration, keep it
          //  console.log("true");
            updatedData.push(data);
        }
        else
        {
            $(`#slot option[value="${data.slot}"]`).removeClass('occupied-slot').addClass('vacant-slot');
            slotVacancy[data.slot - 1] = false;
            console.log("after slot becomes empty",slotVacancy);
           
        }
        
    });

    // Save the updated data back to local storage
    
    localStorageSetItems(updatedData,"Data");
    localStorageSetItems(slotVacancy,"VacancyDetails");
    /*localStorage.setItem('Data', JSON.stringify(updatedData));
    localStorage.setItem("VacancyDetails",JSON.stringify(slotVacancy));
    */
        
}

// Periodically check and remove expired data (e.g., every 5 minutes)
setInterval(removeExpiredData, 5 * 60 * 1000);// 5 minutes

// Initial check on page load
removeExpiredData();
