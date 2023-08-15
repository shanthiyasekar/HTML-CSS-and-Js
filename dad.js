

const apikey="94tSidekDGB5mC9ODheMgQ==FSMHqVZzO4V1HXqO";

const options={
    method: "GET",
    headers:{
        "X-Api-Key":apikey,
    }
}
const apiURL="https://api.api-ninjas.com/v1/dadjokes?limit=1";

const btnEl=document.getElementById("btn");
const jokeEl=document.getElementById("joke");

async function getJoke()
{
    try 
    {
        jokeEl.innerText="updating...";
        btnEl.disabled=true;
        btnEl.innerText="Loading...";
        const response=await fetch(apiURL,options);
        const data=await response.json();
        btnEl.disabled=false;
        btnEl.innerText="tell me a joke";
        jokeEl.innerHTML =data[0].joke;
    } 
    catch (error)
    {
        jokeEl.innerHTML="An error happened,Try Again!";
        console.log(error);    
    }
    
}

btnEl.addEventListener("click",getJoke);