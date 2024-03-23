export function getItem(key) {
    let storageVal = localStorage.getItem(key);
    if (storageVal) {
        storageVal = JSON.parse(storageVal);
    }
    return storageVal;
}

export function setItem(key, value = "") {
    localStorage.setItem(key, JSON.stringify(value));
}
