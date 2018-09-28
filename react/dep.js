class Dep{
    constructor(){
        this.subs = []
    }

    depend(){
        if( target && !this.subs.includes(target) ){
            this.subs.push(target)
        } 
    }

    notify(){
        this.subs.forEach(sub => sub() )
    }
}

let price = 5;
let qty = 2;
let total = 0;
let target = null; 
 

total

const dep = new Dep();

target = () => {
    total = price * qty
}

target()
total

qty = 3;
dep.depend()

target()

total