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
const dep = new Dep();
let price = 5;
let qty = 2;
let total = 0;
let target = null; 
 

// target = () => { total = price * qty }


function watcher(myFunc){
    target = myFunc
    dep.depend()
    target()
    target = null
}


watcher(() => { total = price * qty })

