export function localStorageSetItems(data,name)
{
    const dataJson=JSON.stringify(data);
    localStorage.setItem(name,dataJson);
}

export function localStorageGetItems(name)
{
    return JSON.parse(localStorage.getItem(name)) || [];
}