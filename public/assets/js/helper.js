function formatCurrency(price) {
    let money = parseFloat(price).toFixed(2);
    return money
        .replace(/\.\d*$/, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
