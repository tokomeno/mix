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


let data = { price: 10, qty: 1 }
let target, total, salePrice

Object.keys(data).forEach(key => {
    let internalValue = data[key];
    const dep = new Dep();

    Object.defineProperty(data, key, {
        get(){
            dep.depend()
            console.log('i was access:' + key + ' ' + internalValue)
            return internalValue
        },
    
        set(newval){ 
            console.log('seting ' + key + ' to: ' + newval)
            internalValue = newval
            dep.notify()
        }
    })

})

function watcher(myFunc){
    target = myFunc
    target()
    target = null
}

watcher( () => {
    total = data.price * data.qty
})

watcher( () => {
    salePrice = data.price * 0.5
})


 total 

 data.salePrice = 20

 total