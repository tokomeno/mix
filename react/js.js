let price = 5;
let qty = 2;
let total = 0;
let target = null;
let storage = [];

target = () =>  { total = price * qty } 

function record() {
    storage.push(target)
} 
function replay(){
    storage.forEach( run => run() )
}
record() 
target()
total
qty = 10

replay() 

total