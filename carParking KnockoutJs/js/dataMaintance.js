
function removeExpiredData() {
    const storedData = JSON.parse(localStorage.getItem('Data')) || [];
    const currentTime = new Date().getTime(); // Get current time in milliseconds
    console.log(currentTime);
   
    const updatedData = [];

    
    storedData.forEach(data => {
        const bookingTime = new Date(data.timestamp).getTime();
        const bookingTimeout = data.duration*60*1000; 
        console.log(data.vehicleNo);
        console.log("bookingTime",bookingTime);
        console.log("currentTime",currentTime);
        console.log("difference",currentTime-bookingTime);
        console.log("user mentioned Duration",bookingTimeout);
        
        if (currentTime - bookingTime < bookingTimeout) {
            // Data is within the allowed duration, keep it
            console.log("true");
            updatedData.push(data);
        }
    });

    // Save the updated data back to local storage
    if(updatedData)
    {
        console.log("true");
        localStorage.setItem('Data', JSON.stringify(updatedData));
        

    }
}

// Periodically check and remove expired data (e.g., every 5 minutes)
setInterval(removeExpiredData, 5 * 60 * 1000); // 5 minutes

// Initial check on page load
removeExpiredData();
