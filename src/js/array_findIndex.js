var array1 = [5,12,8,130,44];

console.log(array1.findIndex((elem)=>(elem > 13)));

var array2 = [
    {name: "test1", id: 1},
    {name: "test2", id: 2},
    {name: "test3", id: 3},
    {name: "test2", id: 2},
];

console.log(array2.findIndex((elem)=>(elem.name == "test2")));