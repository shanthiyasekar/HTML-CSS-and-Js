function appViewModel()
{
       
    const storedAdminData = JSON.parse(localStorage.getItem('adminDetails')) || [];
    self.displayUtilization=function()
    {
        const storedParkingData = JSON.parse(localStorage.getItem('Data')) || [];
        storedParkingData.forEach(function(utilization) 
        {
          const row = `<tr>
          <td>${utilization.username}</td>
          <td>${utilization.vehicleNo}</td>
          <td>${utilization.duration} hours</td>
          <td>$${utilization.price}</td>
          <td>${utilization.timestamp}</td>
          </tr>`;
          $('#utilizationBody').append(row);
    }
    if(storedAdminData.password)
    {
        self.displayUtilization();
    }
}