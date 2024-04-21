export function getItem(key){
    const storageVal = localStorage.getItem(key);
    if (storageVal) {
        return JSON.parse(storageVal);
    }
    return null;
}

export function setItem(key, value){
    localStorage.setItem(key, JSON.stringify(value));
}

export function removeItem(key){
    localStorage.clear(key);
}
    
    