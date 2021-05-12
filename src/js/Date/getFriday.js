console.log(Date());

const dt = new Date(2019,5-1,23);
console.log(dt);

const today = new Date();
const year = today.getFullYear();
const month = today.getMonth();
const day = today.getDay();
const date = today.getDate();
const this_friday = date - day + 6;
const dt2 = new Date(year,month,this_friday);
console.log(dt2);